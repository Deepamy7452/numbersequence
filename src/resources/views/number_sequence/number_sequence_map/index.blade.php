

@extends('layouts.master')

@section('title')
{{__('NumberSequence.number-sequence')}}
@endsection
@section('css')
@endsection
@section('page-title')
Number Sequence
@endsection
@section('body')

    <body>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('NumberSequence.number-sequence-map')}}</h4>
                    </div>
                    <div class="card-body">
                        @include('numbersequence::number_sequence.number_sequence_map.table')
                    </div>
                </div>
            </div>
        </div>

        <div id="mapSequence" class="modal right fade" tabindex="-1" aria-labelledby="myModalLabel"
            aria-hidden="true" data-bs-scroll="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">{{__('NumberSequence.map-number-sequence')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('numbersequence.map')}}" class="basic-form" >
                            @csrf
                            <div class="body">
                                <input type="hidden" name="wf_id" id="wf_id" value="">
                                <div class="row p-4">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="hidden" name="formid" id="formdata" class="form-control"/>
                                            <label for="formrow-firstname-input"
                                            class="form-label">{{__('NumberSequence.map-no-sequence')}} </label>
                                                <select name="sequencemaping" class="form-control" alt="select" emsg="Please Select Number Sequence" @required(true)>
                                                    <option value="">Select Number Sequence</option>
                                                        @foreach ($no_seq as $sequence)
                                                            <option value="{{$sequence?->id}}"> {{$sequence?->number_sequence_code}} / {{$sequence?->name}}</option>
                                                        @endforeach
                                                </select>
                                            @error('e_code')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Close</button>
                            <button name="submit" type="submit" class="btn btn-primary mr-1" style="top: 0">{{__('common.update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="logModel" class="modal right fade" tabindex="-1" aria-labelledby="myModalLabel"
            aria-hidden="true" data-bs-scroll="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">{{__('NumberSequence.view-log')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                <div class="body m-4" id="mainDiv">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-bs-dismiss="modal">Close</button>
                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script>
            $(document).ready(function(){
                $(document).on('click','#map_sequence',function(){
                var w_id = $(this).attr('data-id');
                $('#formdata').val(w_id);
           });
        });
        </script>

        <script>
            $(document).ready(function() {
                    $(document).on('click', '.viewdetailslog', function() {
                        var w_id = $(this).attr('data-id');
                        if (w_id > 0) {
                            // AJAX request
                            var url = "{{ route('sequence-log.details', [':id']) }}";
                            url = url.replace(':id', w_id);
                            $.ajax({
                                url: url,
                                dataType: 'json',
                                success: function(response) {
                                     $('#mainDiv').html('');
                                    //  console.log(response);
                                    $.each(response,function(index,data){
                                    var formId = data['id'];
                                    var mapingdate = data['mapping_date'];
                                    var seq_code = data['sequence']['number_sequence_code'];
                                    var seq_name=data['sequence']['name']
                                    var usrname = data['user']['name'];
                                    var logdiv ='<div class="timeline-item green" date-is="'+mapingdate+'">'
                                        +'<p>Mapping created for sequence :'+ seq_code +', name : "'+ seq_name +'"</p>'
                                        +'<div><p class="mb-2 mt-1"><i class="fa fa-user"></i> <b>'+usrname+'</b></p></div>'
                                    +'</div>';
                                    $('#formdata').val(formId);
                                    $('#mainDiv').append(logdiv);
                                });
                            }
                            });
                        }
                    });
                });
        </script>
    @endsection



