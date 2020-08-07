<form action="/search" method="get" role="search">

    <div class="form-row align-items-center">
        <div class="col-md-4 col-12 ico-input">
            <i class="fas fa-search"></i>
            <input type="text" class="form-control" name="keyword" id="inlineFormInput" placeholder="@lang('front.search_text')" value="{{ request('keyword')}}">
        </div>

        <div class="col-md-3 col-12">
            {!! Form::select('category_id', App\Models\Category::pluck('name','id'),request('category_id'), ['class' => 'custom-select','placeholder' => trans('front.please_select')]) !!}
        </div>

        <div class="col-md-3 col-12">
               {!! Form::select('city_id', App\Models\City::pluck('name','id'),request('city_id'), ['class' => 'custom-select','placeholder' => trans('front.please_select')]) !!}
        </div>

        <div class="col-md-2 col-12">
            <button type="submit" class="btn btn-secondary">@lang('front.search_btn')</button>
        </div>
    </div>
</form>
