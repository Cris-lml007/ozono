@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Historial Clinico</h1>
        <a href="{{ route('dashboard.history', $person->id) }}" class="btn btn-success"><i class="fa fa-file-export"></i>
            Exportar</a>
    @endsection
    <div>
        <x-card title="">
            <h5 class="card-text">Informacion Personal</h5>
            <div class="input-group">
                <span class="input-group-text">CI</span>
                <input wire:model="ci" class="form-control" type="number" readonly>
            </div>
            <div class="input-group">
                <span class="input-group-text">Apellidos</span>
                <input wire:model="surname" class="form-control" type="text" readonly>
                <span class="input-group-text">Nombre</span>
                <input wire:model="name" class="form-control" type="text" readonly>
            </div>
            <div class="input-group">
                <span class="input-group-text">edad</span>
                <input wire:model="birthdate" class="form-control" type="number" readonly>
                <span class="input-group-text">Años</span>
                <span class="input-group-text">Genero</span>
                <input wire:model="gender" class="form-control" type="text" readonly>
            </div>
            <div class="input-group">
                <span class="input-group-text">Patologias</span>
                <textarea wire:model="pathological" rows="1" class="form-control" readonly></textarea>
            </div>
            <div class="input-group">
                <span class="input-group-text">Alergias</span>
                <textarea wire:model="allergies" rows="1" class="form-control" readonly></textarea>
            </div>
            <div class="input-group">
                <span class="input-group-text">Cirugias</span>
                <textarea wire:model="surgeries" rows="1" class="form-control" readonly></textarea>
            </div>

            @if (!$open_diagnostic)
                <h5 class="card-text mt-1">Diagnosticos</h5>
                <div>
                    <table class="table table-striped">
                        <thead>
                            <th>Id</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                        </thead>
                        <tbody>
                            @foreach ($diagnostics ?? [] as $diag)
                                <tr wire:click="getDiagnostic({{ $diag->id }})" style="cursor: pointer;">
                                    <td>{{ $diag->id }}</td>
                                    <td>{{ $diag->description }}</td>
                                    <td>{{ $diag->status == 1 ? 'En progreso' : 'Finalizado' }}</td>
                                    <td>
                                        <button wire:click="getDiagnostic({{ $diag->id }})"
                                            class="btn btn-primary"><i class="fa fa-eye"></i></button>
                                        <a href="{{ route('consent', $diag->id) }}" class="btn btn-primary">
                                            <i class="fa fa-file"></i>
                                        </a>
                                        <a href="{{ route('dashboard.payment', $diag->id) }}"
                                            class="btn btn-secondary"><i class="fa fa-money-bill"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h5 class="card-text">Valoración del Dolor</h5>
                <div class="d-flex">
                    <div id="body-part" wire:ignore class="human-body">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 68.587668 92.604164"
                            style="background-color: #007BFF;border-radius: 5%;">
                            <path
                                d="m 11.671635,6.3585449 -0.0482,-2.59085 4.20648,-2.46806 4.42769,2.95361 -0.0405,1.94408 0.24197,-3.34467 -2.03129,-2.31103004 -2.84508,-0.51629 -2.20423,0.52915 -1.9363,2.63077004 z"
                                id="cabeza" class=" body-part"></path>
                            <path
                                d="m 19.748825,6.7034949 0.0203,-2.20747 -3.96689,-2.7637 -3.74099,2.23559 -0.006,2.63528 -0.60741,0.0403 0.27408,1.82447 0.97635,0.33932 0.44244,2.1802901 1.82222,2.06556 2.03518,-0.0607 1.79223,-1.94408 0.35957,-2.2406601 0.97616,-0.33932 0.25159,-1.78416 z"
                                id="rostro" class="body-part"></path>
                            <path id="cuello"
                                d="m 13.304665,11.910505 1.64975,2.35202 0.74426,2.62159 -1.73486,-1.38354 -0.86649,-2.97104 z m 5.08047,0 -1.64975,2.35202 -0.74538,2.62234 1.73486,-1.38354 0.86649,-2.97104 z"
                                class="body-part"></path>
                            <path id="hombro izquierdo"
                                d="m 19.047795,13.248365 3.55748,1.97916 0.72653,-0.35074 z m -0.107,0.43288 -0.37119,1.73073 2.1846,0.53561 1.40116,-0.49436 z m 3.98151,1.97595 0.75814,-0.41 2.40806,1.66799 1.17364,1.50707 0.62662,1.5626 -0.0464,3.70194 -1.3284,-1.72153 0.0407,-2.59376 -0.48842,-0.50049 c 0,0 -3.09778,-3.19058 -3.14371,-3.21401 z m -0.2409,0.10873 c -0.001,0.0525 3.32987,3.54733 3.32987,3.54733 l 0.10067,3.10396 -1.15426,-1.97782 -2.22547,-0.94804 -1.56576,-2.88481 z"
                                class="body-part"></path>
                            <path id="hombro derecho"
                                d="m 12.624785,13.248365 -3.5574599,1.97916 -0.72653,-0.35074 z m 0.107,0.43288 0.37119,1.73073 -2.18459,0.53561 -1.4011499,-0.49436 z m -3.9814899,1.97595 -0.75814,-0.41 -2.40806,1.66799 -1.17364,1.50707 -0.62662,1.56259 0.0464,3.70195 1.3284,-1.72153 -0.0407,-2.59376 0.48843,-0.5005 c 0,0 3.09777,-3.19057 3.1437,-3.214 z m 0.2409,0.10873 c 0.002,0.0525 -3.32987,3.54733 -3.32987,3.54733 l -0.10067,3.10396 1.15426,-1.97782 2.22547,-0.94804 1.5657499,-2.88481 z"
                                class="body-part"></path>
                            <path id="brazo izquierdo"
                                d="m 27.621665,30.814715 -0.33838,1.70499 -1.81932,-2.54418 -0.6629,-1.26895 z m -2.85271,-2.6096 c -0.0259,-0.0144 -0.0536,-0.0254 -0.0824,-0.0324 l -1.48333,-4.95503 1.00456,-2.08428 1.65511,1.74532 2.23034,6.67667 0.0415,0.93739 c -1.06528,-0.84215 -2.18962,-1.60679 -3.36434,-2.28803 z m 1.6945,-5.75654 1.64893,6.43421 -0.36469,-4.92266 z"
                                class="body-part"></path>
                            <path id="antebrazo izquierdo"
                                d="m 26.955425,32.969125 1.30083,10.28927 -1.10778,0.01 -1.89387,-7.99609 0.19174,-4.53719 z m 1.21978,-1.94971 -0.58729,2.58635 1.11876,9.15614 0.55849,-0.21663 0.2304,-6.77018 z"
                                class="body-part"></path>
                            <path id="brazo derecho"
                                d="m 4.0746451,30.814715 0.33838,1.70499 1.81931,-2.54418 0.66289,-1.26895 z m 2.8527,-2.6096 c 0.0259,-0.0144 0.0536,-0.0254 0.0824,-0.0324 l 1.48332,-4.95503 -1.00455,-2.08428 -1.65509,1.74532 -2.23034,6.67667 -0.0415,0.93739 c 1.06528,-0.84215 2.18961,-1.60679 3.36433,-2.28803 z m -1.6945,-5.75654 -1.64891,6.43421 0.36468,-4.92266 z"
                                class="body-part"></path>
                            <path id="antebrazo derecho"
                                d="m 4.5752651,32.969125 -1.30083,10.28927 1.10778,0.01 1.89387,-7.99609 -0.19174,-4.53719 z m -1.21978,-1.94971 0.58728,2.58635 -1.11875,9.15614 -0.55849,-0.21663 -0.2304,-6.77018 z"
                                class="body-part"></path>
                            <path
                                d="m 20.337455,17.085495 1.72942,3.09103 1.89346,0.94785 -1.15295,0.90662 -0.90604,2.63773 -2.09968,0.86537 -3.34524,-1.655 0.83425,-6.50527 z"
                                id="pecho izquierdo" class="body-part"></path>
                            <path
                                d="m 11.351215,17.085495 -1.7294199,3.09103 -1.89346,0.94785 1.15295,0.90662 0.90586,2.63773 2.0996699,0.86537 3.34636,-1.655 -0.83462,-6.50527 z"
                                id="pecho derecho" class="body-part"></path>
                            <path
                                d="m 19.641935,34.707615 1.81341,-1.36479 0.15748,1.83347 1.28642,2.37338 -1.98044,2.73652 -1.03109,0.16554 -0.37026,-3.88816 z"
                                id="vientre izquierdo" class="body-part"></path>
                            <path id="costillas izquierdas"
                                d="m 19.288925,26.151995 -3.11202,-1.40604 0.0937,2.27965 2.80119,1.43603 z m 1.93471,1.66849 -1.29355,0.7212 0.14997,-1.70898 z m -1.05303,-1.63718 2.47968,-1.03241 -0.9336,2.52093 z m 1.53164,1.73729 -1.69005,1.03372 -0.28871,2.0678 1.64975,-1.07533 z m -2.91143,1.10421 -0.0622,1.62387 -2.30308,-0.49961 -0.12448,-2.21722 z m -0.1556,2.4045 0.0311,1.99844 -2.20953,0.59391 -0.0311,-3.1227 z m 2.65459,-0.98535 -1.48383,1.03372 -0.20622,2.10905 1.64862,-1.32355 z"
                                class="body-part"></path>
                            <path
                                d="m 12.045985,34.707615 -1.81341,-1.36479 -0.15748,1.83347 -1.2856799,2.37432 1.9804499,2.73595 1.03109,0.16554 0.37119,-3.88721 z"
                                id="vientre derecho" class="body-part"></path>
                            <path id="barriga"
                                d="m 15.636055,44.919735 -0.60647,-5.91209 -0.015,-3.84879 -2.18479,-1.07533 -0.24746,7.03017 z m 0.41581,-5.7e-4 0.60628,-5.91209 0.0154,-3.84915 2.18404,-1.07515 0.24746,7.03017 z"
                                class="body-part"></path>
                            <path id="costillas derechas"
                                d="m 12.399365,26.152365 3.11202,-1.40603 -0.0937,2.27965 -2.80138,1.4364 z m -1.93508,1.6685 1.29355,0.72139 -0.14997,-1.70899 z m 1.05303,-1.637 -2.4793099,-1.03259 0.93361,2.52148 z m -1.5316399,1.73729 1.6900499,1.03372 0.28871,2.06743 -1.64881,-1.07515 z m 2.9114199,1.10421 0.0623,1.62387 2.30327,-0.49961 0.12448,-2.21703 z m 0.15561,2.40432 -0.0309,1.99844 2.20973,0.59353 0.0311,-3.1227 z m -2.6546,-0.98516 1.48384,1.0339 0.20622,2.10905 -1.64975,-1.32355 z"
                                class="body-part"></path>
                            <path id="muslo izquierdo"
                                d="m 23.419015,50.399125 -0.15504,4.75091 -2.40263,6.60949 0.7362,1.90021 2.36401,-8.34435 z m -0.58154,-11.60825 -0.15485,4.00722 1.31793,7.93154 0.61977,-6.40308 z m -0.38731,5.12268 -2.75152,6.07258 -0.62015,4.87425 1.16232,6.85771 2.51886,-6.98144 0.15504,-7.18764 z"
                                class="body-part"></path>
                            <path id="muslo interno izquierdo"
                                d="m 22.063225,39.369605 v 4.21363 l -2.94574,5.82511 -1.86027,5.78349 0.19365,-4.0072 z m -3.24944,13.42596 -0.0649,0.15467 -1.21294,2.90207 0.78325,7.18803 1.23619,-0.66122 -1.0714,-6.69272 z"
                                class="body-part"></path>
                            <path
                                d="m 17.255895,87.868445 0.1243,3.45228 0.28983,1.20638 h 0.87136 l 0.24897,-0.83181 0.29058,-0.0416 -0.0624,0.83181 1.09914,-0.33332 0.29058,-0.16629 1.24444,-0.27033 0.0416,-0.97748 -1.20319,-2.03743 -0.82974,-1.0399 -2.03294,-0.83181 z"
                                id="pies izquierdos" class="body-part"></path>
                            <path id="pantorrilla izquierda"
                                d="m 18.251375,70.441125 0.29058,0.91486 0.6224,3.8681 0.0829,5.15733 -0.87136,5.03304 0.0412,-6.44714 -0.91242,-2.57848 -0.12561,-2.82837 z m 1.9915,2.32915 -0.20753,7.73637 -1.65949,6.23904 1.80478,-0.853 3.00816,-10.83583 -1.03727,-6.82095 z"
                                class="body-part"></path>
                            <path id="rodilla izquierda"
                                d="m 21.404635,64.784375 0.1243,1.12295 -0.87118,1.08171 -0.29058,1.70599 -0.58116,0.24933 -0.49774,-2.57866 -0.33182,-0.91486 0.29058,-0.58247 z m -3.85853,0.0832 0.6224,1.74685 1.3273,2.57867 -0.33182,2.37095 -0.95423,-2.66209 -0.78738,-1.49734 z m 4.97811,-2.37039 -0.95423,5.11609 0.62241,-0.33295 0.49773,1.66381 z"
                                class="body-part"></path>
                            <path id="muslo derecho"
                                d="m 8.2694651,50.399125 0.15504,4.75053 2.4026299,6.60968 -0.73638,1.90021 -2.3640099,-8.34435 z m 0.58117,-11.60768 0.15503,4.00684 -1.31754,7.93154 -0.61978,-6.40308 z m 0.38769,5.1223 2.7515099,6.07239 0.61997,4.87425 -1.16232,6.85771 -2.5190499,-6.98163 -0.15504,-7.18801 z"
                                class="body-part"></path>
                            <path id="genitales"
                                d="m 14.404465,45.040075 0.0221,-0.0277 -0.14866,-0.37945 -3.10172,-3.40449 -0.23283,-0.0825 2.05918,5.32009 z m -1.17263,2.01833 1.27705,3.29948 0.42631,-4.04862 -0.25196,-0.64303 z m 4.05219,-2.01795 -0.0221,-0.0281 0.14867,-0.37926 3.10171,-3.40449 0.23246,-0.0825 -2.05843,5.3199 z m 1.17263,2.01795 -1.27706,3.29948 -0.42631,-4.04843 0.25197,-0.64303 z"
                                class="body-part"></path>
                            <path id="interior del muslo derecho"
                                d="m 9.6258251,39.369415 v 4.21363 l 2.9451699,5.8253 1.86028,5.78349 -0.19366,-4.0072 z m 3.2488699,13.42559 0.0647,0.15485 1.21294,2.90207 -0.78307,7.18803 -1.23618,-0.66102 1.0714,-6.69273 z"
                                class="body-part"></path>
                            <path
                                d="m 14.433335,87.868265 -0.12448,3.45228 -0.29058,1.20637 h -0.87118 l -0.24877,-0.83181 -0.29059,-0.0416 0.0623,0.83181 -1.09934,-0.33333 -0.29058,-0.16629 -1.2448,-0.27033 -0.0412,-0.97747 1.2031899,-2.03781 0.82975,-1.04009 2.03294,-0.83181 z"
                                id="pies derechos" class="body-part"></path>
                            <path id="pantorrilla derecha"
                                d="m 13.437675,70.440945 -0.29058,0.91486 -0.62241,3.86828 -0.0829,5.15733 0.87174,5.03304 -0.0418,-6.44714 0.91298,-2.57848 0.1243,-2.82837 z m -1.99151,2.32914 0.20735,7.73637 1.65968,6.23904 -1.80497,-0.85299 -3.0079799,-10.83584 1.03728,-6.82095 z"
                                class="body-part"></path>
                            <path id="rodilla derecha"
                                d="m 10.284405,64.784375 -0.12448,1.12295 0.87118,1.08171 0.29058,1.70599 0.58116,0.24933 0.49774,-2.57866 0.33182,-0.91486 -0.29058,-0.58247 z m 3.85854,0.0832 -0.62241,1.74685 -1.32767,2.57867 0.33182,2.37095 0.95423,-2.66209 0.78832,-1.4964 z m -4.9786799,-2.37058 0.9542299,5.11609 -0.6223999,-0.33313 -0.49793,1.6638 z"
                                class="body-part"></path>
                            <path d="m 3.2054751,27.370125 0.005,3.09419 -0.57959,1.91184 -0.54539,-2.41185 z"
                                id="codo derecho" class="body-part"></path>
                            <path
                                d="m 4.3904451,43.563145 -1.5198,0.0506 -0.76631,-0.67112 -1.21261996,2.15767 -0.86245,3.32873 0.49386,0.22113 0.59814996,-2.20238 0.50016,0.25356 -0.35639,2.49422 0.62382,0.24345 0.41402,-2.49194 0.55839,0.17851 -0.2262,2.76603 0.76938,0.32268 0.25788,-2.86764 0.4578,-0.0181 0.16611,2.65239 0.65997,0.2633 0.0712,-4.56643 0.34158,-0.19428 1.35316,1.68367 0.32832,-0.34354 -0.72644,-2.0551 z"
                                id="mano derecha" class="body-part"></path>
                            <path d="m 28.325215,27.370125 -0.005,3.09419 0.57959,1.91184 0.54538,-2.41185 z"
                                id="codo izquierdo" class="body-part"></path>
                            <path
                                d="m 27.140245,43.563145 1.5198,0.0506 0.76631,-0.67111 1.21262,2.15766 0.86245,3.32873 -0.49386,0.22113 -0.59815,-2.20238 -0.50016,0.25356 0.35639,2.49422 -0.62382,0.24345 -0.41402,-2.49194 -0.55839,0.17851 0.2262,2.76603 -0.76938,0.32268 -0.25788,-2.86764 -0.4578,-0.0181 -0.16611,2.6524 -0.65997,0.26329 -0.0712,-4.56643 -0.34158,-0.19428 -1.35316,1.68368 -0.32832,-0.34355 0.72644,-2.0551 z"
                                id="manos izquierdas" class="body-part"></path>
                            <path id="brazo izquierdo"
                                d="m 43.185645,27.069445 0.4297,-1.4164 1.30458,-1.68577 -1.39393,-2.96155 -2.28367,0.92162 -1.83567,1.7467 -0.53524,1.78673 0.27068,4.30806 z m -2.46869,15.35539 -1.5182,0.0863 -0.78184,-0.65295 -1.16168,2.1855 -0.78414,3.34805 0.49892,0.20949 0.54632,-2.2158 0.50597,0.24175 -0.29779,2.5019 0.62936,0.22875 0.35546,-2.50096 0.56242,0.16536 -0.16126,2.77057 0.77674,0.30455 0.19056,-2.87291 0.45724,-0.0289 0.22827,2.64778 0.66597,0.24774 -0.0359,-4.56685 0.33693,-0.20224 1.39227,1.65147 0.32017,-0.35115 -0.77444,-2.03749 z m -0.97726,-0.17765 -1.43509,-0.746 -0.30622,-7.00985 c 0,0 0.64359,-2.77938 0.63694,-3.06274 l 0.6093,-1.21924 3.62552,-2.56583 -0.68276,1.9919 0.41561,4.74788 -1.80402,7.69727 z"
                                class="body-part"></path>
                            <path id="pierna izquierda"
                                d="m 51.176145,64.073985 -1.20605,3.01461 0.70738,0.26558 0.89754,3.51771 -0.55801,-4.01191 z m -5.08496,-3.15003 0.63355,1.8609 0.16813,2.03261 0.61314,1.93117 -0.90585,-0.0851 -0.28534,2.15982 z m 4.3014,6.58834 1.27664,4.99697 -0.28984,3.02284 -0.67869,10.06546 -1.66325,0.63506 -3.50399,-11.96959 1.24985,-7.17525 z m 0.54053,20.8287 0.85194,1.3581 0.37189,0.79238 -0.15588,1.21774 -0.76984,0.74446 -1.51185,0.12543 -1.1299,-0.29192 -0.24225,-0.95894 0.80765,-1.30405 -0.22562,-0.85987 0.29679,-0.84153 -0.0194,-1.81524 1.53568,-0.54817 z m -1.19598,0.4675 0.15943,1.25776 -0.6023,0.97431 m -0.54436,0.29544 1.06474,0.40084 1.55326,-0.65137 m -4.19331,-39.53466 4.55099,-2.03879 0.63802,0.23079 0.0353,1.80672 0.075,4.64669 -1.97837,6.04282 0.47612,1.41403 -1.42812,3.29446 -1.76611,-0.30111 -0.50079,-2.11605 -0.1695,-1.75674 -2.42102,-8.15763 -0.34279,-3.64687 z"
                                class="body-part"></path>
                            <path
                                d="m 44.742845,39.689035 5.48374,1.86457 2.27386,1.3378 2.74195,-1.74412 4.51804,-1.28077 0.90009,2.29721 0.675,3.4346 -0.81272,5.02838 -2.82636,0.16819 -4.11256,-1.67581 -1.00814,0.39118 -0.95849,-0.39888 -4.44053,1.94411 -2.77023,-0.51478 -0.95181,-6.15325 0.36754,-2.7864 z"
                                id="nalga" class="body-part"></path>
                            <path
                                d="m 51.818445,37.309575 0.14418,2.97292 1.15984,-0.0241 0.048,-2.96488 2.80867,-0.81981 2.34029,-0.7541 1.34121,3.73319 -4.77886,1.36455 -2.33301,1.2158 -2.37536,-1.2333 -5.45663,-1.37716 1.51961,-3.95743 z"
                                id="lomo" class="body-part"></path>
                            <path
                                d="m 51.733705,14.788555 0.53876,25.33066 0.48967,-0.0297 0.65658,-25.3387 -0.28147,-0.84188 -1.25059,-4.9e-4 z"
                                id="columna" class="body-part"></path>
                            <path
                                d="m 48.157455,6.3585449 0.44208,-0.14964 0.16111,0.16427 1.48163,4.0475101 2.32401,1.45118 2.39971,-1.52387 0.97577,-3.6896901 0.52752,-0.55908 0.23367,0.0981 0.24198,-3.34467 -2.03129,-2.31103004 -2.84509,-0.51629 -2.20422,0.52915 -1.93631,2.63077004 z"
                                id="cabeza hacia atras" class="body-part"></path>
                            <path
                                d="m 52.369695,12.105075 -2.35767,-1.55045 -1.47119,-3.9514301 -0.60741,0.0403 0.27409,1.82447 0.97635,0.33932 0.7613,2.2157201 0.33017,1.06849 0.0895,2.14894 1.16448,0.008 0.10563,-0.70833 0.54716,-0.0606 z m 1.01793,1.47595 0.23768,0.64982 1.38107,-0.004 0.01,-2.38784 0.25971,-0.79061 0.57215,-2.1698001 0.76359,-0.41018 0.25158,-1.78416 -0.62859,0.0193 -1.08488,3.8998101 -2.39725,1.46684 0.2768,1.48507 z"
                                id="nuca" class="body-part"></path>
                            <path id="brazo derecho"
                                d="m 61.657445,27.250625 -0.32785,-1.05121 -1.27383,-2.05489 1.38708,-2.96476 2.28579,0.91634 1.83971,1.74245 0.53937,1.78549 -0.26073,4.30868 z m 2.64394,15.3417 1.51839,0.0828 0.78033,-0.65476 1.16673,2.18281 0.79187,3.34623 -0.49843,0.21064 -0.55144,-2.21453 -0.50541,0.24292 0.30356,2.5012 -0.62882,0.23021 -0.36124,-2.50014 -0.56203,0.16666 0.16765,2.77019 -0.77603,0.30634 -0.19719,-2.87245 -0.45732,-0.0278 -0.22215,2.64829 -0.66539,0.24928 0.0254,-4.56692 -0.3374,-0.20146 -1.38845,1.65469 -0.32098,-0.35041 0.76973,-2.03928 z m 0.97685,-0.1799 1.43335,-0.74932 0.29002,-7.01054 c 0,0 -0.65,-2.77789 -0.64401,-3.06126 l -0.61212,-1.21783 -3.98124,-2.57566 1.0222,1.93525 -0.38967,4.82212 1.8218,7.69308 z"
                                class="body-part"></path>
                            <path id="pierna derecha"
                                d="m 54.019305,64.073985 1.20605,3.01461 -0.70737,0.26558 -0.89755,3.51771 0.55802,-4.01191 z m 5.08496,-3.15003 -0.63355,1.8609 -0.16813,2.03261 -0.61313,1.93117 0.90584,-0.0851 0.28534,2.15982 z m -4.3014,6.58834 -1.27664,4.99697 0.28984,3.02284 0.67869,10.06546 1.66325,0.63506 3.504,-11.96959 -1.24986,-7.17525 z m -0.54053,20.8287 -0.85194,1.3581 -0.37189,0.79238 0.15589,1.21774 0.76983,0.74446 1.51186,0.12543 1.12989,-0.29192 0.24225,-0.95894 -0.80765,-1.30405 0.22563,-0.85987 -0.29679,-0.84153 0.0194,-1.81524 -1.53568,-0.54817 z m 1.19598,0.4675 -0.15943,1.25776 0.6023,0.97431 m 0.54436,0.29544 -1.06474,0.40084 -1.55326,-0.65137 m 3.56525,-39.90247 -3.97962,-1.70224 -0.56389,0.27131 -0.0528,1.79746 -0.075,4.64669 1.97837,6.04282 -0.47612,1.41403 1.42813,3.29446 1.7661,-0.30111 0.50079,-2.11605 0.1695,-1.75674 2.42102,-8.15763 0.009,-3.68308 z"
                                class="body-part"></path>
                            <path
                                d="m 62.863315,16.685695 1.57473,1.56518 0.81404,2.06904 0.0384,2.52859 -1.48921,-1.23926 -2.76223,-1.15539 -1.84691,3.4342 -1.13679,5.49715 -0.0767,5.8593 -4.07066,1.10938 0.10355,-7.94098 1.94107,-4.90021 5.04395,-8.19335 z"
                                id="atras-derecha" class="body-part"></path>
                            <path
                                d="m 55.439085,14.728535 -0.063,-2.62463 0.71441,1.15181 4.37994,1.49796 -4.97857,8.36746 -1.83043,5.08189 0.21949,-13.55362 z"
                                id="clavicula derecha" class="body-part"></path>
                            <path
                                d="m 42.200945,16.586495 -1.57473,1.56517 -0.81404,2.06905 -0.38603,2.52859 1.83679,-1.23927 2.76223,-1.15538 1.84691,3.4342 1.13679,5.49715 0.0767,5.8593 4.07066,1.10938 -0.10355,-7.94098 -1.94107,-4.90022 -5.04395,-8.19334 z"
                                id="atras-izquierda" class="body-part"></path>
                            <path
                                d="m 49.625175,14.629325 0.063,-2.62462 -0.71441,1.15181 -4.37994,1.49796 4.97857,8.36746 1.83043,5.08188 -0.21949,-13.55362 z"
                                id="clavicula izquierda" class="body-part"></path>
                        </svg>
                    </div>
                    <div style="width: 75%;margin-left: 5px;">
                        <div class="mb-3">
                            <span class="form-label">Motivo Consulta</span>
                            <textarea wire:model="consultation" class="form-control" rows="2" cols="" disabled></textarea>
                            @error('consultation')
                                <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip"
                                    data-bs-title="{{ $message }}">
                                    <i class="fa fa-exclamation"></i>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <span class="form-label">Enfermedad Actual</span>
                            <textarea wire:model="disease" class="form-control" rows="2" cols="" disabled></textarea>
                            @error('diasease')
                                <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip"
                                    data-bs-title="{{ $message }}">
                                    <i class="fa fa-exclamation"></i>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Dolor en el Cuerpo</span>
                            <div class="form-floating border rounded-end p-1">
                                @foreach ($body_pain as $part)
                                    <span class="badge text-bg-primary">{{ $part }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <span class="form-label">Examen Fisico</span>
                            <textarea wire:model="physicalExam" class="form-control" rows="2" cols="" disabled></textarea>
                            @error('physicalExam')
                                <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip"
                                    data-bs-title="{{ $message }}">
                                    <i class="fa fa-exclamation"></i>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <span class="form-label">Detalle de Diagnostico</span>
                            <textarea wire:model="detail_diagnostic" class="form-control" rows="3" cols="" disabled></textarea>
                            @error('detail_diagnostic')
                                <span class="input-group-text text-bg-danger" data-bs-toggle="tooltip"
                                    data-bs-title="{{ $message }}">
                                    <i class="fa fa-exclamation"></i>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <h5 class="card-text mt-1">Tratamiento</h5>
                <table class="table table-striped">
                    <thead>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad/Sesiones</th>
                        <th>Cada(Dias)</th>
                    </thead>
                    <tbody>
                        @foreach ($diagnostic->detail_diagnostics ?? [] as $item)
                            <tr wire:click="selectTreatment({{ $item->id }})" style="cursor: pointer;">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->treatment->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->quantity }}/{{ $this->countTreatment($item->id) }}</td>
                                <td>{{ $item->by_day }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h5 class="mt-2">Resumen Monetario</h5>
                <div class="input-group">
                    <span class="input-group-text">Saldo</span>
                    <input wire:model="total" type="number" class="form-control" disabled>
                    <span class="input-group-text">Cancelado</span>
                    <input wire:model.live="canceled" type="number" class="form-control" disabled>
                </div>
            @endif
            <x-slot name="footer">
                <div class="d-flex justify-content-end">
                    <a wire:click="closeDiagnostic" class="btn btn-secondary mx-1">Cerrar</a>
                </div>
            </x-slot>
        </x-card>

        <x-modal id="modal" title="Historial" style="modal-xl">
            <livewire:modal-history></livewire:modal-history>
        </x-modal>
    </div>

    @section('css')
        <style>
            .human-body {
                width: 380px;
                height: auto;
            }

            .body-part {
                fill: white;
                cursor: pointer;
            }

            .body-select {
                fill: red;
            }

            .select-item {
                cursor: pointer;
            }
        </style>
    @endsection

    @script
        <script>
            Livewire.on('openModal', () => {
                let modal = new bootstrap.Modal(document.getElementById('modal'));
                modal.show();
            });

            Livewire.hook('morph.updated', ({
                component,
                cleanup
            }) => {
                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
                const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
                    tooltipTriggerEl));

            });

            Livewire.hook('element.init', ({
                component,
                el
            }) => {
                if (el.id) {
                    let bodyId = new Set($wire.body_pain);
                    let body = document.getElementsByClassName('body-part');
                    for (let part of body) {
                        if (bodyId.has(part.id)) part.classList.add('body-select');
                        $wire.$refresh();

                        {{-- part.addEventListener('click', function(e) { --}}
                        {{--     if (!bodyId.has(part.id)) { --}}
                        {{--         part.classList.add('body-select'); --}}
                        {{--         bodyId.add(part.id); --}}
                        {{--     } else { --}}
                        {{--         part.classList.remove('body-select'); --}}
                        {{--         bodyId.delete(part.id); --}}
                        {{--     } --}}
                        {{--     $wire.body_pain = Array.from(bodyId); --}}
                        {{--     $wire.$refresh(); --}}
                        {{-- }); --}}
                    }
                }
            });
        </script>
    @endscript
