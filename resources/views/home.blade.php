@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Principal</h1>
@stop

@section('content')

    <div class="d-flex justify-content-end mb-1">
        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalReservation">
            <i class="fa fa-plus"></i>
            Nueva Atención
        </a>
    </div>
    <x-card>
        <livewire:waiting-queue>
        </livewire:waiting-queue>
        <x-slot name="footer">
        </x-slot>
    </x-card>

    <x-modal id="modalReservation" title="Nueva Atención" option="modal-xl">
        <livewire:create-attention></livewire:create-attention>
    </x-modal>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
