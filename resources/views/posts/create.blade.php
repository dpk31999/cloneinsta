@extends('layouts.app')

@section('content')
<div class="container" style="padding: 0 9%">
    <div class="row">
        <form action="/p" enctype="multipart/form-data" method="post">
            @csrf
            <div class="col-8 offset-2">
                <div class="row">
                    <h1>Add New Post</h1>
                </div>
                <div class="form-group row">
                    <label for="caption" class="col-form-label">Post Caption</label>
    
                    <input id="caption"
                            type="text" 
                            class="form-control 
                            @error('caption') is-invalid @enderror" 
                            name="caption"
                            value="{{ old('caption') }}" 
                            autocomplete="caption" autofocus>
    
                    @error('caption')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <label for="image" class="col-form-label">Post Image</label>
                    <input type="file" class="form-control-file" name="image" id="image">

                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            dasdsa
                        </span>
                    @enderror
                </div>
                <div class="row pt-2">
                    <button class="btn btn-primary">Add New Post</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
