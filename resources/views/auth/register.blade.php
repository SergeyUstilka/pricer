@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin: 30px 0;">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="section-title"><h3>{{ __('Register') }}</h3></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <input id="name" type="text" placeholder="Имя" class="input{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif

                        </div>

                        <div class="form-group">
                            <input id="email" type="email" placeholder="Email" class="input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif

                        </div>

                        <div class="form-group">
                            <input id="password" type="password"  placeholder="Пароль" class="input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="password-confirm" placeholder="Повторите пароль" type="password" class="input" name="password_confirmation" required>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="primary-btn">
                                    {{ __('Register') }}
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
