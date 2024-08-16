<x-card title="{{ $title ?? '' }}">
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
            @foreach ($heads ?? [] as $name => $value)
                <th><input type="radio" name="{{ $model }}" wire:model="headSelect"
                        value="{{ $value }}"@if ($value == $headSelect) checked @endif> {{ $name }}
                </th>
            @endforeach
        </thead>
        @foreach ($collection ?? [] as $item)
            <tr>
                @foreach ($heads ?? [] as $name)
                    <td>{{ $item->$name }}</td>
                @endforeach
                <td style="width: 30%;">
                    <a class="btn btn-primary" wire:click="edit({{ $item->id }})"
                        @if ($modal) data-bs-toggle="modal" data-bs-target="#{{ $modal }}" @endif>
                        <i class="fa fa-pen"></i>
                    </a>
                    @if (!$onDelete)
                        <a @class([
                            'btn',
                            'btn-danger' => !$item->active,
                            'btn-success' => $item->active,
                        ]) wire:click="toggleStatus({{ $item->id }})">
                            <i class="fa fa-power-off"></i>
                        </a>
                    @else
                    <a wire:click="delete({{$item->id}})" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </a>
                    @endif
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
