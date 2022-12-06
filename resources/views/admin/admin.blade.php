@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Admin') }}
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created</th>
                        </tr>
                    @foreach($user as $u)
                        <tr>
                            <td>{{$u->name}}</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->created_at}}</td>
                        </tr>
                    @endforeach
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
