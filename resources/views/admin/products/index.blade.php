@extends('layouts.admin')

@section('title', 'Manage Products')

@section('content')
    <div class="container">
        <h1>Manage Products</h1>
        <button class="btn btn-primary" onclick="openModal('create')">Add New Product</button>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>      <!-- أضفنا عمود التصنيف -->
                    <th>Stock</th>
                    <th>Featured</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>   <!-- عمود التصنيف -->
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->is_featured ? 'Yes' : 'No' }}</td>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" width="50">
                        @else
                            <img src="https://via.placeholder.com/50" alt="placeholder">
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-edit" onclick="openModal('edit', {{ $product->id }})">Edit</button>
                        <button class="btn btn-sm btn-delete" onclick="confirmDelete({{ $product->id }})">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">No products found.</td>   <!-- زاد العدد إلى 8 -->
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>

    <!-- Modal for Create/Edit -->
    <div id="productModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Add Product</h2>
            <form id="productForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">
                <input type="hidden" name="product_id" id="productId">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required maxlength="255" class="form-control">
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">No Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" step="0.01" min="0" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" min="0" value="0" class="form-control">
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" accept="image/*" class="form-control-file">
                    <div id="imagePreview" style="margin-top: 10px;"></div>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="is_featured" id="is_featured" value="1"> Featured
                    </label>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeDeleteModal()">&times;</span>
            <h2>Confirm Delete</h2>
            <p>Are you sure you want to delete this product?</p>
            <form id="deleteForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Cancel</button>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function openModal(action, productId = null) {
            const modal = document.getElementById('productModal');
            const modalTitle = document.getElementById('modalTitle');
            const form = document.getElementById('productForm');
            const methodField = document.getElementById('methodField');
            const productIdField = document.getElementById('productId');

            if (action === 'create') {
                modalTitle.innerText = 'Add New Product';
                form.action = "{{ route('products.store') }}";
                methodField.value = 'POST';
                productIdField.value = '';
                // تفريغ جميع الحقول
                document.getElementById('name').value = '';
                document.getElementById('description').value = '';
                document.getElementById('price').value = '';
                document.getElementById('stock').value = 0;
                document.getElementById('category_id').value = '';   // إضافة تفريغ التصنيف
                document.getElementById('is_featured').checked = false;
                document.getElementById('imagePreview').innerHTML = '';
            } else if (action === 'edit' && productId) {
                modalTitle.innerText = 'Edit Product';
                form.action = `/admin/products/${productId}`;
                methodField.value = 'PUT';
                productIdField.value = productId;

                fetch(`/admin/products/${productId}/edit-data`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        document.getElementById('name').value = data.name;
                        document.getElementById('description').value = data.description;
                        document.getElementById('price').value = data.price;
                        document.getElementById('stock').value = data.stock;
                        document.getElementById('category_id').value = data.category_id;  // تعيين التصنيف (بدون سطر فارغ)
                        document.getElementById('is_featured').checked = data.is_featured == 1;
                        if (data.image) {
                            document.getElementById('imagePreview').innerHTML = `<img src="/storage/${data.image}" width="100">`;
                        } else {
                            document.getElementById('imagePreview').innerHTML = '';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
            modal.style.display = 'block';
        }

        function closeModal() {
            document.getElementById('productModal').style.display = 'none';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        function confirmDelete(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/products/${productId}`;
                
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
            const modal = document.getElementById('productModal');
            const deleteModal = document.getElementById('deleteModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
            if (event.target == deleteModal) {
                deleteModal.style.display = 'none';
            }
        }
    </script>
    @endpush
@endsection