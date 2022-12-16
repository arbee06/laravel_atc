@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Respondents from QMLi') }}
                    <button wire:click="remindAll" class="btn btn-primary" style="float: right;">remind all dummy</button>
                    <select name="batch_select" id="batch_select" class="form-select js-example-basic-single">
                        <option value="BATCH 1">BATCH 1</option>
                        <option value="BATCH 2">BATCH 2</option>
                        <option value="BATCH 3">BATCH 3</option>
                        <option value="BATCH 4">BATCH 4</option>
                        <option value="BATCH 5">BATCH 5</option>
                        <option value="BATCH 6">BATCH 6</option>
                    </select>
                </div>

                <!-- Button trigger modal -->
                <!-- Modal -->

                <!-- Modal -->

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
                        @if (isset($response))
                            @foreach($response as $row)
                            <tr>
                                <td style="text-align: center;" >{{$row[1]}}</td>
                                <td style="text-align: center;">{{$row[2]}}</td>
                                <td style="text-align: center;">{{$row[0]}}</td>
                                <td style="text-align: center;">{{$row[5]}}</td>
                                <td style="text-align: center;">{{$row[6]}}</td>
                                <td style="text-align: center;width:150px;table-layout:fixed" class="tdbreak">
                                {{$row[4]}}
                                </td>
                                <td style="text-align: center;">{{$row[3]}}</td>
                                <td style="text-align: center;">{{$row[7]}}</td>
                                
                            </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('.js-example-basic-single').select2();
</script>
@endsection
