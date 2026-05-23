@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')
<div class="container">
    <h1>Site Settings</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" class="settings-form">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="site_type">Site Type</label>
            <select name="site_type" id="site_type" class="form-control" required>
                <option value="clothing" {{ $siteType === 'clothing' ? 'selected' : '' }}>Clothing</option>
                <option value="electronics" {{ $siteType === 'electronics' ? 'selected' : '' }}>Electronics</option>
            </select>
            <p class="form-text">Choose the site type to change the storefront theme and product attributes.</p>
        </div>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>
@endsection
