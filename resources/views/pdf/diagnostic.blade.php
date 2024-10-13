@extends('layouts.pdf')

@section('css')
    <style>
        .human-body {
            width: 380px;
            height: auto;
        }

        .body-part {
            fill: white;
            {{-- cursor: pointer; --}}
        }

        .body-select {
            fill: red;
        }

        .lined-textarea {
            background: url('ruta-de-la-imagen.jpg') repeat-y;
            /* Imagen con líneas horizontales */
            line-height: 1.5;
            font-family: 'Courier New', Courier, monospace;
            /* Fuente monoespaciada para un efecto más real */
            padding: 10px;
            border: 1px solid #ccc;
            width: 100%;
            height: 100%;
            resize: none;
            /* Desactiva el redimensionamiento */
        }
    </style>
@endsection

@section('content')
    <h1 style="text-align: center;">Terapia del Dolor</h1>

    <img src="data:image/svg+xml;base64,{{ base64_encode($svg) }}" style="height: 300px; width: auto;margin-top: 50px;">

    <div style="position: fixed;top: 150px;left: 40%;width: 50%;" class="w3-container">
        <label>Intensidad Subjetiva</label>
        <input wire:model="subjetive_intensity" type="text" class="w3-input" disabled value="sad" />
        <label>Frecuencia</label>
        <input wire:model="rate" input="text" class="w3-input" disabled />
        <label>Consumo de Analgesicos</label>
        <input wire:model="consumption_painkillers" class="w3-input" />
        <label class="input-group-text">Incapacitación</label>
        <input wire:model="incapacitation" class="lined-textarea" />
        <label>Diagnostico</label>
        <textarea>affsdfa</textarea>
    </div>
@endsection
