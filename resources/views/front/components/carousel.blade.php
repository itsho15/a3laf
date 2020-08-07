<div class="carousel-list pt-5 pb-5">
    <div class="container">

        <!-- Content Head -->
        <div class="content-head d-flex justify-content-between align-items-center mb-4">
            <h2 class="content-title">@lang('front.recentAds')</h2>
            <a class="more-cards" href="{{ url('categories') }}">@lang('front.loadmore')</a>
        </div>

        <!-- Carousel -->
        <div id="new_ad_list" class="owl-carousel">
            @foreach($RecentAds as $recentAd)
                <div class="content-box">
                    <div class="content-card shadow-sm">
                        <div class="content-thumb">
                             <img class="img-fluid" src="{{ ($recentAd->images()->first()) ? $recentAd->images()->first()->full_file : 'dist/img/6@2x.jpg' }}" alt="{{ $recentAd->name }}" />
                            @if($recentAd->isFav('web') )
                             <div class="like"><i class="fa fa-heart text-danger"></i></div>
                            @else
                              <div class="like"><i class="far fa-heart"></i></div>
                            @endif
                        </div>
                        <div class="content-meta">
                            <div class="d-flex justify-content-between dnone">
                                <span class="meta-date"><i class="far fa-clock"></i>{{ $recentAd->created_at->diffForHumans() }}</span>
                                <!-- <span class="meta-status sold">تم البيع</span> -->
                                <span class="meta-status ongoing">{{ __('models/ads.fields.'.$recentAd->status) }}</span>
                            </div>
                            <h3 class="meta-title">{{ str_limit($recentAd->body,50) }}</h3>
                            <div class="meta-price d-block">{{ __('models/ads.fields.price') }}: <span>{{ $recentAd->price }} {{ __('models/ads.fields.ryal') }}</div>
                        </div>
                        <a href="{{ url('ads/'.$recentAd->id.'/'.str_slug($recentAd->name,'-')) }}" class="stretched-link"></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
