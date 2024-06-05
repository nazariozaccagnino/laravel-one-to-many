@extends('layouts.admin')
@section('content')
<section>
  <div class="container">
    <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Insert a title">
      </div>
      @error('title')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <input type="text" class="form-control" id="content" name="content" placeholder="Insert content">
      </div>
      @error('content')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      <div class="mb-3">
        <img id="uploadPreview" width="100" src="/images/placeholder.png">
        <label for="image" class="form-label">Image</label>
        <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" id="uploadImage"
          name="image" value="{{ old('image') }}" maxlength="255">
        @error('image')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @endsection