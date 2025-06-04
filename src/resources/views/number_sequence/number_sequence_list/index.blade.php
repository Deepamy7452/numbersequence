
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
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Number Sequence List</h4>
                        <a href="{{ route('sequence.add')}}">
                            <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> {{__('NumberSequence.createnumbersequence')}}
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        @include('numbersequence::number_sequence.number_sequence_list.table')
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection

