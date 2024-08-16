@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
@endif

@section('auth_header', __('adminlte::adminlte.register_message'))

@section('auth_body')
    <form action="{{ $register_url }}" method="post">
        @csrf


        {{-- CI field --}}
        <div class="input-group mb-3">
            <input type="number" name="ci" class="form-control @error('ci') is-invalid @enderror"
                   value="{{ old('ci') }}" placeholder="Cedula de Identidad" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-address-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('ci')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Surname field --}}
        <div class="input-group mb-3">
            <input type="text" name="surname" class="form-control @error('surname') is-invalid @enderror"
                   value="{{ old('surname') }}" placeholder="Apellidos" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('surname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Name field --}}
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.name') }}" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Birthdate field --}}
        <div class="input-group mb-3">
            <input type="date" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror"
                   value="{{ old('birthdate') }}" placeholder="Fecha de Nacimiento" autofocus>

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fa fa-calendar {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('birthdate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        {{-- Gender field --}}
        <div class="input-group mb-3">
            <div style="width: 50%;text-align: center;" id="women" onclick="selectGender('women')">
                <i class="fa fa-venus" style="font-size: 50px;"></i>
                <input type="radio" id="imen" name="gender" value="0" class="d-none">
            </div>
            <div style="width: 50%;text-align: center;" id="men" onclick="selectGender('men')">
                <i class="fa fa-mars" style="font-size: 50px;"></i>
                <input type="radio"  id="iwomen" name="gender" value="1" class="d-none">
            </div>

            @error('gender')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Confirm password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password_confirmation"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">

            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>

            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Register button --}}
        <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
            <span class="fas fa-user-plus"></span>
            {{ __('adminlte::adminlte.register') }}
        </button>

    </form>


@stop

@section('js')
<script>
function selectGender(id){
    if(id=='women'){
        document.getElementById(id).classList.add('border','bg-red');
        document.getElementById('men').classList.remove('border','bg-blue');
        document.getElementById('imen').checked=true;
    }
    else{
        document.getElementById(id).classList.add('border','bg-blue');
        document.getElementById('women').classList.remove('border','bg-red');
        document.getElementById('iwomen').checked=true;
    }
}
</script>
@endsection

@section('auth_footer')
    <p class="my-0">
        <a href="{{ $login_url }}">
            {{ __('adminlte::adminlte.i_already_have_a_membership') }}
        </a>
    </p>
@stop
