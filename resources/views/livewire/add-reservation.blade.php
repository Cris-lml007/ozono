<div>
    <div class="input-group">
        <span class="input-group-text">Dia</span>
        <input wire:model.live="date" type="date" class="form-control">
        @error('day')
            <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip" data-bs-title="{{ $message }}">
                <i class="fa fa-exclamation"></i>
            </span>
        @enderror
        <span class="input-group-text">Horario</span>
        <select wire:model.lazy="hour" class="form-select">
            <option value=null>Seleccione</option>
            @foreach ($this->getHours() as $hour)
                <option value="{{ $hour->id }}">{{ $hour->start . '-' . $hour->end }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group">
        <span class="input-group-text">Medico</span>
        <select wire:model="medic" class="form-select">
            <option value=null>Seleccione</option>
            @foreach ($this->getMedics() as $schedule)
                <option value="{{ $schedule->staff_schedule_id }}">
                    {{ $schedule->staff->person->surname . ' ' . $schedule->staff->person->name }}</option>
            @endforeach
        </select>
        @error('medic')
            <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip" data-bs-title="{{ $message }}">
                <i class="nf nf-fa-exclamation"></i>
            </span>
        @enderror
    </div>
    <div class="modal-footer px-0">
        <a wire:click="restart" data-bs-dismiss="modal" class="btn btn-danger">Cancelar</a>
        <a wire:click="createAttention" class="btn btn-success">Registrar Reservación</a>
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
