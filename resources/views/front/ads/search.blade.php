@extends('layouts.front')
@section('header')
  @include('front.components.subheader')
@endsection

@section('content')
          <!-- Content Cards -->
          <div class="row" id="search">
            @if($searchResults->count() > 0)
          	   @foreach($searchResults as $ad)
               		@include('front.components.card',$ad)
               @endforeach
            @else
              <p class="text-center">@lang('front.not_found_search')</p>
            @endif
          </div>
          {{ $searchResults->fragment('search')->links('vendor.pagination.bootstrap-4') }}
@endsection
