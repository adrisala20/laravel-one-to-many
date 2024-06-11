@extends('layouts.admin')
@section('title', 'Projects')

@section('content')
    <section class="container">
        <!-- message delete/create -->
        @if(session()->has('message'))
        <div class="alert alert-success">{{session()->get('message')}}</div>
        @endif
        <!-- title -->
        <div class="d-flex justify-content-between align-items-center py-4">
            <h1 class="text-uppercase fw-bold">Projects</h1>
            <a href="{{route('admin.projects.create')}}" class="btn btn-primary">New project</a>
        </div>
        <!-- Table -->
        <table class="table table-hover overflow-x-scroll">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col"> Created At</th>
                <th scope="col">Update At</th>
                <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                <td>{{$project->id}}</td>
                <td>{{$project->title}}</td>
                <td>{{$project->slug}}</td>
                <td>{{$project->create_at}}</td>
                <td>{{$project->update_at}}</td>
                <!-- Actions -->
                <td>
                    <a href="{{route('admin.projects.show', $project->slug)}}" class="text-black" title="show"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{route('admin.projects.edit', $project->slug)}}" class="link-success" title="edit"><i class="fa-solid fa-pen"></i></a>
                    <!-- Delete -->
                    <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST" class="d-inline-block">
                    @csrf
                    @method('Delete')
                    <button type="submit" class="delete-button border-0 bg-transparent text-danger" data-item-title="{{$project->title}}" data-item-id = "{{ $project->id }}">
                    <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
                    
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    {{ $projects->links('vendor.pagination.bootstrap-5')}}
    @include('partials.modal-delete')
@endsection
