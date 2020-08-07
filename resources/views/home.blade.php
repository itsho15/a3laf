@extends('layouts.front')
@section('header')
  @include('front.components.home_subheader')
@endsection
@section('carousel')
 @include('front.components.carousel')
@endsection
@section('content')
    	<!-- Content Head -->
          <div class="content-head d-flex justify-content-between align-items-center mb-4" >
              <h2 class="content-title">@lang('front.otherads')</h2>
              <a class="more-cards" href="{{ url('categories') }}">@lang('front.loadmore')</a>
          </div>
          <!-- Content Cards -->
          <div class="row" id="otherAds">
          	   @foreach($otherAds as $ad)
               		@include('front.components.card',$ad)
               @endforeach
          </div>
          {{ $otherAds->fragment('otherAds')->links('vendor.pagination.bootstrap-4') }}
@endsection
