<div class="col-md-3">
    <div class="sidebar">
    <div id="sidebar" class="sidebar-inner">

        {{-- <div class="widget">
             {!! Form::select('city_id', App\Models\City::pluck('name','id'),request('city_id'), ['class' => 'custom-select']) !!}
        </div> --}}
        <div class="widget">
            <h3 class="widget-title"><i class="fas fa-folder-open"></i>  @lang('backend.Categories') </h3>
            <div class="widget-inner">
                @foreach($categories as $category)
                    <label class="checkbox-container d-flex justify-content-between">
                         <a href="{{ url('categories/'.$category->id) }}">
                             {{ $category->name }}
                         </a>
                         <a href="{{ url('categories/'.$category->id) }}">
                            <span> <input type="radio" @if(isset($id) && $category->id == $id) checked='checked' @endif>
                                <span class="checkmark"></span>
                            </span>
                        </a>
                            <span class="count">{{ $category->ads()->count() }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</div>
