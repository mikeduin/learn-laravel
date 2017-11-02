@extends('layouts.master')

@section('content')
  <div class="row">
      <div class="col-md-12">
          <p class="quote">The beautiful Laravel</p>
      </div>
  </div>
  @foreach($posts as $post)
  <div class="row">
      <div class="col-md-12 text-center">
          <h1 class="post-title">{{ $post['title']}}</h1>
          <p>{{ $post['content']}}</p>
          {{-- Here we use PHP's array_search method to search the array of $posts for this specific $post's ID  --}}
          {{-- In a typical application this data would instead be fetched from a database --}}
          <p><a href="{{ route('blog.post', ['id' => array_search($post, $posts)]) }}">Read more...</a></p>
      </div>
  </div>
  <hr>
  @endforeach

@endsection



{{-- @section('content')
  <div class="row">
    <div class="col-md-12">
      <h1>Control Structures</h1>
      @if(false)
        <p>This only displays if true</p>
      @else
        <p>This only displays if it is false</p>
      @endif
      <hr>
      @for($i = 0; $i<5; $i++)
        <p> {{ $i + 1 }}. Iteration </p>
      @endfor
      <hr>
      <h2>XSS</h2>
      {{ "<script>alert('Hello')</script>" }}
      {!! "<script>alert('Hello')</script>" !!}
    </div>
  </div>
@endsection --}}
