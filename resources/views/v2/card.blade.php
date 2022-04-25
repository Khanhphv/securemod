<div class="col-md-4 my-2">

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