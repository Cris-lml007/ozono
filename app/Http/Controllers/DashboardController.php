<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Reservation;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(){
        if (Auth::user()->role == Role::PATIENT){
            $patient = Auth::user()->person;
            $reservations = Reservation::where('person_id',$patient->id)
                ->where('date','>',Carbon::now())->orWhere(function($query){
                    $query->where('date',Carbon::now())->whereHas('staffSchedule',function($query){
                        $query->whereHas('schedule',function($query){
                            $query->where('start','>=',Carbon::now()->toTimeString())->where('end','<=',Carbon::now()->toTimeString());
                        });
                    });
                })
                ->get();
            return view('home',['reservations' => $reservations,'ci' => $patient->ci]);
        }
        return view('dashboard');
    }

    public function reportAppointment(){
        if( !Gate::allows('administration',Auth::user())){
            abort(404);
        }
        $reservations = Reservation::where('date','>=',Carbon::now())->get();
        return view('report-appointment',['reservations' => $reservations]);
    }

    public function reportIncome(){
        if( !Gate::allows('administration',Auth::user())){
            abort(404);
        }
        return view('report-income');
    }

    public function staff(){
        if( !Gate::allows('administration',Auth::user())){
            abort(404);
        }
        return view('staff');
    }

    public function treatment(){
        return view('treatment');
    }

    public function settings(){
        if( !Gate::allows('administration',Auth::user())){
            abort(404);
        }
        return view('settings',['phone' => Setting::first()->phone]);
    }

    public function patient(){
        return view('patient');
    }

    public function appointmentMedic(){
        return view('appointment-medic');
    }

    public function report(){
        if( !Gate::allows('administration',Auth::user())){
            abort(404);
        }
        $gananciasPorDia = DB::table('reservations as r')
            ->join('histories as h', 'r.id', '=', 'h.reservation_id')
            ->select(DB::raw('DATE(h.created_at) as dia'), DB::raw('SUM(h.canceled) as total_ganancias'))
            ->whereBetween('h.created_at', [now()->subDays(7), now()])
            ->groupBy('dia')
            ->orderBy('dia', 'asc')
            ->get();

        $dataPointsGanancias = $gananciasPorDia->map(function ($ganancia) {
            return ['label' => $ganancia->dia, 'y' => $ganancia->total_ganancias];
        });

        $reservasPorDia = DB::table('reservations')
            ->select(DB::raw('DATE(date) as dia'), DB::raw('COUNT(*) as total_reservas'))
            ->whereBetween('created_at', [now()->subDays(7), now()])
            ->groupBy('dia')
            ->orderBy('dia', 'asc')
            ->get();

        $dataPointsReservas = $reservasPorDia->map(function ($reserva) {
            return ['label' => $reserva->dia, 'y' => $reserva->total_reservas];
        });

        $tratamientosMasSolicitados = DB::table('detail_diagnostics as dd')
            ->join('treatments as t', 'dd.treatment_id', '=', 't.id')
            ->select('t.name', DB::raw('COUNT(t.name*dd.quantity) as cantidad'))
            ->groupBy('t.name')
            ->orderBy('cantidad', 'desc')
            ->limit(10)
            ->get();

        $dataPointsTratamientos = $tratamientosMasSolicitados->map(function ($tratamiento) {
            return ['label' => $tratamiento->name, 'y' => $tratamiento->cantidad];
        });

        $pacientesAtendidos = DB::table('reservations as r')
            ->join('histories as h', 'r.id', '=', 'h.reservation_id')
            ->join('persons as p', 'r.person_id', '=', 'p.id')
            ->select('p.surname', 'p.name', DB::raw('DATE(h.created_at) as fecha_atencion'), 'h.canceled')
            ->whereBetween('h.created_at', [now()->subDays(7), now()])
            ->orderBy('fecha_atencion', 'asc')
            ->get();

        return view('report', [
            'dataPointsReservas' => $dataPointsReservas,
            'dataPointsGanancias' => $dataPointsGanancias,
            'dataPointsTratamientos' => $dataPointsTratamientos,
            'pacientesAtendidos' => $pacientesAtendidos
        ]);
    }

    public function setPhone(Request $request){
        if( !Gate::allows('administration',Auth::user())){
            abort(404);
        }
        if(!empty($request->phone)){
            Setting::where('id',1)->update(['phone' => $request->phone]);
        }
        return redirect(route('dashboard.settings'));
    }

    public function deleteReservation(Reservation $reservation){
        if($reservation->person->id == Auth::user()->person->id){
            $reservation->delete();
        }
        return redirect()->route('dashboard.main');
    }
}
