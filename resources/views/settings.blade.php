@extends('adminlte::page')

@section('content_header')
<h1>Configuraciones</h1>
@endsection


@section('content')

<x-card title="Horario de Atención">
    <livewire:schedules>
    </livewire:schedules>
    <h5 class="card-text mt-2">Contacto</h5>
    <form action="{{route('dashboard.setPhone')}}" method="post">
        @csrf
        <div class="input-group">
            <span class="input-group-text">Celular de Contacto</span>
            <input type="number" class="form-control" name="phone" value="{{$phone ?? ''}}">
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
    <x-slot name="footer">
    </x-slot>
</x-card>
@endsection
