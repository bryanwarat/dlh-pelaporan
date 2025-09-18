@extends('layouts.admin.auth')

@section('title', 'Login - Hando')

@section('content')
    {{-- Bagian Kiri (Form Login) --}}
    <div class="col-xl-5">
        <div class="row">
            <div class="col-md-8 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="mb-0 p-0 p-lg-3">

                            <div class="mb-0 border-0 p-md-4 p-lg-0">
                                <div class="mb-4 p-0 text-lg-start text-center">
                                    <div class="auth-brand">
                                        <a href="{{ url('/') }}" class="logo logo-light">
                                            <span class="logo-lg">
                                                <img src="{{ asset('assets/images/logo-light-3.png') }}" alt="logo"
                                                    height="24">
                                            </span>
                                        </a>
                                        <a href="{{ url('/') }}" class="logo logo-dark">
                                            <span class="logo-lg">
                                                <img src="{{ asset('assets/images/logo-dark-3.png') }}" alt="logo"
                                                    height="24">
                                            </span>
                                        </a>
                                    </div>
                                </div>

                                <div class="auth-title-section mb-4 text-lg-start text-center">
                                    <h3 class="text-dark fw-semibold mb-3">Welcome back! Please login</h3>
                                    <p class="text-muted fs-14 mb-0">Enter your credentials to access your account.</p>
                                </div>

                                {{-- Form Login --}}
                                <form method="POST" action="{{ route('login') }}" class="my-4">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder="Enter your email">

                                        @error('email')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password" placeholder="Enter your password">

                                        @error('password')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group d-flex mb-3">
                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-end">
                                            @if (Route::has('password.request'))
                                                <a class="text-muted fs-14" href="{{ route('password.request') }}">
                                                    Forgot password?
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 row">
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary fw-semibold" type="submit"> Log In </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                {{-- Register link --}}
                                <div class="text-center text-muted">
                                    <p class="mb-0">Don't have an account?
                                        <a class="text-primary ms-2 fw-medium" href="{{ route('register') }}">Sign up</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Bagian Kanan (Background + Carousel) --}}
    <div class="col-xl-7 d-none d-xl-inline-block">
        <div class="account-page-bg rounded-4">
            <div class="auth-user-review text-center">
                {{-- Carousel --}}
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <p class="prelead mb-2 text-white">"With Untitled, your support process can be as enjoyable as
                                your product."</p>
                            <h4 class="mb-1 text-white">Camilla Johnson</h4>
                            <p class="mb-0 text-white">Software Developer</p>
                        </div>
                        <div class="carousel-item">
                            <p class="prelead mb-2 text-white">"Pretty nice theme, hoping you guys could add more features
                                to this."</p>
                            <h4 class="mb-1 text-white">Palak Awoo</h4>
                            <p class="mb-0 text-white">Lead Designer</p>
                        </div>
                        <div class="carousel-item">
                            <p class="prelead mb-2 text-white">"This is a great product, helped us a lot and very quick to
                                implement."</p>
                            <h4 class="mb-1 text-white">Laurent Smith</h4>
                            <p class="mb-0 text-white">Product Designer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
