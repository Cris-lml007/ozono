@extends('adminlte::page')

@section('content_header')
    <h1>Personal</h1>
@endsection

@php
    $medic = [
        'CI' => 'ci',
        'Apellidos' => 'surname',
        'Nombres' => 'name',
        'Rol' => 'role',
    ];
@endphp

@section('content')
    <div class="d-flex justify-content-end mb-1">
        <a class="btn btn-success" data-bs-target="#modalUser" data-bs-toggle="modal">
            <i class="fa fa-plus"></i>
            Nuevo Medico
        </a>
    </div>
    <livewire:card-table-user title="Medicos" model="Person" :heads="$medic" headSelect="ci" modal="modalUser" emit="staffEdit" />

    <x-modal id="modalUser" title="Nuevo Medico" option="" style="width: 500px;">
        <livewire:user-form/>
    </x-modal>
@endsection
