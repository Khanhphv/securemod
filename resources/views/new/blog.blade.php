@extends('new.master-layout')
@section('content')
    <style>
		.ugly-vl {
			display: none;
		}
	</style>

	<div class="main-blog">
		@if(!isset($blogs) || count($blogs) == 0)

					<div class="row">
						<div class="col-md-12">
							<p>Sorry, there are no post here.</p>
						</div>
					</div>
		@else
			@foreach ($blogs AS $blog)
				<div class="blog-post">
					<div class="row">
						<div class="col-md-5">
							<a href="{{route('blog', $blog->id)}}" title="{{$blog->title}}"><img class="blog-thumbnail" src="{{$blog->thumbnail}}" title="{{$blog->title}}" alt="{{$blog->title}}" /></a>
						</div>
						<div class="col-md-7">
							<div class="blog-post-description">
								<div class="blog-story-in"><strong style="color: #AAA; text-transform: uppercase">{{$blog->game_name}}</strong> / {{date("H:i d/m/Y", strtotime($blog->updated_at))}}</div>
								<a href="{{route('blog', $blog->id)}}" title="{{$blog->title}}"><h2 class="blog-h2-title">{{$blog->title}}</h2></a>
								<p class="blog-description">{{ltrim(mb_substr(html_entity_decode(strip_tags($blog->content)), 0, 250))}}...</p>
							</div>
						</div>
					</div>
				</div>
			@endforeach
		@endif
	</div>
@endsection
