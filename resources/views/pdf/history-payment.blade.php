@extends('layouts.pdf')
@php
$canceled = 0;
@endphp

@section('content')
    <h1 style="text-align: center;">Detalle de Pago</h1>
    {{-- <h5 style="text-align: center;"><strong>INFORMACION</strong></h5> --}}
    <p><strong>CI:</strong> {{ $diagnostic->history->person->ci }}</p>
    <p><strong>Paciente:</strong> {{ $diagnostic->history->person->surname . ' ' . $diagnostic->history->person->name }}</p>
    <p><strong>N° Diagnostico:</strong> {{ $diagnostic->id }}</p>
    <p><strong>Diagnostico Medico:</strong> {{ $diagnostic->description }}</p>
    <p><strong>Fecha:</strong> {{ $diagnostic->created_at }}</p>
    {{-- <p><strong>Tratamiento: </strong>{{$diagnostic->description}}</p> --}}
    <h5 style="text-align: center;"><strong>HISTORIAL DE TRATAMIENTOS</strong></h5>
    <table>
        <thead>
            <th>Fecha</th>
            <th>Tratamiento</th>
            {{-- <th>Cantidad</th> --}}
            {{-- <th>Precio</th> --}}
            {{-- <th>Subtotal</th> --}}
            <th>Cancelado</th>
            {{-- <th>Total</th> --}}
            {{-- <th></th> --}}
        </thead>
        <tbody>
            @foreach ($histories as $history)
            <tr>
                <td>{{ $history->reservation->date }}</td>
                <td>{{ $history->detailDiagnostic->treatment->name }}</td>
                <td>{{ $history->canceled }}</td>
                {{-- <td>{{$diag->price}}</td> --}}
                {{-- <td>{{$diagnostic->price*$diag->quantity}}</td> --}}
                {{-- <td>{{$diag->histories()->sum('canceled')}}</td> --}}
                @php
                $canceled+=$history->canceled;//$diag->histories()->sum('canceled');
                @endphp
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" style="text-align: right;padding-right: 10px;">Total Cancelado</th>
                {{-- <th>{{$total}}</th> --}}
                <th>{{$canceled}}</th>
            </tr>
            <tr>
                <th colspan="2" style="text-align: right;padding-right: 10px;">Monto Restante</th>
                <th colspan="1">{{$total}} Bs</th>
            </tr>
            <tr>
                <th colspan="2" style="text-align: right;padding-right: 10px;">Saldo</th>
                <th colspan="1">{{$total-$canceled}} Bs</th>
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
