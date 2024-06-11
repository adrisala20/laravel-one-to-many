@extends('layouts.admin')
@section('title', 'categories')

@section('content')
    <section class="container">
        <!-- message delete/create -->
        @if(session()->has('message'))
        <div class="alert alert-success">{{session()->get('message')}}</div>
        @endif
        <!-- title -->
        <div class="d-flex justify-content-between align-items-center py-4">
            <h1 class="text-uppercase fw-bold">categories</h1>
            {{--<a href="{{route('admin.categories.create')}}" class="btn btn-primary">New project</a>--}}
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
                @foreach($categories as $category)
                <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->slug}}</td>
                <td>{{$category->create_at}}</td>
                <td>{{$category->update_at}}</td>
                <!-- Actions -->
                <td>
                    <a href="{{route('admin.categories.show', $category->slug)}}" class="text-black" title="show"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{route('admin.categories.edit', $category->slug)}}" class="link-success" title="edit"><i class="fa-solid fa-pen"></i></a>
                    <!-- Delete -->
                    <form action="{{route('admin.categories.destroy', $category->slug)}}" method="POST" class="d-inline-block">
                    @csrf
                    @method('Delete')
                    <button type="submit" class="delete-button border-0 bg-transparent text-danger" data-item-title="{{$category->name}}" data-item-id = "{{ $category->id }}">
                    <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
                    
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
   {{-- {{ $categories->links('vendor.pagination.bootstrap-5')}}--}}
    @include('partials.modal-delete')
@endsection
