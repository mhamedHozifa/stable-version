@extends('layouts.admin')

@section('title', 'Manage Categories')

@section('content')
<div class="container">
    <h1>Manage Categories</h1>
    <button class="btn btn-primary" onclick="openModal('create')">Add New Category</button>



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
                    <button class="btn btn-sm btn-edit" onclick="openModal('edit', {{ $category->id }})">Edit</button>
                    <button class="btn btn-sm btn-delete" onclick="confirmDelete({{ $category->id }})">Delete</button>
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

<!-- Modal for Create/Edit -->
<div id="categoryModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle">Add Category</h2>
        <form id="categoryForm" method="POST">
            @csrf
            <input type="hidden" name="_method" id="methodField" value="POST">
            <input type="hidden" name="category_id" id="categoryId">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description (optional)</label>
                <textarea name="description" id="description" rows="3" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openModal(action, categoryId = null) {
        const modal = document.getElementById('categoryModal');
        const modalTitle = document.getElementById('modalTitle');
        const form = document.getElementById('categoryForm');
        const methodField = document.getElementById('methodField');
        const categoryIdField = document.getElementById('categoryId');

        if (action === 'create') {
            modalTitle.innerText = 'Add New Category';
            form.action = "{{ route('categories.store') }}";
            methodField.value = 'POST';
            categoryIdField.value = '';
            document.getElementById('name').value = '';
            document.getElementById('description').value = '';
        } else if (action === 'edit' && categoryId) {
            modalTitle.innerText = 'Edit Category';
            form.action = `/admin/categories/${categoryId}`;
            methodField.value = 'PUT';
            categoryIdField.value = categoryId;

            fetch(`/admin/categories/${categoryId}/edit-data`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('name').value = data.name;
                    document.getElementById('description').value = data.description;
                })
                .catch(error => console.error('Error:', error));
        }
        modal.style.display = 'block';
    }

    function closeModal() {
        document.getElementById('categoryModal').style.display = 'none';
    }

    function confirmDelete(categoryId) {
        if (confirm('Are you sure you want to delete this category?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/categories/${categoryId}`;
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    }

    window.onclick = function(event) {
        const modal = document.getElementById('categoryModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>
@endpush
@endsection