<table id="datatab" class="table table-striped table-hover">
    <thead>
        <tr>
            <th>{{__('NumberSequence.area')}}</th>
            <th>{{__('NumberSequence.number-sequence')}}</th>
            <th>{{__('NumberSequence.format')}}</th>
            <th>{{__('NumberSequence.next')}}</th>
            <th>{{__('NumberSequence.mapped-on')}}</th>
            <th>{{__('common.created-by')}}</th>
            <th>{{__('common.action')}}</th>
        </tr>
    </thead>
    <tbody id="myTable">
       @foreach ($data as $seq)
            <tr>
                <td>{{$seq?->map_name}}</td>
                <td>{{$seq?->number_sequence?->name }}</td>
                <td>{{$seq?->number_sequence?->format }}</td>
                <td>
                    @if($seq?->number_sequence?->id)
                        @php echo (amy\numbersequence\src\Helpers\NumberSeqHelper::get_next_no($seq?->map_name)) @endphp
                    @endif
                </td>
                <td>{{$seq?->maping_date }}</td>
                <td>{{$seq?->user?->name }}</td>
                <td>
                    {{-- <div class="btn-group">
                        <button type="button" class="btn btn-light border rounded dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> {{__('common.action')}} <i class="nav-icon fa fa-caret-down"></i></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item viewdetailmap" href="#" data-bs-toggle="modal" data-bs-target="#mapSequence" id="map_sequence" data-id="{{ $seq->id }}"> {{__('NumberSequence.map-no-sequence')}}</a>
                                <a class="dropdown-item viewdetailslog" href="#"
                                data-toggle="modal" data-target="#logModel" data-id="{{ $seq->id }}"> {{__('NumberSequence.view-log')}}</a>
                        </div>
                    </div> --}}
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item dropdown">
                            <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item viewdetailmap" href="#" data-bs-toggle="modal" data-bs-target="#mapSequence" id="map_sequence" data-id="{{ $seq->id }}"> {{__('NumberSequence.map-no-sequence')}}</a>
                                <a class="dropdown-item viewdetailslog" href="#" data-bs-toggle="modal" data-bs-target="#logModel" data-id="{{ $seq->id }}"> {{__('NumberSequence.view-log')}}</a>
                            </div>
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
   </tbody>
</table>
