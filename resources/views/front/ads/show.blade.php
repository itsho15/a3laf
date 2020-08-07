@extends('layouts.front')
@section('description'){{ $ad->body }}@endsection
@section('author') {{ $ad->user->name }}@endsection
@section('keywords'){{ $ad->name }}@endsection

@section('header')
  @include('front.components.subheader')
@endsection
@section('content')
    	<div class="single pt-5 pb-5">
    <div class="container">
        <div class="row">

            <div class="col">
                <header>
                    <h1 class="entry-title">{{ $ad->name }}</h1>
                    <div class="d-flex justify-content-between dnone">
                        <div class="entry-info"><span>تم إضافة الإعلان في  {{ $ad->created_at }}</span> , <span>رقم الإعلان: {{ $ad->id }}</span></div>
                        <span class="entry-address">{{ $ad->city->name }}</span>
                    </div>

                    <div class="mt-4">
                        <ul id="lightSlider">
                            @foreach($ad->images as $img)
                                <li data-thumb="{{ $img->full_file}}">
                                    <img class="img-fluid" src="{{ $img->full_file }}" />
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </header>

                <article id="article">
                    <strong>@lang('front.description')</strong>
                    <p>  {{ $ad->body }} </p>
                </article>

                <footer >
                    <div class="comments" >
                        <h2>@lang('front.comments')</h2>

                        @foreach($comments = $ad->comments()->paginate(25) as $comment)
                          @if(contains($comment->body,explode(',', setting('block_list_words'))) == false)
                             <div class="comment-body {{ ($comment->user->id == $ad->user_id) ? 'seller-comment' : '' }} mb-3">
                                <div class="comment-meta">
                                    <strong class="user">{{ $comment->user->name }}</strong>
                                    <span class="date">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>

                                <p class="comment-text">{{ $comment->body }}</p>
                            </div>
                          @endif

                        @endforeach

                        {!! $comments->fragment('article')->links('vendor.pagination.bootstrap-4') !!}
                    </div>

                    <div class="leave-comment mt-5">
                        <h2>@lang('front.leaveComment')</h2>

                        <div class="leave-comment-inner shadow-sm">
                            @if(auth()->check())
                                {!! Form::open(['route' => 'front.comments.store']) !!}
                                 {!! Form::hidden('ad_id', $ad->id) !!}
                                 {!! Form::hidden('user_id', auth()->id()) !!}
                                    <div class="form-row mb2">
                                        <div class="col-12">
                                          {!! Form::label('body', __('models/comments.fields.yourcomment').':') !!}
                                          {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">إرسال التعليق</button>
                                {!! Form::close() !!}
                            @else
                                <a class="btn btn-secondary" href="{{ url('login') }}">@lang('front.login_first')</a>
                            @endif
                        </div>
                    </div>
                </footer>

            </div>

            <div class="col-md-3 mobile-first">
                <div class="single-sidebar">

                    <div class="seller-info mb-3">
                        <i class="far fa-user" aria-hidden="true"></i>
                        <strong>{{ $ad->user->name }}</strong>
                        <span>@lang('front.on_website') {{ $ad->user->created_at->diffForHumans() }}</span>
                    </div>

                    <div class="btn-block price">{{ __('models/ads.fields.price') }} : <span>{{ $ad->price }} {{ __('models/ads.fields.ryal') }}</div>

                    @if(in_array('phone',$ad->contact_types))
                        <a class="btn btn-primary btn-block contact-seller mb-2" href="tel:{{ $ad->user->phone }}" role="button"><i class="fas fa-phone"></i> @lang('front.contact_seller')</a>
                    @endif

                    <!-- Button report modal -->
                    <button type="button" class="btn btn-primary btn-block mb-2 report" data-toggle="modal" data-target="#exampleModal">
                     <i class="fas fa-exclamation-triangle"></i> @lang('front.report_ad')
                    </button>

                    @if(in_array('chat',$ad->contact_types))
                         @if(auth()->check())
                            @if(auth()->id() != $ad->user->id)
                                {!! Form::open(['url' => url('conversation/create')]) !!}
                                 {!! Form::hidden('to_id', $ad->user->id) !!}
                                 {!! Form::hidden('from_id', auth()->id()) !!}
                                    <button type="submit" class="btn btn-info btn-block contact-seller">@lang('front.start_chat')</button>
                                {!! Form::close() !!}
                                @else
                               {!! Form::open(['route' => ['front.ads.destroy', $ad->id], 'method' => 'delete']) !!}

                                <a href="{{ route('front.ads.edit', $ad->id) }}" class='btn btn-info btn-block'>
                                    <i class="fa fa-edit"></i>
                                </a>
                                {!! Form::button('<i class="fa fa-trash"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-block mb-2',
                                    'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'
                                ]) !!}

                                {!! Form::close() !!}
                            @endif
                        @else
                            <a class="btn btn-secondary btn-block" href="{{ url('login') }}">@lang('front.login_first_to_start_chat')</a>
                        @endif
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           {!! Form::open(['route' => 'front.complaints.store']) !!}
            {!! Form::hidden('ad_id', $ad->id, ['class' => 'form-control']) !!}
             <!-- Content Field -->
            <div class="form-group col-sm-12 col-lg-12">
                {!! Form::label('content', __('models/complaints.fields.content').':') !!}
                {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
            </div>
            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('crud.send'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('admin.complaints.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>
            {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection
