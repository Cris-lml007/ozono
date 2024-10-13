<div>
    <div class="input-group">
        <span class="input-group-text">Buscar tratamiento</span>
        <input wire:keydown.enter="$refresh" wire:model.lazy="search_treatment" type="text" class="form-control">
        <a wire:click="$refresh" class="btn btn-primary">
            <i class="fa fa-search"></i>
        </a>
    </div>
    <div class="input-group">
        <span class="input-group-text">Tratamiento</span>
        <select wire:model.lazy="treatment" class="form-select">
            <option value="null">Seleccione</option>
            @foreach ($this->getTreatment() as $treatment)
            <option value="{{$treatment->id}}">{{$treatment->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group">
        <span class="input-group-text">Cantidad</span>
        <input wire:model.live="quantity" type="number" class="form-control">
    </div>
    <div class="input-group">
        <span class="input-group-text">Cada(Dias)</span>
        <input wire:model="by_day" type="number" class="form-control" placeholder="1">
    </div>
    <div class="input-group">
        <span class="input-group-text">Precio</span>
        <input wire:model.live="price" type="number" class="form-control" placeholder="{{$pricePlaceholder ?? '0'}} Bs">
    </div>
    <div class="input-group">
        <span class="input-group-text">Total</span>
        <input  wire:model="total" type="number" class="form-control" readonly>
    </div>
    <div class="modal-footer px-0">
        <a wire:click="restart" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancelar
        </a>
        <a wire:click="addTreatment" class="btn btn-success" data-bs-dismiss="modal">
            Añadir
        </a>
    </div>
</div>
