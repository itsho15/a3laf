<div class="content-box col-lg-3 col-6">
    <div class="content-card shadow-sm">
        <div class="content-thumb">
            <img class="img-fluid" src="{{ ($ad->images()->first()) ? $ad->images()->first()->full_file : url('dist/img/6@2x.jpg') }}" alt="{{ $ad->name }}" />
            @if($ad->isFav('web') )
             <div class="like"><i class="fa fa-heart text-danger"></i></div>
            @else
              <div class="like"><i class="far fa-heart"></i></div>
            @endif
        </div>
        <div class="content-meta">
            <div class="d-flex justify-content-between dnone">
                <span class="meta-date"><i class="far fa-clock"></i> {{ $ad->created_at->diffForHumans() }} </span>
                <!-- <span class="meta-status sold">تم البيع</span> -->
                <span class="meta-status ongoing"> {{ __('models/ads.fields.'.$ad->status) }}</span>
            </div>
            <h3 class="meta-title">{{ str_limit($ad->body,50) }}</h3>
            <div class="meta-price d-block">{{ __('models/ads.fields.price') }} : <span>{{ $ad->price }} {{ __('models/ads.fields.ryal') }}</span></div>
        </div>
        <a href="{{ url('ads/'.$ad->id.'/'.str_slug($ad->name,'-')) }}" class="stretched-link"></a>
    </div>
</div>
