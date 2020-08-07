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
                        <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                    </ol>
                </nav>

                <!-- Content Head -->
                <div class="content-head categoey-head d-flex justify-content-between align-items-center mb-4">
                    <h2 class="content-title">الإعلانات</h2>
                    <div class="order">
                        <span>رتب حسب:</span>
                        <a class="active" href="#">الأحدث</a>
                        <a class="" href="#">الأقل سعراً</a>
                        <a class="" href="#">الأعلى سعرا</a>
                    </div>
                </div>
                @foreach($pagination = $category->ads()->paginate(10) as $ad)
                    @include('front.components.listSingle',['ad'=>$ad])
                @endforeach

                <!-- Paginaiton -->
                 {{ $pagination->links('vendor.pagination.bootstrap-4') }}

            </div>

        </div>
    </div>
@endsection
