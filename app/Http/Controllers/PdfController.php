<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\History;
use App\Models\Person;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generateConsent(Diagnostic $diagnostic){
        // return view('pdf.diagnostic',['svg' => $this->generateDiagnostic()]);
        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ])
            // ->loadView('pdf.diagnostic',['svg' => $this->generateDiagnostic()]);
        ->loadView('pdf.informed-consent',['diagnostic' => $diagnostic]);
        $pdf->setPaper('letter');
        $pdf->render();
        return $pdf->stream();
    }

    public function generatePayment(Diagnostic $diagnostic){
        $histories = History::wherehas('detailDiagnostic',function($query) use ($diagnostic){
            $query->where('diagnostic_id',$diagnostic->id);
        })->get();
        $total = $diagnostic->detail_diagnostics()->selectRaw('SUM(price * quantity) as total')->value('total');
        $pdf = pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ])->loadView('pdf.history-payment',compact(['diagnostic','histories','total']));
        $pdf->setPaper('letter');
        $pdf->render();
        return $pdf->stream();
    }

    public function generateDiagnostic(Person $person){
        $pdf = pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ]);
        // $person = $diagnostic->history->person;
        $pdf->loadView('pdf.diagnostic',['person'=>$person]);
        $pdf->setPaper('letter');
        $pdf->render();
        return $pdf->stream();
    }
}
