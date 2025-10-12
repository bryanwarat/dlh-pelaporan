@extends('layouts.admin.auth')

@section('title', 'Login')

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
                                                <img src="{{ asset('assets/public/img/logo/logo.png') }}" alt="logo"
                                                    height="24">
                                            </span>
                                        </a>
                                        <a href="{{ url('/') }}" class="logo logo-dark">
                                            <span class="logo-lg">
                                                <img src="{{ asset('assets/public/img/logo/logo.png') }}" alt="logo"
                                                    height="24">
                                            </span>
                                        </a>
                                    </div>
                                </div>

                                <div class="auth-title-section mb-4 text-lg-start text-center">
                                    <h3 class="text-dark fw-semibold mb-3">Login</h3>
                                </div>

                                {{-- Form Login --}}
                                <form method="POST" action="{{ route('login') }}" class="my-4">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Email/Username</label>
                                        <input id="email" type="text"
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


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
