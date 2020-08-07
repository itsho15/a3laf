@extends('layouts.front')
@section('header')
  @include('front.components.subheader')
@endsection

@section('content')
     <div class="container">
        <div class="row">
            <div class="col pt-5 pb-5">
                @foreach($ads as $ad)
                    @include('front.components.myads',['ads'=>$ads])
                @endforeach
                 <!-- Paginaiton -->
                 {{ $ads->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
