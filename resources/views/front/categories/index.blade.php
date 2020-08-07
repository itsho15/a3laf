@extends('layouts.front')

@section('header')
  @include('front.components.subheader')
@endsection

@section('content')
     <div class="container">
        <div class="row">
            @include('front.components.sidebar')
            <div class="col pt-5 pb-5">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">@lang('front.homepage')</a></li>
                        <li class="breadcrumb-item"><a href="#">@lang('backend.Categories')</a></li>
                    </ol>
                </nav>
                <!-- Content Head -->
                <div class="content-head categoey-head d-flex justify-content-between align-items-center mb-4">
                    <h2 class="content-title">@lang('front.ads')</h2>
                    <div class="order">
                        <span>@lang('front.sortby') :</span>
                        <a class="{{ (request('sort') == 'desc') ? 'active' : '' }}" href="?sort=desc">@lang('front.newest')</a>
                        <a class="{{ (request('sort') == 'low_price') ? 'active' : '' }}" href="?sort=low_price">@lang('front.low_price')</a>
                        <a class="{{ (request('sort') == 'high_price') ? 'active' : '' }}" href="?sort=high_price">@lang('front.high_price')</a>
                    </div>
                </div>
                @foreach($ads as $ad)
                    @include('front.components.list',['ads'=>$ads])
                @endforeach
                 <!-- Paginaiton -->
                 {{ $ads->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
