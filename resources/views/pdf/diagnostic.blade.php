@extends('layouts.pdf')

@php
    use Carbon\Carbon;
    use App\Models\History;
    use App\Models\Diagnostic;
    use App\Http\Controllers\PdfController;
@endphp


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
            height: 70px;
            resize: none;
            /* Desactiva el redimensionamiento */
        }

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

@section('content')
    <h1 style="text-align: center;">Historial Clinico</h1>
    <p><strong>CI:</strong> {{ $person->id }}</p>
    <p><strong>Paciente:</strong> {{ $person->surname . ' ' . $person->name }}</p>
    <p><strong>Edad:</strong> {{ Carbon::now()->year - Carbon::parse($person->birthdate)->year }} años</p>
    <p><strong>Genero:</strong> {{ $person->gender == 1 ? 'Hombre' : 'Mujer' }}</p>
    <p><strong>Patologias:</strong> {{ $person->pathological }}</p>
    <p><strong>Alergias:</strong> {{ $person->allergies }}</p>
    <p><strong>Cirugias:</strong> {{ $person->surgeries }}</p>
    <h5 style="text-align: center;">DIAGNOSTICOS</h5>
    <table>
        <thead>
            <th>Id</th>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Estado</th>
        </thead>
        <tbody>
            @foreach ($person->diagnostics() as $diag)
                <tr>
                    <td>{{ $diag->id }}</td>
                    @php
                        $date = History::find($diag->history_id)->reservation->date;
                    @endphp
                    <td>{{ $date }}</td>
                    <td>{{ $diag->description }}</td>
                    <td>{{ $diag->status == 1 ? 'En Progreso' : 'Finalizado' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="page-break-after: always;"></div>
    @foreach ($person->diagnostics() as $key => $diag)
        <h1 style="text-align: center;">Diagnostico {{ $diag->id }}</h1>
        <x-svg-body id="{{ $diag->id }}"></x-svg-body>

        <div style="position: fixed;top: 140px;left: 40%;width: 50%;" class="w3-container">
            <label><strong>Motivo Consulta</strong></label>
            <textarea class="lined-textarea">{{ $diag->consultation }}</textarea>
            <label><strong>Enfermedad Actual</strong></label>
            <textarea class="lined-textarea">{{ $diag->disease }}</textarea>
            <label><strong>Examen Fisico</strong></label>
            <textarea class="lined-textarea">{{ $diag->physicalExam }}</textarea>
            <label><strong>Detalle de Diagnostico</strong></label>
            <textarea class="lined-textarea">{{ $diag->description }}</textarea>
        </div>
        <div style="margin-top: 80px;">
            <h5 style="text-align: center;">TRATAMIENTOS</h5>
            <table>
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Cantidad/Sesiones</th>
                    <th>Precio</th>
                    <th>Cada</th>
                </thead>
                <tbody>
                    @php
                        $d = Diagnostic::find($diag->id);
                    @endphp
                    @foreach ($d->detail_diagnostics as $di)
                        <tr>
                            <td>{{ $di->treatment->id }}</td>
                            <td>{{ $di->treatment->name }}</td>
                            <td>{{ $di->quantity }}/{{ $person->history()->where('detail_diagnostic_id', $di->id)->count() }}
                            </td>
                            <td>{{ $di->price }}</td>
                            <td>{{ $di->by_day }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($key < sizeof($person->diagnostics()))
            <div style="page-break-after: always;"></div>
        @endif
    @endforeach
@endsection
