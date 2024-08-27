@extends('adminlte::page')

@section('content_header')
<h1>Configuraciones</h1>
@endsection


@section('content')

<x-card title="Horario de Atención">
    <livewire:schedules>
    </livewire:schedules>
    <x-slot name="footer">
    </x-slot>
</x-card>
@endsection
