@extends('layouts.app')

@section('content')
@if(session('modifica'))
  <div class="btn-success p-2 rounded-3">
    {{session('modifica')}}
  </div>
@endif
@if(session('delete'))
  <div class="btn-danger p-2 rounded-3">
    {{session('delete')}}
  </div>
@endif
@if(session('crea'))
  <div class="btn-success p-2 rounded-3">
    {{session('crea')}}
  </div>
@endif
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">titolo</th>
      <th scope="col">categoria</th>
      <th scope="col">azioni</th>
    </tr>
  </thead>
  <tbody>
      @foreach($posts as $post)
    <tr>
      <th scope="row">{{ $post->id }}</th>
      <td><a href="{{ route('admin.posts.show',$post->slug ) }}">{{ $post->title }}</a></td>
      <td>
      @if($post->category)
      {{ $post->category->name }}
      @endif
      </td>
      <td>
          <a href="{{ route('admin.posts.edit',$post->id ) }}" class="btn btn-warning">Edit</a>
          <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post" class="d-inline-block">
              @csrf
              @method('DELETE')
              <input type="submit" value="delete" class="btn btn-danger">
          </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection