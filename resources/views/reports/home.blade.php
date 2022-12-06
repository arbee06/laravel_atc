@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    {{ __('Create PER Tabular') }}
                </div>
                <center>
                <form id="report-form" name="report-form" action="{{ url('/home/report/per_tabular') }}" method="POST">
                @csrf
                        <input type="text" name="nama">
                        <button type="submit" class="btn btn-primary"> Submit </button>
                </form>
                </center>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection