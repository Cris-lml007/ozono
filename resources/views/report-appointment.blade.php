@extends('adminlte::page')

@section('content_header')
    <h1>Reporte de Citas</h1>
@endsection

@section('content')
<x-card>
    <div class="d-flex justify-content-end">
        <label class="col-form-label">Desde</label>
        <input type="date" class="form-control">
        <label class="col-form-label">Hasta</label>
        <input type="date" class="form-control">
        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
    </div>
    <table class="table table-striped">
        <thead>
            <th>Fecha</th>
            <th>Paciente</th>
            <th>Medico</th>
            <th>Tratamiento</th>
            <th>Costo</th>
            <th></th>
        </thead>
        <tbody>
            <tr>
                <td>2021-10-10</td>
                <td>Jose Perez</td>
                <td>Dr. Juan Perez</td>
                <td>Extraccion</td>
                <td>100.00</td>
                <td>
                    <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
            <tr>
                <td>2021-10-10</td>
                <td>Jose Perez</td>
                <td>Dr. Juan Perez</td>
                <td>Extraccion</td>
                <td>100.00</td>
                <td>
                    <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
            <tr>
                <td>2021-10-10</td>
                <td>Jose Perez</td>
                <td>Dr. Juan Perez</td>
                <td>Extraccion</td>
                <td>100.00</td>
                <td>
                    <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
            <tr>
                <td>2021-10-10</td>
                <td>Jose Perez</td>
                <td>Dr. Juan Perez</td>
                <td>Extraccion</td>
                <td>100.00</td>
                <td>
                    <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
            <tr>
                <td>2021-10-10</td>
                <td>Jose Perez</td>
                <td>Dr. Juan Perez</td>
                <td>Extraccion</td>
                <td>100.00</td>
                <td>
                    <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td><strong>TOTAL</strong></td>
                <td>500.00</td>
            </tr>
        </tfoot>
    </table>
    <x-slot name="footer">
    </x-slot>
</x-card>

@endsection

