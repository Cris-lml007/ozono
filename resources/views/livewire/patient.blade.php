@php
    use Carbon\Carbon;
@endphp

<x-card title="Lista de Pacientes">
    <div class="d-flex justify-content-end">
        <div class="input-group" style="width: 30%;">
            <label class="input-group-text">Filtrar:</label>
            <input class="form-control" type="text" wire:model="search" wire:keydown.enter="$refresh">
            <a class="btn btn-primary" wire:click="$refresh">
                <i class="fa fa-search"></i>
            </a>
        </div>
    </div>
    <table class="table table-hover table-striped" @update="$refresh">
        <thead>
            <th>CI</th>
            <th>Apellidos</th>
            <th>Nombres</th>
            <th>Edad</th>
        </thead>
        @foreach ($collection ?? [] as $item)
        <tr wire:click="gethistory({{$item->id}})" style="cursor: pointer;">
                <td>{{ $item->ci }}</td>
                <td>{{ $item->surname }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ Carbon::now()->year - Carbon::parse($item->birthdate)->year }}</td>
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
