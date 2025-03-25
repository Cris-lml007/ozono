@extends('adminlte::page')

@section('content_header')
    <h1>Reporte de Citas</h1>
@endsection

@section('content')
<x-card>
    <livewire:report-appointment>
    </livewire:report-appointment>
    <x-slot name="footer">
    </x-slot>
</x-card>

@endsection

