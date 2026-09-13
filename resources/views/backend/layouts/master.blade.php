@extends('backend.layouts.base')
@section('base.content')
    @include('backend.layouts.sidebar')
    <main class="main-wrapper">
        @include('backend.layouts.header')
        <div class="main-content-wrapper">
            @yield('content')
        </div>
    </main>
    @include('backend.layouts.footer')
@endsection
