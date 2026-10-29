@props(['title','current'])

<section class="about-page-header" style="background-image: url({{ asset('banner.png')}});">
    <div class="overlay"></div>
    <div class="container  text-center ">
      <h1 class="text-white">{{Str::title($title)}}</h1>
      <nav class="breadcrumbs">
       
        <ol>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li class="current">{{$current}}</li>
        </ol>
      </nav>
    </div>
  </section>