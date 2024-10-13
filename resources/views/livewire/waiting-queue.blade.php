@php
    use Carbon\Carbon;
@endphp

<table class="table">
    <thead>
        <th>Hr</th>
        <th>Paciente</th>
        <th>Medico</th>
    </thead>
    <tbody>
        @foreach ($this->reservations() as $reservation)
            @if (Carbon::now()->toDateTime() >= Carbon::parse($reservation->staffSchedule->schedule->start) &&
                    Carbon::now()->toDateTime() <= Carbon::parse($reservation->staffSchedule->schedule->end))
                <tr wire:click="runConsultation({{ $reservation->id }})" style="cursor: pointer;">
                    <td class="bg-success">
                        {{ $reservation->staffSchedule->schedule->start . '-' . $reservation->staffSchedule->schedule->end }}
                    </td>
                    <td class="bg-success">{{ $reservation->person->surname . ' ' . $reservation->person->name }}</td>
                    <td class="bg-success">
                        {{ $reservation->staffSchedule->staff->person->surname . ' ' . $reservation->staffSchedule->staff->person->name }}
                    </td>
                </tr>
            @elseif(Carbon::now()->toDateTime() < Carbon::parse($reservation->staffSchedule->schedule->end))
                <tr>
                    <td>{{ $reservation->staffSchedule->schedule->start . '-' . $reservation->staffSchedule->schedule->end }}
                    </td>
                    <td>{{ $reservation->person->surname . ' ' . $reservation->person->name }}</td>
                    <td>{{ $reservation->staffSchedule->staff->person->surname . ' ' . $reservation->staffSchedule->staff->person->name }}
                    </td>
                </tr>
                {{-- @else --}}
                {{--     <tr> --}}
                {{--         <td class="bg-danger"> --}}
                {{--             {{ $reservation->staffSchedule->schedule->start . '-' . $reservation->staffSchedule->schedule->end }} --}}
                {{--         </td> --}}
                {{--         <td class="bg-danger">{{ $reservation->person->surname . ' ' . $reservation->person->name }}</td> --}}
                {{--         <td class="bg-danger"> --}}
                {{--             {{ $reservation->staffSchedule->staff->person->surname . ' ' . $reservation->staffSchedule->staff->person->name }} --}}
                {{--         </td> --}}
                {{--     </tr> --}}
            @endif
        @endforeach
    </tbody>
</table>
