
<div>
    <h1>{{ $count }}</h1>

    <button wire:click="increment">+</button>

    <button wire:click="decrement">-</button>
    <div wire:poll.1000ms>
        Current time: {{ now() }}
    </div>
</div>
