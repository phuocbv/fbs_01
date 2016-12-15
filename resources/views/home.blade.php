@extends('layouts.app')

@section('title')
    @lang('categories.home')
@endsection

@section('content')
    <div class="container">
        @include('layouts.categories')
    </div>
     <div class="view-product">
        <div class="container">
            @foreach ($categories as $key => $category)
                <div class="col-md-12 view-category">
                    <h4>
                        <span class="badge">{{ config('category.' . ($key + 1)) }}</span>
                        <span class="title-category">{{ $category->name }}</span>
                    </h4>
                    <h5 class="view-all">
                        <a href="">
                            <span class="padding-right-5">@lang('categories.view_detail')</span> 
                            <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                        </a>
                    </h5>
                </div>
                <div class="col-md-12 row padding-top-10">
                    <div class="col-md-4 row">
                        @foreach ($category->categories as $key => $value)
                            <div class="col-md-4 padding-zero block-sub-category">
                                <a href="" class="col-md-12">
                                    <img src="{{ $value->image }}" width="75" height="75">
                                    <div>{{ $value->name }}</div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-8">
                        @foreach ($category->productsThrough as $key => $product)
                            <div class="col-md-3 padding-zero block-product-home">
                                <div class="height-120p">
                                    <a href="" class="col-md-12 img-product">
                                        @if (count($product->images) > 0)
                                            <img src="{{ $product->images[0]->url }}" class="image-product">
                                        @endif
                                    </a>
                                </div>
                                <div class="text-align-center product-name"><a href="">{{ $product->name }}</a></div>
                                <div class="product-price">
                                    <span class="price">{{ number_format($product->price, 0) }} @lang('home.currency')</span>
                                </div>
                                <div>
                                    <input name="input-start" value="{{ $product->point_rate }}" class="rating input-start" readonly="true">
                                    <input type="button" class="button btn-add-cart" value="Add Cart">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection