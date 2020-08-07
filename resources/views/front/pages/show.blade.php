@extends('layouts.front')
@section('header')
  @include('front.components.subheader')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ $page->title }}</h3>

                <p>{!! $page->body !!}</p>
            </div>
        </div>
    </div>
@endsection
