@php
    use App\Enums\Day;
@endphp
<div>
    <div>
        <div class="input-group">
            <span class="input-group-text">CI</span>
            <input wire:model.blur="ci" type="number" class="form-control">
            <span class="input-group-text">Expedito</span>
            {{-- <input wire:model.blur="ci" type="number" class="form-control"> --}}
            <select wire:model="exp" class="form-select">
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
            @error('ci')
                <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip" data-bs-title="{{ $message }}">
                    <i class="fa fa-exclamation"></i>
                </span>
            @enderror
        </div>
        <div class="input-group">
            <span class="input-group-text">Apellidos</span>
            <input wire:model.blur="surname" type="text" class="form-control">
            @error('surname')
                <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip" data-bs-title="{{ $message }}">
                    <i class="fa fa-exclamation"></i>
                </span>
            @enderror
        </div>
        <div class="input-group">
            <span class="input-group-text">Nombres</span>
            <input wire:model.blur="name" type="text" class="form-control">
            @error('name')
                <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip" data-bs-title="{{ $message }}">
                    <i class="fa fa-exclamation"></i>
                </span>
            @enderror
        </div>
        <div class="input-group">
            <span class="input-group-text">Genero</span>
            <select wire:model="gender" class="form-select">
                <option>Seleccione uno</option>
                <option value="0">Mujer</option>
                <option value="1">Hombre</option>
            </select>
            @error('gender')
                <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip" data-bs-title="{{ $message }}">
                    <i class="fa fa-exclamation"></i>
                </span>
            @enderror
        </div>
        <div class="input-group">
            <span class="input-group-text">Fecha de Nacimiento</span>
            <input wire:model.blur="birthdate" type="date" class="form-control">
            @error('birthdate')
                <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip" data-bs-title="{{ $message }}">
                    <i class="fa fa-exclamation"></i>
                </span>
            @enderror
        </div>
        <div class="input-group">
            <span class="input-group-text">Email</span>
            <input wire:model.blur="email" type="email" class="form-control">
            @error('email')
                <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip" data-bs-title="{{ $message }}">
                    <i class="fa fa-exclamation"></i>
                </span>
            @enderror
        </div>
        <div class="input-group">
            <span class="input-group-text">Contraseña</span>
            <input wire:model="password" class="form-control" readonly>
        </div>
        <div class="input-group">
            <span class="input-group-text">Rol</span>
            <select wire:model="role" class="form-select">
                <option>Seleccione uno</option>
                <option value="0">Administrador</option>
                <option value="1">Medico</option>
                <option value="2">Enfermera</option>
            </select>
            @error('role')
                <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip" data-bs-title="{{ $message }}">
                    <i class="fa fa-exclamation"></i>
                </span>
            @enderror
        </div>
        @if ($id)
            <div class="mt-1 table-responsive">
                <h5>Horario</h5>
                <div class="input-group">
                    <span class="input-group-text">Dia</span>
                    <select wire:model.live="daySelect" class="form-select">
                        <option>Seleccione</option>
                        <option value="1">Lunes</option>
                        <option value="2">Martes</option>
                        <option value="3">Miercoles</option>
                        <option value="4">Jueves</option>
                        <option value="5">Viernes</option>
                        <option value="6">Sabado</option>
                    </select>
                    <span class="input-group-text">Horario</span>
                    <select wire:model="schedule_day" class="form-select">
                        <option value="null">Seleccione</option>
                        @foreach ($this->getDays($this->daySelect) as $d)
                        <option value="{{$d->id}}">{{$d->start . '-'.$d->end}}</option>
                        @endforeach
                    </select>
                    <a wire:click="addSchedule" class="btn btn-primary">Agregar</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Dia</th>
                                @for ($i = 1; $i <= 24; $i++)
                                    <th>{{ $i < 10 ? 0 : '' }}{{ $i }}:00</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Day::cases() as $day)
                                @php
                                    $hr = 1;
                                @endphp
                                <tr>
                                    <th>{{ $day->display() }}</th>
                                    @foreach ($this->getScheduleByDay($day) as $schedule)
                                        @for ($i = $hr; $i <= 24; $i++)
                                            @if ($i == substr($schedule->start, 0, 2) or $i > substr($schedule->start, 0, 2))
                                                @php
                                                    $duration = substr($schedule->end, 0, 2) - substr($schedule->start, 0, 2);
                                                @endphp
                                                <td wire:click="deleteSchedule({{ $schedule->id}})"
                                                    colspan="{{ $duration }}" class="bg-success rounded table-cell"
                                                    style="margin: 0;padding: 0;">
                                                    <i class="fa fa-trash delete-icon"></i>
                                                </td>
                                                @php
                                                    $hr = $i + $duration;
                                                    break;
                                                @endphp
                                            @else
                                                <td></td>
                                            @endif
                                        @endfor
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
    <div class="modal-footer px-0">
        <a wire:click="restart" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancelar
        </a>
        @if ($id)
            <a wire:click="confirmDelete" class="btn btn-danger" data-bs-dismiss="modal">
                Eliminar
            </a>
            <a wire:click="updateOrCreate" class="btn btn-success" data-bs-dismiss="modal">
                Guardar
            </a>
        @else
            <a wire:click="updateOrCreate" class="btn btn-success">
                Nuevo Personal
            </a>
        @endif
    </div>
</div>


@section('css')
    <style>
        .table-cell {
            position: relative;
            cursor: pointer;
        }

        .table-cell:hover {
            background-color: #f8d7da;
            /* Color de fondo cuando se pasa el cursor */
        }

        .delete-icon {
            display: none;
            position: absolute;
            top: 50%;
            right: 50%;
            transform: translateY(-50%);
            color: white;
            /* Color del icono */
            font-size: 20px;
        }

        .table-cell:hover .delete-icon {
            display: block;
        }
    </style>
@endsection


@script
    <script>
        Livewire.on('showDeleteConfirmation', () => {
            Swal.fire({
                title: "Desea Eliminar?...",
                text: "Esta seguro que desea eliminar este Personal, no es recomendable su eliminación, este puede tener registos conectados.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Sí, bórralo!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.deleteStaff().then(() => {
                        Swal.fire({
                            title: "Eliminado!",
                            text: "Personal eliminado.",
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
