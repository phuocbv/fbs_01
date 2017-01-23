@foreach($collections as $key => $collection)
    <tr>
        <td class="colum">{!! ($page == null ? 0 : ($page - 1) ) * config('view.panigate-10') + $key + 1 !!}</td>
        <td class="colum"><a href="{{ route('user.collection.show', $collection) }}" id="collection-{{ $collection->id }}">{!! $collection->name !!}</a></td>
        <td class="colum">{{ count($collection->products) }}</td>
        <td class="colum"><i class="fa fa-pencil fa-fw"></i>
            <a href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="{{ $collection->id }}" data-name="" class="update">
                @lang('user.edit')
            </a>
        </td>
        <td class="colum"><i class="fa fa-trash-o fa-fw"></i>
            <a href="javascript:void(0)" 
                data-id="{!! $collection->id !!}" 
                value="{!! $collection->id !!}" 
                class="delete">
                @lang('user.delete')
            </a>
        </td>
    </tr>
@endforeach
