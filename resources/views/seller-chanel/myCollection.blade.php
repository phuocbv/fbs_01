@extends('layouts.seller.app')

@section('content')
<link rel="stylesheet" href="{{ asset('user/css/collection.css') }}">
<div class="container">
    <div class="speace50"></div>
    <div class="row margin-top-20">
        <ol class="breadcrumb border-shadow-bottom">
            <li>
                <a href="{{ route('user.user.myShop') }}">
                    @lang('seller.my-shop')
                </a>
            </li>
        </ol>
    </div>
    <div class="row">
        <input type="button" class="button btn-add-product" value="@lang('collection.add-collection')"
            data-toggle="modal" data-target="#addCollection">
    </div>   
    <div>
        @if (count($collections))
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th class="colum" width="10%">@lang('user.index')</th>
                        <th class="colum">@lang('user.label.name')</th>
                        <th class="colum">@lang('user.collection.total-product')</th>
                        <th class="colum" width="10%">@lang('user.edit')</th>
                        <th class="colum" width="10%">@lang('user.delete')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($collections as $key => $collection)
                        <tr>
                            <td class="colum">{!! $key + 1 !!}</td>
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
                </tbody>
            </table>
        @endif 
    </div>

    <div class="modal fade" id="addCollection" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">@lang('collection.add-collection')</h4>
                    </div>
                    <div class="modal-body">     
                        <div class="form-group">
                            <label for="name">@lang('collection.collection-name')</label>
                            {!! Form::input('text', 'name', null, 
                                ['class' => 'form-control', 'placeholder' => Lang::get('collection.collection-name'), 'id' => 'nameCollection']) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default" data-dismiss="modal">@lang('collection.close')</button>
                        <button type="button" class="btn btn-primary" id="btn-add" data-type="add">@lang('collection.add-collection')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{!! asset('seller/js/collection.js') !!}"></script>
<script src="{{ asset('/js/dttable.js') }}"></script>
<script type="text/javascript">
    var dttable = new dttable();
    dttable.init('#dataTables-example');
    var collection = new collection;
    collection.init();
</script>
@stop
