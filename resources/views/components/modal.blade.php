<!-- Modal -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog {{ $option ?? '' }}" style="{{$style ?? ''}}">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-dark">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-dark">
                {{ $slot }}
            </div>
            {{-- <div class="modal-footer"> --}}
            {{--   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
            {{--   <button type="button" class="btn btn-primary">Save changes</button> --}}
            {{-- </div> --}}
        </div>
    </div>
</div>
