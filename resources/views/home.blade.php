@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome!') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in! You can log out by clicking your username on the top right or you can go to Movie Tracker...') }}
                    <br>
                    <br>
                    <a href="/" class="btn btn-primary">Movie Tracker</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
