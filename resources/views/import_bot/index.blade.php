@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Respondents') }}
                    <div class="parentnav">
                        <button class="btn btn-primary navitem" type="button" data-bs-toggle="modal" data-bs-target="#modalRemind">
                        Edit Remind
                        </button>
                        <button class="btn btn-primary navitem" type="button" data-bs-toggle="modal" data-bs-target="#modalPrologue">
                        Edit Prologue
                        </button>
                    </div>
                    <br><br>
                    <div class="parentnav">
                        <button class="btn btn-primary navitem" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Import Data
                        </button>
                        <form class="navitem" id="remindAllForm" action="{{ route('remindAll') }}" method="POST" >
                            @csrf
                            <a class="btn btn-primary navitem" href="{{ route('remindAll') }}" onclick="event.preventDefault();document.getElementById('remindAllForm').submit();">
                            Remind All
                            </a>
                        </form>
                        <form class="navitem" id="prologueAllForm" action="{{ route('prologueAll') }}" method="POST" >
                            @csrf
                            <a class="btn btn-primary navitem" href="{{ route('prologueAll') }}" onclick="event.preventDefault();document.getElementById('prologueAllForm').submit();">
                            Prologue All
                            </a>
                        </form>
                    </div>
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
                    <form method="POST" action="{{ url('/bot_by_import/import') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="file" class="col-md-4 col-form-label text-md-end">{{ __('Input File') }}</label>
                                <div class="col-md-6">
                                    <input id="file" type="file" class="form-control" name="select_file"  required autofocus>
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
                <!-- Modal -->
                <div class="modal fade" id="modalRemind" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalRemindLabel">Update Remind</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ url('/update_remind') }}" >
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Remind Template') }}</label>
                                    @foreach($template as $row)
                                        @if($row->nama_template=='remind')
                                        <textarea name="remind_area" id="remind_area" cols="2" rows="5" style="padding-right:5px;">{{  str_replace('\n', "\n", $row->content)  }}</textarea>
                                        @endif
                                    @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="update" value="Update"></input>
                        </div>
                    </form>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modalPrologue" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPrologueLabel">Update Prologue</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ url('/update_prologue') }}" >
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label class="col-md-4 col-form-label text-md-end">{{ __('Prologue Template') }}</label>
                                @foreach($template as $row)
                                    @if($row->nama_template=='prologue')
                                    <textarea name="prologue_area" id="prologue_area" cols="2" rows="20" style="padding-right:5px;">{{  str_replace('\n', "\n", $row->content)  }}</textarea>
                                    @endif
                                @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="update" value="Update"></input>
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
