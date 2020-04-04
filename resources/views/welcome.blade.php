@extends('layouts.wel')
@section('content')
<div class="container" style="position: relative">
        <div class="img" style="position: absolute;top: 95px;left: 319px;z-index: 1;">
            <img id="imageChange" src="/image/anh1.jpg" alt="">
        </div>
    <div class="row">
        <div class="col-6" style="padding: 0 15%">
            <img src="https://www.instagram.com/static/images/homepage/home-phones.png/43cc71bb1b43.png" width="450" height="610" alt="">
        </div>
        <div class="col-4 ml-4 mt-5">
            <div class="top border bg-white d-flex flex-column justify-content-center">
                <img src="/png/logo.png" alt="" style="margin: 25px 74px;height: 50px;width: 187px;color: black;">
                <div class="form mr-5 ml-5">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-info btn-lg btn-block text-light d-flex justify-content-center align-items-center" style=" height: 40px">
                                Log In
                            </button>
                    </div>
                    <div class="or pt-4">
                        <div class="border-top pt-3">
                        </div>
                        <div style="position: relative">
                            <p class="text-center" style="position: absolute;bottom: -10px;right: 100px;padding: 0 17px;background-color: white;">OR</p>
                        </div>
                    </div>
                    <div class="fb d-flex justify-content-center">
                        <a href=""><p>Log in with Facebook</p></a>
                    </div>
                </form>
                </div>
            </div>
            <div class="down mt-4 border bg-white d-flex justify-content-center">
                <p style="padding: 5px; margin-top: 15px">Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
