@extends('layouts.admin')
@section('title', $project->title)

@section('content')
    <div class="d-flex justify-content-between align-items-center py-4">
        <h1>Progect: {{$project->title}}</h1>
        <!-- BUTTONS -->
        <div class="m-2">
            <a href="{{route('admin.projects.edit', $project->slug)}}" class="btn btn-outline-secondary">Edit</a>
            <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button btn btn-outline-danger"  data-item-title="{{ $project->title }}">
                 Delete</i>
                </button>
              </form>
        </div>
    </div>
    <!-- IMAGE + CONTENT -->
    <div class="row">
        <!-- IMAGE -->
        <div class="col-10 col-md-6 col-lg-6 ">
            <img src="{{ asset('storage/' . $project->image)}}" class="img-fluid" alt="{{$project->title}}" class="img-fluid "> 
        </div>
        <!-- CONTENT -->
        <div class="col-10 col-md-6 col-lg-6">
            <p class="my-3">{{$project->content}}</p>
        </div>      
    </div>
    @if($project->category)
    <p class="my-3 badge text-bg-info">{{$project->category->name}}</p>
    @endif

</section>
@include('partials.modal-delete')
@endsection