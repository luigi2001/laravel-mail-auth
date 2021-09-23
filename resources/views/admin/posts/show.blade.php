@extends('layouts.app')

@section('content')
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">{{ $post->title }}</li>
    @if($post->category)
    <li class="list-group-item">{{ $post->category->name }}</li>
    @endif
    @forelse($post->tags as $tag)
    <li class="list-group-item">{{ $tag->name }}</li>
    @empty
    @endforelse

    <li class="list-group-item">{{ $post->content }}</li>
  </ul>
</div>
@endsection