@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('content')
<div class="container">
    <h1>Manage Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
             <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Products Count</th>
                <th>Actions</th>
             </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
             <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ Str::limit($category->description, 50) }}</td>
                <td>{{ $category->products_count }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
             </tr>
            @empty
             <tr>
                <td colspan="5">No categories found.</td>
             </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection