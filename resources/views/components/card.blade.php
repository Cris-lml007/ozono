<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $title ?? '' }}</h5>
        {{ $slot }}
    </div>
    <div class="card-footer">
        {{ $footer }}
    </div>
</div>
