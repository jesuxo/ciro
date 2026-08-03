@extends('layouts.master-auth')
@section('title') Inicio Sesion @endsection
@section('content')
    <div class="w-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="auth-card mx-lg-3">
                        <div class="card border-0 mb-0">

                            <div class="card-body">
                                <div class="p-2">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="" required autocomplete="email" autofocus
                                                placeholder="Ej: correo@mail.com">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end" style="display: none">
                                                <a href="{{ route('password.request') }}" class="text-muted">Olvide mi contrase&ntilde;a</a>
                                            </div>
                                            <label class="form-label" for="password-input">Contrase&ntilde;a</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">

                                                <input type="password"
                                                       class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                                       onpaste="return false" placeholder="********"
                                                       id="password-input" name="password" aria-describedby="passwordInput"
                                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>

                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none
                                                    text-muted password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-check" style="display: none">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="auth-remember-check">Recordar datos</label>
                                        </div>

                                        <div class="mt-4"  >
                                            <button class="btn btn-success w-100" type="submit">Iniciar Sesion</button>
                                        </div>

                                        <div class="mt-4 pt-2 text-center" style="display: none !important;">
                                            <div class="signin-other-title">
                                                <h5 class="fs-13 mb-4 title">Sign In with</h5>
                                            </div>
                                            <div class="pt-2 hstack gap-2 justify-content-center">
                                                <button type="button" class="btn btn-soft-primary btn-icon"><i
                                                        class="ri-facebook-fill fs-16"></i></button>
                                                <button type="button" class="btn btn-soft-danger btn-icon"><i
                                                        class="ri-google-fill fs-16"></i></button>
                                                <button type="button" class="btn btn-soft-dark btn-icon"><i
                                                        class="ri-github-fill fs-16"></i></button>
                                                <button type="button" class="btn btn-soft-info btn-icon"><i
                                                        class="ri-twitter-fill fs-16"></i></button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>
                                Hecho con <i class="mdi mdi-heart text-danger"></i>  por
                                <a href="https://CelisWeb.com.ve" target="_blank" class="text-success"> CelisWeb </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
@section('scripts')
    <script src="{{ URL::asset('build/js/pages/password-addon.init.js') }}"></script>
@endsection
