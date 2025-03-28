<div>
    <div class="d-flex justify-content-end">
        <label class="col-form-label">Desde</label>
        <input wire:model="date_start" type="date" class="form-control">
        <label class="col-form-label">Hasta</label>
        <input wire:model="date_end" type="date" class="form-control">
        <button wire:click="$refresh" class="btn btn-primary"><i class="fa fa-search"></i></button>
    </div>
    <div class="d-flex">
        <div class="input-group">
            <label class="input-group-text" for="c1">Completado</label>
            <div class="form-control">
                <input wire:model="complete" type="checkbox" class="form-check" id="c1">
            </div>
        </div>
        <div class="input-group">
            <label class="input-group-text" for="c2">No Completado</label>
            <div class="form-control">
                <input wire:model="incomplete" type="checkbox" class="form-check" id="c2">
            </div>
            <div class="input-group">
                <label class="input-group-text" for="c3">No Cancelado</label>
                <div class="form-control">
                    <input wire:model="not_canceled" type="checkbox" class="form-check" id="c3">
                </div>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <th>Fecha</th>
            <th>Paciente</th>
            <th>Medico</th>
            <th>Tratamiento</th>
            <th>Cancelado</th>
            <th>Total</th>
            <th>Estado</th>
        </thead>
        <tbody>
            @foreach ($data as $item)
                @php
                    $value =
                        $item->detailDiagnostic->diagnostic
                            ->detail_diagnostics()
                            ->selectRaw('SUM(price * quantity) as total')
                            ->value('total') == $item->canceled
                            ? 1
                            : ($item->canceled == 0
                                ? 3
                                : 2);
                @endphp
                @if ($value == ($complete ? 1 : 0) || $value == ($incomplete ? 2 : 0) || $value == ($not_canceled ? 3 : 0))
                    @php
                        $total += $item->canceled;
                        $neto = $item->detailDiagnostic->diagnostic
                            ->detail_diagnostics()
                            ->selectRaw('SUM(price * quantity) as total')
                            ->value('total');
                    @endphp
                    <tr>
                        <td>{{ $item->reservation->date }}</td>
                        <td>{{ $item->person?->surname . ' ' . $item->person?->name }}</td>
                        <td>{{ $item->medic?->surname . ' ' . $item->medic?->name }}</td>
                        <td>{{ $item->detailDiagnostic->diagnostic->description }}</td>
                        <td>{{ $item->canceled }}</td>
                        <td>{{ $neto }}</td>
                        <td>
                            <span
                                class="badge {{ $neto == $item->canceled ? 'badge-success' : ($neto == 0 ? 'badge-danger' : 'badge-warning') }}">
                                {{ $neto == $item->canceled ? 'Completado' : ($neto == 0 ? 'No Cancelado' : 'No Completado') }}
                            </span>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td><strong>TOTAL</strong></td>
                <td>{{ $total }} Bs</td>
            </tr>
        </tfoot>
    </table>
