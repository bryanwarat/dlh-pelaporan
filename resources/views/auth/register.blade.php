@extends('layouts.admin.auth')

@section('title', 'Register - Hando')

@section('content')
    {{-- Bagian Kiri (Form Register) --}}
    <div class="col-xl-5">
        <div class="row">
            <div class="col-md-8 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="mb-0 p-0 p-lg-3">
                            <div class="mb-0 border-0 p-md-4 p-lg-0">

                                {{-- Logo --}}
                                <div class="mb-4 p-0 text-lg-start text-center">
                                    <div class="auth-brand">
                                        <a href="{{ url('/') }}" class="logo logo-light">
                                            <span class="logo-lg">
                                                <img src="{{ asset('assets/images/logo-light-3.png') }}" alt=""
                                                    height="24">
                                            </span>
                                        </a>
                                        <a href="{{ url('/') }}" class="logo logo-dark">
                                            <span class="logo-lg">
                                                <img src="{{ asset('assets/images/logo-dark-3.png') }}" alt=""
                                                    height="24">
                                            </span>
                                        </a>
                                    </div>
                                </div>

                                {{-- Title --}}
                                <div class="auth-title-section mb-4 text-lg-start text-center">
                                    <h3 class="text-dark fw-semibold mb-3">Stay in the loop – Sign Up Now!</h3>
                                    <p class="text-muted fs-14 mb-0">Sign up to unlock exclusive content, special offers,
                                        and be the first to know about exciting updates.</p>
                                </div>

                                {{-- Social Login --}}
                                <div class="row">
                                    <div class="col-6 mt-2">
                                        <a
                                            class="btn text-dark border fw-normal d-flex align-items-center justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 48 48" class="me-2">
                                                <path fill="#ffc107"
                                                    d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C12.955 4 4 12.955 4 24s8.955 20 20 20s20-8.955 20-20c0-1.341-.138-2.65-.389-3.917" />
                                                <path fill="#ff3d00"
                                                    d="m6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C16.318 4 9.656 8.337 6.306 14.691" />
                                                <path fill="#4caf50"
                                                    d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238A11.91 11.91 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44" />
                                                <path fill="#1976d2"
                                                    d="M43.611 20.083H42V20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002l6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917" />
                                            </svg>
                                            <span>Google</span>
                                        </a>
                                    </div>

                                    <div class="col-6 mt-2">
                                        <a
                                            class="btn text-dark border fw-normal d-flex align-items-center justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 256 256" class="me-2">
                                                <path fill="#1877f2"
                                                    d="M256 128C256 57.308 198.692 0 128 0S0 57.308 0 128c0 63.888 46.808 116.843 108 126.445V165H75.5v-37H108V99.8c0-32.08 19.11-49.8 48.348-49.8C170.352 50 185 52.5 185 52.5V84h-16.14C152.959 84 148 93.867 148 103.99V128h35.5l-5.675 37H148v89.445c61.192-9.602 108-62.556 108-126.445" />
                                                <path fill="#fff"
                                                    d="m177.825 165l5.675-37H148v-24.01C148 93.866 152.959 84 168.86 84H185V52.5S170.352 50 156.347 50C127.11 50 108 67.72 108 99.8V128H75.5v37H108v89.445A129 129 0 0 0 128 256a129 129 0 0 0 20-1.555V165z" />
                                            </svg>
                                            <span>Facebook</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="saprator my-4"><span>or continue with email</span></div>

                                {{-- Form Register --}}
                                <form method="POST" action="{{ route('register') }}" class="my-4">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus
                                            placeholder="Enter your full name">

                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email"
                                            placeholder="Enter your email">

                                        @error('email')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password" placeholder="Enter your password">

                                        @error('password')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password-confirm" class="form-label">Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password"
                                            placeholder="Re-enter your password">
                                    </div>

                                    <div class="form-group d-flex mb-3">
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="terms" required>
                                                <label class="form-check-label" for="terms">
                                                    I agree to the <a href="#" class="text-primary fw-medium">Terms
                                                        and Conditions</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 row">
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-primary fw-semibold" type="submit"> Register
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                {{-- Login Link --}}
                                <div class="text-center text-muted mb-0">
                                    <p class="mb-0">Already have an account ?
                                        <a class="text-primary ms-2 fw-medium" href="{{ route('login') }}">Login here</a>
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
