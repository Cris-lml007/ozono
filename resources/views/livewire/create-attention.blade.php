@php
    use App\Enums\Day;
    use App\Models\Treatment;
@endphp

<div>
    <h5>Paciente</h5>
    <div class="d-flex">
        <div style="width: 100%;">
            <div class="input-group">
                <span class="input-group-text">CI</span>
                <input wire:model.live="ci" wire:blur="getPerson" class="form-control" type="number">
                <select wire:model="exp" class="form-select" @if ($this->person != null) disabled @endif>
                    <option value="OR">OR</option>
                    <option value="LP">LP</option>
                    <option value="SCZ">SCZ</option>
                    <option value="TJA">TJA</option>
                    <option value="PD">PD</option>
                    <option value="CBBA">CBBA</option>
                    <option value="CH">CH</option>
                    <option value="BE">BE</option>
                    <option value="PT">PT</option>
                    <option value="EX">EX</option>
                </select>
                <a wire:click="getPerson" class="btn btn-primary"><i class="fa fa-search"></i></a>
                @error('ci')
                    <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip"
                        data-bs-title="{{ $message }}">
                        <i class="fa fa-exclamation"></i>
                    </span>
                @enderror
                <div class="input-group">
                    <span class="input-group-text">Apellidos</span>
                    <input wire:model.live="surname" class="form-control" type="text"
                        @if ($this->person != null) readonly @endif>
                    @error('surname')
                        <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip"
                            data-bs-title="{{ $message }}">
                            <i class="fa fa-exclamation"></i>
                        </span>
                    @enderror
                </div>
                <div class="input-group">
                    <span class="input-group-text">Nombres</span>
                    <input wire:model.live="name" class="form-control" type="text"
                        @if ($this->person != null) readonly @endif>
                    @error('name')
                        <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip"
                            data-bs-title="{{ $message }}">
                            <i class="fa fa-exclamation"></i>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-text">Fecha de Nacimiento</span>
                <input wire:model="birthdate" class="form-control" type="date"
                    @if ($this->person != null) readonly @endif>
                @error('birthdate')
                    <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip"
                        data-bs-title="{{ $message }}">
                        <i class="fa fa-exclamation"></i>
                    </span>
                @enderror
            </div>
            <div class="input-group">
                <span class="input-group-text">Genero</span>
                <select wire:model="gender" class="form-select"
                    @if ($this->person != null) readonly disabled @endif>
                    <option selected>Seleccione</option>
                    <option value="1">Hombre</option>
                    <option value="0">Mujer</option>
                </select>
                @error('gender')
                    <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip"
                        data-bs-title="{{ $message }}">
                        <i class="fa fa-exclamation"></i>
                    </span>
                @enderror
            </div>
            <div class="input-group">
                <span class="input-group-text">Patologias</span>
                <textarea wire:model="pathological" rows="1" class="form-control" @if ($this->person != null) readonly @endif></textarea>
            </div>
            <div class="input-group">
                <span class="input-group-text">Alergias</span>
                <textarea wire:model="allergies" rows="1" class="form-control" @if ($this->person != null) readonly @endif></textarea>
            </div>
            <div class="input-group">
                <span class="input-group-text">Cirugias</span>
                <textarea wire:model="surgeries" rows="1" class="form-control" @if ($this->person != null) readonly @endif></textarea>
            </div>
        </div>
    </div>
    <h5>Horario</h5>
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
                <i class="fa fa-exclamation"></i>
            </span>
        @enderror
    </div>
    <div class="modal-footer px-0">
        <a wire:click="restart" data-bs-dismiss="modal" class="btn btn-danger">Cancelar</a>
        <a wire:click="createAttention" class="btn btn-success">Registrar Atención</a>
    </div>
</div>

{{-- @section('js') --}}
{{-- <script> --}}
{{-- --}}
{{--     const video = document.getElementById('video'); --}}
{{-- --}}
{{--     if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) { --}}
{{--         navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) { --}}
{{--             video.srcObject = stream; --}}
{{--             video.play(); --}}
{{--         }); --}}
{{--     } --}}
{{-- </script> --}}
{{-- @endsection --}}


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
