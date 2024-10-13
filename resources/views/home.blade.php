@extends('layouts.app1')
@section('content')
<div class="container">
    <div class="d-flex justify-content-end mb-1">
        <button class="btn btn-success" data-bs-target="#modal" data-bs-toggle="modal">
            <i class="nf nf-fa-plus"></i>
            Añadir Reservation
        </button>
    </div>
    <x-card title="Mis Reservaciones">
        <table class="table table-striped">
            <thead>
                <th>Id</th>
                <th>Medico</th>
                <th>Fecha</th>
                <th>Horario</th>
            </thead>
            <tbody>
                @foreach ($reservations ?? [] as $reservation)
                <tr>
                    <td>{{$reservation->id}}</td>
                    <td>{{$reservation->staffSchedule->staff->person->surname . ' ' . $reservation->staffSchedule->staff->person->name}}</td>
                    <td>{{$reservation->date}}</td>
                    <td>{{$reservation->staffSchedule->schedule->start}}</td>
                    <td>
                        <form action="{{route('dashboard.deleteReservation',$reservation->id)}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="nf nf-fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <x-slot name="footer">
        </x-slot>
    </x-card>
    <x-modal id="modal" title="Añadir Reservación">
        <livewire:add-reservation :ci="$ci">
        </livewire:add-reservation>
    </x-modal>
</div>
@endsection
