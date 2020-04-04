@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('profile.create') }}" class="pt-5">
    @csrf
    <div class="form-group row">
        <label for="title" class="col-md-4 col-form-label text-md-right font-weight-bold">Title</label>

        <div class="col-md-6">
            <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title">

            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="description" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Description') }}</label>

        <div class="col-md-6">
            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autocomplete="new-description">

            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="url" class="col-md-4 col-form-label text-md-right font-weight-bold">{{ __('Url') }}</label>

        <div class="col-md-6">
            <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" required autocomplete="new-url">

            @error('url')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>
</form>
@endsection