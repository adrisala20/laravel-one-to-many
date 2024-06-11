@extends('layouts.admin')

@section('title', 'Create Project')

@section('content')
    <section>
        <h2>Create a new project</h2>
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <!-- TITLE -->
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title') }}" minlength="3" maxlength="200" required>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div id="titleHelp" class="form-text text-white">Insert a min of 3 and max of 200 letters</div>
            </div>
            <!-- IMAGE -->
            <div class="mb-3">
                <!-- placeholder -->
                <img src="/image/placeholder.jpeg" id="upload_preview" witdh="100" class="img-show">
                <label for="image" class="form-label mt-3">Image</label>
                <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" id="upload_image"
                    name="image" value="{{ old('image') }}">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- CONTENT -->
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" required>
                {!! old('content') !!}
              </textarea>
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- CATEGORY SELECD -->
            <div class="mb-3">
                <label for="category_id" class="form-label">Select Category</label>
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">Select Category</option>
                  @foreach ($categories as $category)
                      <option value="{{$category->id}}" {{ $category->id == old('category_id') ? 'selected' : '' }}>{{$category->name}}</option>
                  @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            <!-- BUTTONS -->
            <div class="mb-3">
                <button type="submit" class="btn btn-danger">Create</button>
                <button type="reset" class="btn btn-secondary">Reset</button>

            </div>
        </form>
    </section>
    <!-- nice editor nel content si inserisce i punti esclamativi -->
   @include('partials.editor')

@endsection