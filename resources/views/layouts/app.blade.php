@extends('layouts.base')

@section('body')
    @include('layouts.navbar')
    @yield('content')

    @isset($slot)
        {{ $slot }}
    @endisset
@endsection
