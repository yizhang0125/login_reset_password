@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h1 class="display-4 mb-4">Welcome, {{ Auth::user()->name }}!</h1>
    <p class="lead mb-4">You are logged in successfully.</p>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>
@endsection
