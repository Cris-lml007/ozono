<div>
    <div class="d-flex justify-content-end">
        <label class="col-form-label">Desde</label>
        <input wire:model="date_start" type="date" class="form-control">
        <label class="col-form-label">Hasta</label>
        <input wire:model="date_end" type="date" class="form-control">
        <button class="btn btn-primary" wire:click="$refresh"><i class="fa fa-search"></i></button>
    </div>
    <table class="table table-striped">
        <thead>
            <th>Fecha</th>
            <th>Paciente</th>
            <th>Medico</th>
            <th>Descripción</th>
            <th>Costo</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($data as $item)
            @php
                $total += $item->canceled;
            @endphp
            <tr>
                <td>{{$item->reservation->date}}</td>
                <td>{{$item->person->surname.' '. $item->person->name}}</td>
                <td>{{$item->medic->surname.' '.$item->medic->name}}</td>
                <td>{{$item->diagnostic->description}}</td>
                <td>{{$item->canceled}}</td>
                <td>
                    <a href="{{route('dashboard.consultation',$item->reservation->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td><strong>TOTAL</strong></td>
                <td>{{$total}} Bs</td>
            </tr>
        </tfoot>
    </table>
</div>
