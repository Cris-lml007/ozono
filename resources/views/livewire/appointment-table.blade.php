<x-card title="Reservaciones">
    <div class="d-flex justify-content-end">
        <div class="input-group" style="width: 30%;">
            <label class="input-group-text">Filtrar:</label>
            <input class="form-control" type="text" wire:model="search" wire:keydown.enter="$refresh">
        </div>
        <div class="input-group" style="width: 30%;">
            <label class="input-group-text">Fecha:</label>
            <input class="form-control" type="date" wire:model="date" wire:keydown.enter="$refresh">
            <a class="btn btn-primary" wire:click="$refresh">
                <i class="fa fa-search"></i>
            </a>
        </div>
    </div>
    <table class="table table-hover table-striped" @update="$refresh">
        <thead>
            <th>Fecha</th>
            <th>Horario</th>
            <th>Paciente</th>
            <th>Medico</th>
        </thead>
        @foreach ($collection ?? [] as $item)
        <tr @if($item->history != null) style="cursor: pointer;" wire:click="showReservation({{ $item->id }})" @endif>
                <td>{{ $item->date }}</td>
                <td>{{ $item->staffSchedule->schedule->start . '-' . $item->staffSchedule->schedule->end }}</td>
                <td>{{ $item->person->surname . ' ' . $item->person->name }}</td>
                <td>{{ $item->staffSchedule->staff->person->surname . ' ' . $item->staffSchedule->staff->person->name }}
                </td>
                <td>
                    <button wire:click="deleteReservation({{ $item->id }})"
                        wire:confirm="seguo que desea borrar la reservación" class="btn btn-danger"
                        @if ($item->history != null) {{ 'disabled' }} @endif>
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        <tbody>
        </tbody>
    </table>
    <x-slot name="footer">
        <div class="d-flex justify-content-end">
            {{ $collection->links() }}
        </div>
    </x-slot>
</x-card>
