<!doctype html>
<html lang="en">
<head>
@extends('new.header')
@section('headerTitle', $head_tags ?  $head_tags->head_title : 'Post')
@section('description', $head_tags ?  $head_tags->head_description : '')
@include('new.style')
</head>
<body @if($theme == 'dark') data-theme="dark" @endif>
@extends('new.master-layout')
@section('content')

<style>
.card-container {
    background: none !important;
}
.img-wrapper {
  position: relative;
  padding-bottom: 100%;
  overflow: hidden;
  width: 100%;
}
.img-wrapper img {
  position: absolute;
  top:0;
  left:0;
  width:100%;
  height:100%;
}
</style>

<div class="row g-5">
    <div class="col-md-8">
      <h3 class="pb-4 mb-4 fst-italic border-bottom">
        News <span class="lead">Latest news</span>
      </h3>
      @php
      function dateDiff($date)
      {
          $mydate= date("Y-m-d H:i:s");
          $theDiff="";
          //echo $mydate;//2014-06-06 21:35:55
          $datetime1 = date_create($date);
          $datetime2 = date_create($mydate);
          $interval = date_diff($datetime1, $datetime2);
          $min=$interval->format('%i');
          $sec=$interval->format('%s');
          $hour=$interval->format('%h');
          $mon=$interval->format('%m');
          $day=$interval->format('%d');
          $year=$interval->format('%y');
          if($interval->format('%i%h%d%m%y')=="00000") {
              return $sec." seconds";
          } else if($interval->format('%h%d%m%y')=="0000"){
              return $min." minutes";
          } else if($interval->format('%d%m%y')=="000"){
              return $hour." hours";
          } else if($interval->format('%m%y')=="00"){
              return $day." days";
          } else if($interval->format('%y')=="0"){
              return $mon." months";
          } else{
              return $year." years";
          }    
      }
      @endphp

      <div class="col-md-auto">
      @foreach($posts->chunk(4) as $post_row)  
        @foreach($post_row as $post)
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative" onclick="redirectToSpecificPost('{{ $post->slug }}')">
            <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-primary">@foreach ($post->tag as $singleTag)
                            <span class="label-tag">{{ $singleTag->name }}</span>
                        @endforeach</strong>
              <h3 class="mb-0">{{ $post->title }}</h3>
              <div class="mb-1 text-muted">{{ $post->user_name }} • {{ dateDiff($post->created_at) }} ago</div>
              <!-- <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p> -->
              <a href="#" class="stretched-link">Continue reading</a>
              <div class="d-flex list-unstyled mt-auto">
                <li class="d-flex align-items-center me-3">
                  <i class="bi bi-eye-fill"></i>
                  <small>&nbsp; {{ $post->view }}</small>
                </li>
                <li class="d-flex align-items-center">
                  <i class="bi bi-heart-fill"></i>
                  <small>&nbsp; {{ $post->like_post ? $post->like_post->like_count : 0 }}</small>
                </li>
              </div>
            </div>
            <div class="col-auto d-none d-lg-block">
              <img src="{{ $post->thumbnail }}" class="img-fluid" style="height:200px;width:250px;overflow: hidden;object-fit: cover;">
            </div>
          </div>
        @endforeach
      @endforeach
      
    </div>

    </div>

    <!-- <div class="col-md-4 py-4" style="background: var(--sidebar);border-radius: 8px;">
      <div class="position-sticky" style="top: 2rem;">
        <div class="p-4 mb-3 bg-dark rounded">
          <h4 class="fst-italic">About</h4>
          <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>
        </div>

        <div class="p-4">
          <h4 class="fst-italic">Elsewhere</h4>
          <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
          </ol>
        </div>

      </div>
    </div> -->

  </div>
    
@endsection
<script>
    function redirectToSpecificPost(slug) {
        window.location.href = '/post/' +slug;
    }
</script>
</body>
</html>


