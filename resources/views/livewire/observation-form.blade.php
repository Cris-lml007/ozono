<div>
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
            <span class="input-group-text">Tipo</span>
            <select wire:model.live="type" class="form-select">
                <option>seleccione un Tipo</option>
                <option value=1>Efecto Secundario</option>
                <option value=0>Contraindicación</option>
            </select>
            @error('type')
            <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip" data-bs-tite="{{$message}}">
                <i class="fa fa-exclamation"></i>
            </span>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <a wire:click="restart" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</a>
        <a wire:click="updateOrCreate" class="btn btn-success" data-bs-dismiss="modal">Añadir</a>
    </div>
</div>


@script
    <script>
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
