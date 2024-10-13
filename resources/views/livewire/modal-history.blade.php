<div>
    <h5 class="card-text mt-1">Signos Vitales</h5>
    <div class="input-group">
        <span class="input-group-text"><i class="nf nf-fa-calendar"></i></span>
        <input wire:model="date" type="date" class="form-control" disabled>
        <span class="input-group-text"><i class="nf nf-weather-time_12"></i></span>
        <input wire:model="schedule_time" type="text" class="form-control" disabled>
    </div>
    <div class="input-group">
        <span class="input-group-text"><i class="nf nf-fa-droplet"></i></span>
        <input wire:model="presure" type="text" class="form-control" placeholder="Presion Arterial(mmHg)" disabled>
        <span class="input-group-text">mmHg</span>
        <span class="input-group-text"><i class="fa fa-temperature-low"></i></span>
        <input wire:model="temperature" type="number" class="form-control" placeholder="Temperatura(C°)" disabled>
        <span class="input-group-text">C°</span>
    </div>
    <div class="input-group">
        <span class="input-group-text"><i class="nf nf-fa-heart_pulse"></i></span>
        <input wire:model="heart_rate" type="number" class="form-control" placeholder="Frecuencia Cardiaca(x Minuto)"
            disabled>
        <span class="input-group-text">lpm</span>
        <span class="input-group-text"><i class="nf nf-fa-lungs"></i></span>
        <input wire:model="respiratory_rate" type="number" class="form-control"
            placeholder="Frecuencia Respiratoria(x Minuto)" disabled>
        <span class="input-group-text">rpm</span>
    </div>
    <div class="input-group">
        <span class="input-group-text"><i class="nf nf-md-scale_bathroom"></i></span>
        <input wire:model.live="weight" type="number" class="form-control" placeholder="Peso(Kg)" disabled>
        <span class="input-group-text">Kg</span>
        <span class="input-group-text"><i class="nf nf-md-human_male_height"></i></span>
        <input wire:model.live="height" type="number" class="form-control" placeholder="Altura(cm)" disabled>
        <span class="input-group-text">cm</span>
    </div>
    <div class="input-group">
        <span class="input-group-text"><i class="nf nf-md-scale"></i></span>
        <input wire:model="imc" type="number" class="form-control" placeholder="IMC" readonly>
        <span class="input-group-text"><i class="nf nf-fa-person"></i></span>
        <input wire:model="imcStatus" type="text" class="form-control" placeholder="Estado" readonly>
    </div>
    <div class="mb-3">
        <span class="form-label">Nota de Evolución</span>
        <textarea wire:model="evaluation" class="form-control" rows="" cols="" disabled></textarea>
    </div>
    <div class="input-group">
        <span class="input-group-text">Cancelado</span>
        <input  wire:model="canceled" type="number" class="form-control" disabled>
    </div>
    <div class="d-flex justify-content-between mt-1">
        <a wire:click="prev" class="btn btn-primary">
            <i class="nf nf-cod-arrow_left"></i>
        </a>
        <a wire:click="next" class="btn btn-primary">
            <i class="nf nf-cod-arrow_right"></i>
        </a>
    </div>
</div>
