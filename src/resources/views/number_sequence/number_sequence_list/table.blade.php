<table id="datatab" class="table table-striped table-hover">
    <thead>
        <tr>
            <th>{{__('NumberSequence.number-sequence-code')}}</th>
            <th>{{__('NumberSequence.name')}}</th>
            <th>{{__('NumberSequence.constant')}}</th>
            <th>{{__('NumberSequence.range')}}</th>
            <th>{{__('NumberSequence.format')}}</th>
            <th>{{__('NumberSequence.mapped')}}</th>
            <th>{{__('common.created-by')}}</th>
            <th>{{__('common.action')}}</th>
        </tr>
    </thead>

    <tbody id="myTable">
        @foreach ($data as $numbersequence)
           <tr>
            <td>{{$numbersequence?->number_sequence_code}}</td>
            <td>{{$numbersequence?->name}}</td>
            <td>{{$numbersequence?->constant_no}}</td>
            <td>{{$numbersequence?->range_no}}</td>
            <td>{{$numbersequence?->format}}</td>
            <td>
               @if(in_array($numbersequence->id, $map))
                   <input type="checkbox" checked readonly disabled>
               @else
                   <input type="checkbox" readonly disabled>
               @endif
            </td>
            <td>{{$numbersequence?->user?->name}}</td>
            <td>
                <ul class="list-inline mb-0">
                    <li class="list-inline-item dropdown">
                        <a class="text-muted dropdown-toggle font-size-18 px-2" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{route('sequence.delete',['id'=>base64_encode(convert_uuencode($numbersequence?->id))])}}"> <i class="fa fa-trash-o"></i> {{__('common.delete')}} </a>
                        </div>
                    </li>
                </ul>
            </td>
           </tr>
       @endforeach
   </tbody>
</table>
