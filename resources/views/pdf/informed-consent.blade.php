@extends('layouts.pdf')
@php
    use App\Models\Observation;
@endphp

@section('content')
    <h1 style="text-align: center;">CONSENTIMIENTO INFORMADO</h1>
    <div>
        <p>
            Yo
            <strong>{{ $diagnostic->history->person->surname . ' ' . $diagnostic->history->person->name }}</strong><br>Con
            C.I <strong>{{ $diagnostic->history->person->ci }}</strong>
            declaro haber recibido y entendido la información brindada sobre los tratamientos
            recomendados y autorizo al personal medico y personal tratante del centro de
            Ozonoterapia Ozono Life a brindarme tratamiento para mi enfermedad.<br>
            Diagnostico Medico : <strong>{{ $diagnostic->description }}</strong>
        </p>
        <h5><strong>TRATAMIENTOS</strong></h5>
        <table class="w3-table-all">
            <tr class="w3-blue">
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
            @foreach ($diagnostic->detail_diagnostics as $item)
                <tr>
                    <td>{{ $item->treatment->name }}</td>
                    <td>{{ $item->treatment->description }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <h5><strong>ZONAS LOCALIZADAS</strong></h5>
    <ul>
        @foreach (explode(',', $diagnostic->body_pain) as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
    <div>
        <h5><strong>CONTRAINDICACIONES</strong></h5>
        <ul>
            @foreach (Observation::distinct()->where('type', 0)->join('detail_treatments', 'detail_treatments.observation_id', '=', 'observations.id')->join('treatments', 'treatments.id', '=', 'detail_treatments.treatment_id')->join('detail_diagnostics', 'detail_diagnostics.treatment_id', '=', 'treatments.id')->where('detail_diagnostics.diagnostic_id', 1)->select('observations.*')->get() as $obs)
                <li>{{ $obs->name }}</li>
            @endforeach
        </ul>
        <h5><strong>POSIBLES EFECTOS SECUNDARIOS</strong></h5>
        <ul>
            @foreach (Observation::distinct()->where('type', 1)->join('detail_treatments', 'detail_treatments.observation_id', '=', 'observations.id')->join('treatments', 'treatments.id', '=', 'detail_treatments.treatment_id')->join('detail_diagnostics', 'detail_diagnostics.treatment_id', '=', 'treatments.id')->where('detail_diagnostics.diagnostic_id', 1)->select('observations.*')->get() as $obs)
                <li>{{ $obs->name }}</li>
            @endforeach
        </ul>
    </div>
    <h5><strong>DECLARACION</strong></h5>
    <p>Manifiesto mi consentimiento en forma libre y voluntaria,
        para dar inicio al tratamiento con sesiones de Ozonoterapia.</p>
    <div style="text-align: center; margin-top: 100px;">
        <div style="display: inline-block; width: 45%;">
            <div style="border-top: 1px solid black; width: 80%; margin: 0 auto; margin-top: 20px;"></div>
            <h5 style="margin: 0;">Firma del Paciente</h5>
            <h6 style="margin: 0;">{{ $diagnostic->history->person->surname . ' ' . $diagnostic->history->person->name }}
            </h6>
            <h6 style="margin: 0;">{{ $diagnostic->history->person->ci }}</h6>
        </div>
        <div style="display: inline-block; width: 45%;">
            <div style="border-top: 1px solid black; width: 80%; margin: 0 auto; margin-top: 20px;"></div>
            <h5 style="margin: 0;">Firma del Médico</h5>
            <h6 style="margin: 0;">{{ $diagnostic->history->medic->surname . ' ' . $diagnostic->history->medic->name }}
            </h6>
            <h6 style="margin: 0;">{{ $diagnostic->history->medic->ci }}</h6>
        </div>
    </div>
@endsection
