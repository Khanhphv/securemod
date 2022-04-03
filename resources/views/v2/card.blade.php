<div onclick="
    location.href= `/game/{{$game->slug}}`"  class="item-ref mb-3">
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
</div>
