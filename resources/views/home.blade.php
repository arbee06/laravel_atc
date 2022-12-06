@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                <div class="card-footer">
                    <a href="{{ route('home') }}" class="btn btn-primary">CPanel</a>
                    <a href="{{ route('logout') }}" class="btn btn-danger">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
