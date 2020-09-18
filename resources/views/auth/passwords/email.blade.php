@extends('layouts.app')

@section('content')
<div class="container pt-4">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1 class="display-3" id="logo_system" style="color: orangered">Mars <span class="display-4" style="color: white; font-family: 'Merriweather', serif;">&COPY;</span></h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card dark-grey">
                <div class="card-header">{{ __('Ingrese su correo para recuperar su contraseña') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Dirección de correo electrónico') }}</label>

                            <div class="col-md-6 mt-2">
                                <input id="email" placeholder="ejemplo@gmail.com" type="email" class="form-control @error('email') is-invalid @enderror dark-grey" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>El correo que ha ingresado no existe</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row text-center">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-block orange">
                                    {{ __('Enviar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
