@extends('layouts.user.app')

@section('content')
<div class="row">
    <div class='col-lg-12'>
        <h3 align="center">@lang('user.manage', ['name' => 'Collection'])</h3>
    </div>

    <div class="col-md-6 col-md-offset-3">
        {!! Form::open(['route' => 'user.collection.store']) !!}
            @include('admin.shared.error')

            <div class="form-group">
                {!! Form::label('name', Lang::get('user.label.name')) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit(Lang::get('user.save'), ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

    <div class="col-lg-12">
        @include('admin.shared.flash')
    </div>
    
    <div>
        @if (count($collections))
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th class="colum" width="10%">@lang('user.index')</th>
                        <th class="colum">@lang('user.label.name')</th>
                        <th class="colum" width="10%">@lang('user.edit')</th>
                        <th class="colum" width="10%">@lang('user.delete')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($collections as $key => $collection)
                        <tr>
                            <td class="colum">{!! $key + 1 !!}</td>
                            <td class="colum" id="collection-{{ $collection->id }}">{!! $collection->name !!}</td>
                            <td class="colum"><i class="fa fa-pencil fa-fw"></i>
                                <a href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg" data-id="{{ $collection->id }}" class="update">
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
                </tbody>
            </table>

            <div class="col-lg-7">
                {!! $collections->render() !!}
            </div>
        @endif 
    </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <h3 align="center">@lang('user.title_edit', ['name' => 'Collection'])</h3>
        <div class="form-group edit-collection">
            {!! Form::label('name', Lang::get('user.label.name')) !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'nameCollection']) !!}
        </div>

        <div class="form-group edit-collection">
            {!! Form::submit(Lang::get('user.update'), ['class' => 'btn btn-primary', 'id' => 'btnUpdateCollection']) !!}
        </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="{!! asset('js/collection.js') !!}"></script>
<script type="text/javascript">
    var collection = new collection;
    collection.init();
</script>
@stop
