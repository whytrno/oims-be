@extends('layouts.app')

@section('title', 'Login')
@section('content')
    <main class="main-content main-content-bg mt-0">
        <div class="page-header min-vh-100"
             style="background-image: url({{asset('img/auth-bg.jpeg')}}); background-position: left top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-7">
                        <div class="card border-0 mb-0" style="background-color:rgba(255, 255, 255, 0.5)">
                            <div class="card-header bg-transparent">
                                <h5 class="text-dark text-center mt-2 mb-3">Sign in</h5>
                            </div>
                            <div class="card-body px-lg-5 pt-0">
                                <form method="POST" action="{{route('login.process')}}" role="form" class="text-start">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                               aria-label="Email">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control"
                                               placeholder="Password"
                                               aria-label="Password">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary w-100 my-4 mb-2">Sign in</button>
                                    </div>
                                    <div class="mb-2 position-relative text-center">
                                        <p
                                            class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                                            or
                                        </p>
                                    </div>
                                    <div class="text-center">
                                        <a href="{{route('register')}}" type="button"
                                           class="btn bg-gradient-dark w-100 mt-2 mb-4">Sign up
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
