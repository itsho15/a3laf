<div class="content-list">
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
            <div class="d-flex justify-content-between">
                <span class="meta-date"><i class="far fa-clock"></i> {{ $ad->created_at->diffForHumans() }} </span>
                <div class="meta-price d-block">{{ __('models/ads.fields.price') }}: <span>{{ $ad->price }} {{ __('models/ads.fields.ryal') }}</div>
            </div>

            <div class="d-flex justify-content-between mt-1 mb-1">
                <h3 class="meta-title">{{ str_limit($ad->body,50) }}</h3>

                <!-- <span class="meta-status sold">تم البيع</span> -->
                <span class="meta-status ongoing">{{ __('models/ads.fields.'.$ad->status) }}</span>
            </div>
            <div class="d-flex justify-content-between">

                <div class="meta-info">
                    <span class="ml-2"><i class="fas fa-map-marker-alt"></i> {{ $ad->city->name }}</span>
                    <span><i class="fas fa-user"></i> {{ $ad->user->name }}</span>
                </div>

                <div class="star-rating">
                    <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $ad->averageRating }}" data-size="xs" disabled="">
                </div>
            </div>

        </div>
        <a href="{{ url('ads/'.$ad->id.'/'.str_slug($ad->name,'-')) }}" class="stretched-link"></a>
    </div>
</div>
@push('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css" />
@endpush

@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js"></script>
<script type="text/javascript">
    $("#input-id").rating();
</script>
@endpush

