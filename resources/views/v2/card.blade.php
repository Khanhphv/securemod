<!-- <div onclick="
    location.href= `/game/{{$game->slug}}`"  class="card item-ref mb-3">
    <div class="item-discription">
        <div class="background" style="background-image: url({{ $game->thumb_image }})" >
        </div>
        <div class="view-more p-2">
            <b class="mt-2">{{ ($game->name) }}</b>
            <div class="views mt-3"><i class="bi bi-star-fill pe-2" style="color: #FFC554"></i>{{ $game->views }}</div>
            <div class="created_at d-none">{{ $game->created_at }}</div>
            <div class="ratting d-none">{{ $game->count }}</div>
        </div>
    </div>
</div> -->
<div class="col-md-6">
    <div class="col mb-3">
        <div class="card" onclick="location.href= `/game/{{$game->slug}}`" style="width: 30 rem;">
            <div class="background">
                <img src="{{ $game->thumb_image }}" class="card-img-top" alt="...">
            </div>
            <div class="card-body bg-dark text-white">
            <h5 class="card-title">{{ ($game->name) }}</h5>
            <a href="#" class="card-link"><i class="bi bi-star-fill pe-2" style="color: #FFC554"></i>{{ $game->views }}</a>
            </div>
        </div>
    </div>
</div>