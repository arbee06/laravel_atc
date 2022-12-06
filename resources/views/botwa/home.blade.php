@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Respondent BOT Management') }}
                    
                    <button style="float: right;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Import Data
                    </button>
                    <form id="sendAllForm" action="{{ route('sendAll') }}" method="POST" style="float: right;">
                        @csrf
                        <a style="" class="btn btn-primary" href="{{ route('sendAll') }}" onclick="event.preventDefault();document.getElementById('sendAllForm').submit();">
                        Remind All
                        </a>
                    </form>
                </div>

                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Import Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ url('/home/import') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Input File') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="file" class="form-control" name="select_file"  required autofocus>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="upload" value="Upload"></input>
                        </div>
                    </form>
                    </div>
                    </div>
                </div>
                </div>

                <div class="card-body">
                    <table id="qmli-table" class="table">
                        <tr>
                            <th>NPK Atasan</th>
                            <th>Nama Atasan</th>
                            <th>Status Atasan</th>
                            <th>No HP Atasan</th>
                            <th>NPK Subordinate</th>
                            <th>Nama Subordinate</th>
                            <th>Status Subordinate</th>
                            <th>No HP Subordinate</th>
                            <th>Survey Link</th>
                            <th class="text-center">Action</th>
                        </tr>
                    @foreach($data as $row)
                        <tr>
                            <td style="text-align: center;">{{$row->npk_atasan}}</td>
                            <td style="text-align: center;">{{$row->nama_atasan}}</td>
                            <td style="text-align: center;">{{$row->status_atasan}}</td>
                            <td style="text-align: center;">{{$row->no_hp_atasan}}</td>
                            <td style="text-align: center;">{{$row->npk_bawahan}}</td>
                            <td style="text-align: center;">{{$row->nama_bawahan}}</td>
                            <td style="text-align: center;">{{$row->status_bawahan}}</td>
                            <td style="text-align: center;">{{$row->no_hp_bawahan}}</td>
                            <td style="text-align: center;">{{$row->survey_link}}</td>
                            <td class="text-center align-middle">
                            <div class="btn-group align-top">
                                <form id="sendChatForm_{{$row->npk_atasan}}" action="{{ route('sendChat') }}" method="POST" style="">
                                    @csrf
                                        <input type="text" id="data_atasan_{{$row->no_hp_atasan}}" name="data_atasan_{{$row->no_hp_atasan}}"  value="{{$row->no_hp_atasan.';'.$row->status_atasan.';'.$row->nama_atasan.';'.$row->survey_link}}" hidden>
                                        <input type="text" id="data_bawahan_{{$row->no_hp_bawahan}}" name="data_bawahan_{{$row->no_hp_bawahan}}" value="{{$row->no_hp_bawahan.';'.$row->status_bawahan.';'.$row->nama_bawahan.';'.$row->survey_link}}" hidden>
                                        <a class="btn btn-info"
                                        href="{{ route('sendChat') }}" onclick="event.preventDefault();document.getElementById('sendChatForm_{{$row->npk_atasan}}').submit();"
                                        id="sendChat"> Remind
                                        </a>
                                </form>
                                <form id="sendImageForm_{{$row->npk_atasan}}" action="{{ route('sendImage') }}" method="POST" style="">
                                    @csrf
                                        <input type="text" id="data_atasan_{{$row->no_hp_atasan}}" name="data_atasan_{{$row->no_hp_atasan}}"  value="{{$row->no_hp_atasan.':'.$row->status_atasan.':'.$row->nama_atasan}}" hidden>
                                        <input type="text" id="data_bawahan_{{$row->no_hp_bawahan}}" name="data_bawahan_{{$row->no_hp_bawahan}}" value="{{$row->no_hp_bawahan.':'.$row->status_bawahan.':'.$row->nama_bawahan}}" hidden>
                                        <a class="btn btn-info"
                                        href="{{ route('sendImage') }}" onclick="event.preventDefault();document.getElementById('sendImageForm_{{$row->npk_atasan}}').submit();"
                                        id="sendImage"> Image
                                        </a>
                                </form>
                                <form id="sendFileForm_{{$row->npk_atasan}}" action="{{ route('sendFile') }}" method="POST" style="">
                                    @csrf
                                        <input type="text" id="data_atasan_{{$row->no_hp_atasan}}" name="data_atasan_{{$row->no_hp_atasan}}"  value="{{$row->no_hp_atasan.':'.$row->status_atasan.':'.$row->nama_atasan}}" hidden>
                                        <input type="text" id="data_bawahan_{{$row->no_hp_bawahan}}" name="data_bawahan_{{$row->no_hp_bawahan}}" value="{{$row->no_hp_bawahan.':'.$row->status_bawahan.':'.$row->nama_bawahan}}" hidden>
                                        <a class="btn btn-info"
                                        href="{{ route('sendFile') }}" onclick="event.preventDefault();document.getElementById('sendFileForm_{{$row->npk_atasan}}').submit();"
                                        id="sendFile"> File
                                        </a>
                                </form>
                                <form id="sendVoiceForm_{{$row->npk_atasan}}" action="{{ route('sendVoice') }}" method="POST" style="">
                                    @csrf
                                        <input type="text" id="data_atasan_{{$row->no_hp_atasan}}" name="data_atasan_{{$row->no_hp_atasan}}"  value="{{$row->no_hp_atasan.':'.$row->status_atasan.':'.$row->nama_atasan}}" hidden>
                                        <input type="text" id="data_bawahan_{{$row->no_hp_bawahan}}" name="data_bawahan_{{$row->no_hp_bawahan}}" value="{{$row->no_hp_bawahan.':'.$row->status_bawahan.':'.$row->nama_bawahan}}" hidden>
                                        <a class="btn btn-info"
                                        href="{{ route('sendVoice') }}" onclick="event.preventDefault();document.getElementById('sendVoiceForm_{{$row->npk_atasan}}').submit();"
                                        id="sendVoice"> Voice
                                        </a>
                                </form>
                                <form id="report-form-{{$row->npk_atasan}}" name="report-form-{{$row->npk_atasan}}" action="{{ route('per_tabular') }}" method="POST">
                                    @csrf
                                    <input type="text" id="data_atasan_{{$row->no_hp_atasan}}" name="data_atasan_{{$row->no_hp_atasan}}"  value="{{$row->no_hp_atasan.':'.$row->status_atasan.':'.$row->nama_atasan}}" hidden>
                                    <a class="btn btn-info"
                                        href="{{ route('per_tabular') }}" onclick="event.preventDefault();document.getElementById('report-form-{{$row->npk_atasan}}').submit();"
                                        id="perTabular"> PER1
                                        </a>
                                </form>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
