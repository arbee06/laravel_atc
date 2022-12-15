@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Respondents') }}
                    
                    <button style="float: right;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Import Data
                    </button>
                    <form id="remindAllForm" action="{{ route('remindAll') }}" method="POST" style="float: right;">
                        @csrf
                        <a class="btn btn-primary" href="{{ route('remindAll') }}" onclick="event.preventDefault();document.getElementById('remindAllForm').submit();">
                        Remind All
                        </a>
                    </form>
                    <form id="prologueAllForm" action="{{ route('prologueAll') }}" method="POST" style="float: right;">
                        @csrf
                        <a class="btn btn-primary" href="{{ route('prologueAll') }}" onclick="event.preventDefault();document.getElementById('prologueAllForm').submit();">
                        Prologue All
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
                            <th class="text-center">NPK</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">No HP</th>
                            <th class="text-center">Batch</th>
                            <th class="text-center">Survey Link</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Action</th>
                        </tr>
                    @foreach($data as $row)
                        <tr>
                            <td style="text-align: center;">{{$row->npk}}</td>
                            <td style="text-align: center;">{{$row->nama}}</td>
                            <td style="text-align: center;">{{$row->email}}</td>
                            <td style="text-align: center;">{{$row->no_hp}}</td>
                            <td style="text-align: center;">{{$row->batch}}</td>
                            <td style="text-align: center;">{{$row->survey_link}}</td>
                            <td style="text-align: center;">{{$row->status}}</td>
                            <td style="text-align: center;">{{$row->category}}</td>


                            <td class="text-center align-middle">
                            <div class="btn-group align-top">
                                <form id="sendChatForm_{{$row->npk}}" action="{{ route('sendChat') }}" method="POST" style="">
                                    @csrf
                                        <input type="text" id="data_{{$row->no_hp}}" name="data_{{$row->no_hp}}"  value="{{$row->no_hp.';'.$row->status.';'.$row->nama.';'.$row->survey_link.';'.$row->npk}}" hidden>
                                        <a class="btn btn-info"
                                        href="{{ route('sendChat') }}" onclick="event.preventDefault();document.getElementById('sendChatForm_{{$row->npk}}').submit();"
                                        id="sendChat"> Remind
                                        </a>
                                </form>
                                <form id="prologueChatForm_{{$row->npk}}" action="{{ route('prologueChat') }}" method="POST" style="">
                                    @csrf
                                        <input type="text" id="data_{{$row->no_hp}}" name="data_{{$row->no_hp}}"  value="{{$row->no_hp.';'.$row->status.';'.$row->nama.';'.$row->survey_link.';'.$row->npk}}" hidden>
                                        <a class="btn btn-info"
                                        href="{{ route('prologueChat') }}" onclick="event.preventDefault();document.getElementById('prologueChatForm_{{$row->npk}}').submit();"
                                        id="prologueChat"> Prologue
                                        </a>
                                </form>
                                <!-- <form id="sendImageForm_{{$row->npk}}" action="{{ route('sendImage') }}" method="POST" style="">
                                    @csrf
                                        <input type="text" id="data_{{$row->no_hp}}" name="data_{{$row->no_hp}}"  value="{{$row->no_hp.':'.$row->status.':'.$row->nama}}" hidden>
                                        <a class="btn btn-info"
                                        href="{{ route('sendImage') }}" onclick="event.preventDefault();document.getElementById('sendImageForm_{{$row->npk}}').submit();"
                                        id="sendImage"> Image
                                        </a>
                                </form>
                                <form id="sendFileForm_{{$row->npk}}" action="{{ route('sendFile') }}" method="POST" style="">
                                    @csrf
                                        <input type="text" id="data_{{$row->no_hp}}" name="data_{{$row->no_hp}}"  value="{{$row->no_hp.':'.$row->status.':'.$row->nama}}" hidden>
                                        <a class="btn btn-info"
                                        href="{{ route('sendFile') }}" onclick="event.preventDefault();document.getElementById('sendFileForm_{{$row->npk}}').submit();"
                                        id="sendFile"> File
                                        </a>
                                </form>
                                <form id="sendVoiceForm_{{$row->npk}}" action="{{ route('sendVoice') }}" method="POST" style="">
                                    @csrf
                                        <input type="text" id="data_{{$row->no_hp}}" name="data_{{$row->no_hp}}"  value="{{$row->no_hp.':'.$row->status.':'.$row->nama}}" hidden>
                                        <a class="btn btn-info"
                                        href="{{ route('sendVoice') }}" onclick="event.preventDefault();document.getElementById('sendVoiceForm_{{$row->npk}}').submit();"
                                        id="sendVoice"> Voice
                                        </a>
                                </form> -->
                                <!-- <form id="report-form-{{$row->npk}}" name="report-form-{{$row->npk}}" action="{{ route('per_tabular') }}" method="POST">
                                    @csrf
                                    <input type="text" id="data_{{$row->no_hp}}" name="data_{{$row->no_hp}}"  value="{{$row->no_hp.':'.$row->status.':'.$row->nama}}" hidden>
                                    <a class="btn btn-info"
                                        href="{{ route('per_tabular') }}" onclick="event.preventDefault();document.getElementById('report-form-{{$row->npk}}').submit();"
                                        id="perTabular"> PER1
                                        </a>
                                </form> -->
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
