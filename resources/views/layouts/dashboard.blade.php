@extends('layouts.app')
@section('content')
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')

    <main class="main-content position-relative border-radius-lg ">
        @include('components.navbar')

        <div class="container-fluid py-4">
            @yield('dashboard-content')
        </div>
    </main>
    @include('components.template-setting')
@endsection
