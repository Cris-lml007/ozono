@extends('adminlte::page')

@section('content_header')
    <h1>Reporte de Ingresos</h1>
@endsection

@section('content')
<x-card>
    <livewire:report-income>
    </livewire:report-income>
    <x-slot name="footer">
    </x-slot>
</x-card>

@endsection

