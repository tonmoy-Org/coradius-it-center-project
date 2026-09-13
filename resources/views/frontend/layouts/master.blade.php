@extends('frontend.layouts.base')
@section('base.content')
    @yield('content')
    @if(!View::hasSection('hide_footer') && !request()->routeIs('login') && !request()->is('login*'))
        @include('frontend.layouts.footer')
    @endif
@endsection

