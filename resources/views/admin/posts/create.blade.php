@extends('layouts.app')

@section('content')
<form action="{{ route('admin.posts.store')}}" method="post" class="container">
    @csrf
  <div class="mb-3">
    <label for="titolo" class="form-label">titolo</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="titolo" name="title" value="{{ old('title') }}">
    @error('title') <div class="btn btn-danger">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <label for="categories" class="form-label">categorie</label>
    <select name="category_id" id="categories" class="form-control @error('category_id') is-invalid @enderror">
      <option value=""></option>
      @foreach($categories as $category)
      <option value="{{$category->id}}" @if($category->id == old('category_id')) selected @endif>{{$category->name}}</option>
      @endforeach
    </select>
    @error('category_id') <div class="btn btn-danger">{{ $message }}</div> @enderror
  </div>
  <div class="mb-3">
    <h5>tags</h5>
    <div>
      @foreach($tags as $tag)
      <input type="checkbox" class="form-controll" id="{{ $tag->id }}" value="{{ $tag->id }}" name="tags[]" @if(in_array($tag->id, old('tags', []))) checked @endif >
      <label class="form-label btn" for="{{ $tag->id }}">{{ $tag->name }}</label>
      @endforeach
    </div>
  </div>
  <div class="mb-3">
    <label for="contenuto" class="form-label">contenuto</label>
    <textarea name="content" id="contenuto" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
    @error('content') <div class="btn btn-danger">{{ $message }}</div> @enderror
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection