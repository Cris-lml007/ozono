<div>
    <div class="input-group">
        <span class="input-group-text">Nombre</span>
        <input wire:model.live="name" type="text" class="form-control">
        @error('name')
            <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip" data-bs-title="{{ $message }}">
                <i class="fa fa-exclamation"></i>
            </span>
        @enderror
    </div>
    <div class="input-group">
        <span class="input-group-text">Precio</span>
        <input wire:model.live="price" type="number" class="form-control">
        @error('price')
            <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip" data-bs-title="{{ $message }}">
                <i class="fa fa-exclamation"></i>
            </span>
        @enderror
    </div>
    <div class="form-floating">
        <textarea class="form-control" wire:model.live="description"></textarea>
        <label>Descripción</label>
        @error('description')
            <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip" data-bs-title="{{ $message }}">
                <i class="fa fa-exclamation"></i>
            </span>
        @enderror
    </div>
    <div class="mt-1" @if (!$idT) hidden @endif>
        <div class="d-flex justify-content-between mb-1">
            <div class="d-flex align-items-end">
                <h5>Observaciones</h5>
            </div>
        </div>
        <div>
            <div class="input-group m-1">
                <select class="form-select" wire:model="selectObservation">
                    <option value="">Selecione una Observación</option>
                    @foreach ($listOb as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <a class="btn btn-success" wire:click="addObservation">
                    <i class="fa fa-plus"></i>Añadir
                </a>
            </div>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($observations ?? [] as $observation)
                    <tr>
                        <td>{{ $observation->name }}</td>
                        <td>{{ $observation->type }}</td>
                        <td>
                            <a class="btn btn-danger" wire:click="deleteObservation({{ $observation->id }})">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a wire:click="restart" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
        @if (!$idT)
            <a id="btnDelete" wire:click="updateOrCreate" class="btn btn-success">Nuevo Tratamiento</a>
        @else
            <a wire:click="confirmDelete" class="btn btn-danger" data-bs-dismiss="modal">Eliminar</a>
            <a wire:click="updateOrCreate" class="btn btn-success" data-bs-dismiss="modal">Guardar</a>
        @endif
    </div>
</div>

@script
    <script>
        Livewire.on('showDeleteConfirmation', () => {
            Swal.fire({
                title: "Desea Eliminar?...",
                text: "Esta seguro que desea eliminar este Tratamiento",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Sí, bórralo!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.deleteTreatment().then(() => {
                        Swal.fire({
                            title: "Eliminado!",
                            text: "Tratamiento ha sido eliminado.",
                            icon: "success"
                        });
                    });
                }
            });
        });
        Livewire.hook('morph.updated', ({
            component,
            cleanup
        }) => {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
                tooltipTriggerEl))
        })
    </script>
@endscript
