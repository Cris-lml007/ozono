@php
    use App\Enums\Day;
@endphp

<div class="">
    <div class="border mt-4 p-1 rounded">
        <div class="input-group d-flex justify-content-around mt-1">
            <div class="btn-group " role="group" aria-label="Basic checkbox toggle button group">
                @foreach (Day::cases() as $day)
                    <div class="form-check mx-2">
                        <input class="btn-check" type="checkbox" wire:click="toggleDays({{ $day }})"
                            id="{{ $day }}">
                        <label class="btn btn-outline-primary" for="{{ $day }}">
                            {{ $day->display() }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="input-group">
            <span class="input-group-text">Inicio</span>
            <input wire:model="start" type="time" class="form-control" step="3600">
            @error('start')
                <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip" data-bs-title="{{ $message }}">
                    <i class="fa fa-exclamation"></i>
                </span>
            @enderror
            <span class="input-group-text">Fin</span>
            <input wire:model="end" type="time" class="form-control" step="3600">
            @error('end')
                <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip" data-bs-title="{{ $message }}">
                    <i class="fa fa-exclamation"></i>
                </span>
            @enderror
            <a wire:click="save" class="btn btn-success">Agregar</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Dia</th>
                    @for ($i = 7; $i <= 24; $i++)
                        <th>{{ $i < 10 ? 0 : '' }}{{ $i }}:00</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach (Day::cases() as $day)
                    @php
                        $hr = 7;
                    @endphp
                    <tr>
                        <th>{{ $day->display() }}</th>
                        @foreach ($this->getDays($day) as $schedule)
                            @for ($i = $hr; $i <= 24; $i++)
                                @if ($i == substr($schedule->start, 0, 2) or $i > substr($schedule->start, 0, 2))
                                    @php
                                        $duration = substr($schedule->end, 0, 2) - substr($schedule->start, 0, 2);
                                    @endphp
                                    <td wire:click="delete({{ $schedule->id }})" colspan="{{ $duration }}"
                                        class="bg-success rounded table-cell" style="margin: 0;padding: 0;">
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
    {{-- <h5 class="card-text">Tratamiento por Defecto</h5> --}}
    {{-- <div class="input-group"> --}}
    {{--     <span class="input-group-text">Tratamiento por Defecto</span> --}}
    {{--     <select wire:model.live="treatment" class="form-select"> --}}
    {{--         <option value="null">Ninguno</option> --}}
    {{--         @foreach ($this->getTreatments() as $treatment) --}}
    {{--             <option value="{{ $treatment->id }}">{{ $treatment->name }}</option> --}}
    {{--         @endforeach --}}
    {{--     </select> --}}
    {{-- </div> --}}
    {{-- <div class="form-check"> --}}
    {{--     <input wire:model.live="first_free" class="form-check-input" type="checkbox"> --}}
    {{--     <span class="form-check-label">Primera Consulta Gratis</span> --}}
    {{-- </div> --}}
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
