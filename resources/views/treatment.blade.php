@extends('adminlte::page')

@php
    use App\Models\Observation;
    $isEdit = false;
    $treatment = [
        'Id' => 'id',
        'Nombre' => 'name',
        'Precio' => 'price',
    ];

    $observation = [
        'Id' => 'id',
        'Nombre' => 'name',
        'Tipo' => 'type',
    ];
@endphp

@section('content_header')
    <h1>Tratamientos</h1>
@endsection

@section('content')
    <div class="m-1 d-flex justify-content-end">
        <a class="btn btn-success" id="add" data-bs-toggle="modal" data-bs-target="#treatmentModal">
            <i class="fa fa-plus"></i>
            Nuevo Tratamiento
        </a>
    </div>
    <livewire:card-table title="Tratamientos" :heads="$treatment" model="Treatment" head-select="id" modal="treatmentModal" emit="treatmentEdit"/>

    <div class="m-1 d-flex justify-content-end">
        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ObservationModal">
            <i class="fa fa-plus"></i>
            Nueva Observación
        </a>
    </div>
    <livewire:card-table title="Observaciones" :heads="$observation" model="Observation" head-select="id" modal="ObservationModal" emit="observationEdit" on-delete="true"/>

    <x-modal id="treatmentModal" title="Nuevo Tratamiento">
        <livewire:treatment-form />
    </x-modal>

    <x-modal id="ObservationModal" title="Nueva Observación">
        <livewire:observation-form/>
    </x-modal>
@endsection



@section('css')
    <style>
        ::-webkit-scrollbar {
            display: none;
        }
    </style>
@endsection

@section('js')
@endsection
