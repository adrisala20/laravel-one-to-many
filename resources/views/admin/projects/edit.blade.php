@extends('layouts.admin')

@section('title', 'Edit Project:' . $project->title)

@section('content')
    <section>
        <div class="d-flex justify-content-between align-items-center py-4">
            <h2>Edit project: {{$project->title}}</h2>
            <a href="{{route('admin.projects.show', $project->slug)}}" class="btn btn-danger">Show Project</a>
        </div>
        <!-- FORM -->
        <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- TITLE -->
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $project->title) }}" minlength="3" maxlength="200" required>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div id="titleHelp" class="form-text text-white">Inserire minimo 3 caratteri e massimo 200</div>
            </div>
            <!-- IMAGE -->
            <div class="d-flex">
                <div class="media me-4">
                    <!-- imh placeholder -->
                    @if($project->image)
                    <img class="shadow" width="150" src="{{asset('storage/' . $project->image)}}" alt="{{$project->title}}" id="upload_preview">
                    @else
                    <img class="shadow" width="150" src="/image/placeholder.jpeg" alt="{{$project->title}}" id="upload_preview">
                    @endif
                </div>
                <!-- img -->
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" id="upload_image"
                        name="image" value="{{ old('image', $project->image) }}">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- CONTENT -->
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" required>
                {{ old('content', $project->content) }}
              </textarea>
                @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
             <!-- CATEGORY SELECt -->
             <div class="mb-3">
                <label for="category_id" class="form-label">Select Category</label>
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">Select Category</option>
                  @foreach ($categories as $category)
                      <option value="{{$category->id}}" {{ $category->id == $project->category_id ? 'selected' : '' }}>{{$category->name}}</option>
                  @endforeach
                </select>
                @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            <!-- BUTTONS -->
            <div class="mb-3">
                <button type="submit" class="btn btn-danger">Save</button>
                <button type="reset" class="btn btn-secondary">Reset</button>

            </div>
        </form>
    </section>
   @include('partials.editor')

@endsection