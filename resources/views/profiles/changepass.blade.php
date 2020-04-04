@extends('profiles.layouts.backgr')

@section('contentedit')

<h3 class="pl-5"> {{ $user->username }} </h3>
<form method="POST" action="{{ route('profile.updatepass', $user->id) }}" class="pt-5">
    @csrf

    <div class="form-group row">
        <label for="old_password" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Old_password') }}</label>

        <div class="col-md-6">
            <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" value="{{ old('old_password') }}" required autocomplete="old_password" autofocus>

            @error('old_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @if (session('error_pass'))
            <span>
                <strong style="color: red">{{ session('error_pass') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Password') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Confirm Password') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Change Password
            </button>
        </div>
    </div>
</form>
    
@endsection