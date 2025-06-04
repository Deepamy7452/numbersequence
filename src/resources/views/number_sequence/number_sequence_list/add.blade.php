
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
                <form action="{{ route('store.numbersequence') }}" method="POST">
                    @csrf
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">{{__('NumberSequence.number-sequence-list')}}</h4>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="d-flex flex-row-reverse">
                                <div class="page_action">
                                    <button type="button" class="btn btn-primary btn-sm  addmore" id=""><i
                                        class="fa fa-plus mr-1"></i>{{__('common.add')}}</button>
                                    <button type="button" class="btn btn-primary btn-sm deletee" id=""><i
                                        class="fa fa-trash mr-1"></i>{{__('common.delete')}}
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm " id=""><i
                                        class="fa fa-save mr-1"></i>&nbsp;{{__('common.save')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-lg-12 col-xl-12 col-md-12 mb-4">
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 40px;"> </th>
                                <th style="width: 120px;"> {{__('NumberSequence.number-sequence-code')}}</th>
                                <th style="width: 120px;"> {{__('NumberSequence.name')}}</th>
                                <th style="width: 120px;"> {{__('NumberSequence.constant')}}</th>
                                <th style="width: 80px;"> {{__('NumberSequence.range')}}</th>
                                <th style="width: 120px;"> {{__('NumberSequence.format')}}</th>
                            </tr>
                        </thead>
                        <tbody class="po-order-table"  id="New-number-sequence-add-list">
                        </tbody>
                    </table>
                </div>
            </form>
            </div>
        </div>
        </div>

    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script>
            $(".deletee").on('click', function() {
                $('.case:checkbox:checked').parents("tr").remove();
                // $('.check_all').prop("checked", false);
                // check();
            });
            var i=0;

            $(".addmore").on('click', function() {
                i++;
                $('#New-number-sequence-add-list').append('<tr><td style="width: 40px;"><input type="checkbox" class="case"/></td>'+
                    '<td style="width: 120px;"><input type="text" class="form-control" name="sequence_code[]" maxlength="30" required/></td>'+
                    '<td style="width: 120px;"><input type="text" class="form-control" name="sequence_name[]" maxlength="25" required/></td>'+
                    '<td style="width: 120px;"><input type="text" class="form-control" name="constant_no[]" id="const_'+i+'" maxlength="30" required onkeyup="$.concatenate_data('+i+')"/></td>'+
                    '<td style="width: 80px;"><input type="text" class="form-control" name="range_no[]" required id="range_'+i+'" onkeypress="return (event.charCode > 49 && event.charCode < 58)" maxlength = "1" onkeyup="$.concatenate_data('+i+')"/></td>'+
                    '<td style="width: 120px;"><input type="text" class="form-control" name="format_code[]" id="formate_'+i+'" maxlength="30" readonly/></td>'+
                    '</td></tr>');
            });


            // function check() {
            //     obj = $('table tr').find('span');
            //     $.each(obj, function(key, value) {
            //         id = value.id;
            //         $('#' + id).html(key + 1);
            //     });
            // }
        </script>
        <script>
            $(document).ready(function(){
                $.concatenate_data = function(id){
                    var const_id = '#const_'+id;
                    var range_id = '#range_'+id;
                    var formate_id = 'formate_'+id;
                    var constant_data = $(const_id).val();
                    var range_data = $(range_id).val();
                    var hash='';
                    while(range_data){
                        hash=hash+'#';
                        range_data--;
                    }
                    document.getElementById(formate_id).value = constant_data+hash;
                }
            });
        </script>
    @endsection

