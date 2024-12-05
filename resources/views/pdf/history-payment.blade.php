@extends('layouts.pdf')
@php
$total = 0;
$canceled = 0;
@endphp

@section('content')
    <h1 style="text-align: center;">Detalle de Pago</h1>
    {{-- <h5 style="text-align: center;"><strong>INFORMACION</strong></h5> --}}
    <p><strong>CI:</strong> {{ $diagnostic->history->person->ci }}</p>
    <p><strong>Paciente:</strong> {{ $diagnostic->history->person->surname . ' ' . $diagnostic->history->person->name }}</p>
    <p><strong>N° Diagnostico:</strong> {{ $diagnostic->id }}</p>
    <p><strong>Diagnostico Medico:</strong> {{ $diagnostic->description }}</p>
    <h5 style="text-align: center;"><strong>HISTORIAL DE TRATAMIENTOS</strong></h5>
    <table>
        <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>
            <th>Cancelado</th>
        </thead>
        <tbody>
            @foreach ($diagnostic->detail_diagnostics as $diag)
                <tr>
                    <td>{{$diag->id}}</td>
                    <td>{{ $diag->treatment->name }}</td>
                    <td>{{$diag->quantity}}</td>
                    <td>{{$diag->price}}</td>
                    <td>{{$diag->price*$diag->quantity}}</td>
                    <td>{{$diag->histories()->sum('canceled')}}</td>
                    @php
                    $total+=$diag->price*$diag->quantity;
                    $canceled+=$diag->histories()->sum('canceled');
                    @endphp
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align: right;padding-right: 10px;">Total a Pagar</th>
                <th>{{$total}}</th>
                <th>{{$canceled}}</th>
            </tr>
            <tr>
                <th colspan="4" style="text-align: right;padding-right: 10px;">Monto Restante</th>
                <th colspan="2">{{$total-$canceled}} Bs</th>
            </tr>
        </tfoot>
    </table>
@endsection

@section('css')
    <style>
        table,
        td,
        th {
            border: 1px solid;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
@endsection
