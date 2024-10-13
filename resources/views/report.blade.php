@extends('adminlte::page')

@section('content_header')
<h1>Reportes</h1>
@endsection

@section('content')
    <x-card title="Reportes">
        <div class="">
            <h5 class="card-text">Cantidad de Reservas por Día (Última Semana)</h5>
            <div id="chartReservasPorDia" style="height: 370px; width: 100%;"></div>
        </div>
        <div class="">
            <h5>Ganancias por Día (Última Semana)</h5>
            <div id="chartGananciasPorDia" style="height: 370px; width: 100%;"></div>
        </div>
        <div class="">
            <h5>Tratamientos Más Usados</h5>
            <div id="chartTratamientos" style="height: 370px; width: 100%;"></div>
        </div>
        <div class="">
            <h5>Pacientes Atendidos en la Última Semana</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Fecha de Atención</th>
                        <th>Cancelación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pacientesAtendidos as $paciente)
                        <tr>
                            <td>{{ $paciente->surname }}</td>
                            <td>{{ $paciente->name }}</td>
                            <td>{{ $paciente->fecha_atencion }}</td>
                            <td>{{ $paciente->canceled}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-slot name="footer"></x-slot>
    </x-card>
@endsection

@section('js')
    <script src="https://cdn.canvasjs.com/ga/canvasjs.min.js"></script>
    <script>
        window.onload = function() {
            var dataReservas = @json($dataPointsReservas);
            var chartReservas = new CanvasJS.Chart("chartReservasPorDia", {
                animationEnabled: true,
                theme: "light1",
                title: {
                    text: "Cantidad de Reservas por Día (Última Semana)"
                },
                axisY: {
                    title: "Número de Reservas",
                    includeZero: false
                },
                data: [{
                    type: "line",
                    dataPoints: dataReservas
                }]
            });
            chartReservas.render();

            var dataGanancias = @json($dataPointsGanancias);
            var chartGanancias = new CanvasJS.Chart("chartGananciasPorDia", {
                animationEnabled: true,
                theme: "light1",
                title: {
                    text: "Ganancias por Día (Última Semana)"
                },
                axisY: {
                    title: "Ganancias en Bs.",
                    includeZero: true
                },
                data: [{
                    type: "column",
                    dataPoints: dataGanancias
                }]
            });
            chartGanancias.render();

            var dataTratamientos = @json($dataPointsTratamientos);
            var chartTratamientos = new CanvasJS.Chart("chartTratamientos", {
                animationEnabled: true,
                theme: "light1",
                title: {
                    text: "Tratamientos Más Usados"
                },
                data: [{
                    type: "pie",
                    showInLegend: true,
                    legendText: "{label}",
                    indexLabel: "{label} - #percent %",
                    dataPoints: dataTratamientos
                }]
            });
            chartTratamientos.render();
        }
    </script>
@endsection
