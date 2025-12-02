{{-- resources/views/posts/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Create Post - LocateIT')

@section('content')
<style>
    .main-container {
        max-width: 900px;
        margin: 2rem auto;
        padding: 0 2rem;
    }

    .form-card {
        background: white;
        border-radius: 12px;
        padding: 2.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .form-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-header h1 {
        font-size: 2rem;
        color: #9E1B1E;
        margin-bottom: 0.5rem;
    }

    .form-header p {
        color: #666;
        font-size: 1.05rem;
    }

    .toggle-section {
        display: flex;
        justify-content: center;
        margin-bottom: 2rem;
    }

    .toggle-container {
        display: flex;
        background: #F7F7F7;
        border-radius: 12px;
        padding: 0.5rem;
        border: 2px solid #E5E5E5;
    }

    .toggle-btn {
        padding: 0.75rem 2.5rem;
        border: none;
        background: transparent;
        border-radius: 8px;
        cursor: pointer;
        font-size: 1.1rem;
        font-weight: 600;
        color: #666;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .toggle-btn.active {
        background: white;
        color: #9E1B1E;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.6rem;
        font-weight: 600;
        color: #333;
        font-size: 1rem;
    }

    .required {
        color: #9E1B1E;
    }

    input[type="text"],
    input[type="date"],
    select,
    textarea {
        width: 100%;
        padding: 0.85rem;
        border: 2px solid #E5E5E5;
        border-radius: 8px;
        font-size: 1rem;
        font-family: inherit;
        transition: border-color 0.3s;
    }

    input:focus,
    select:focus,
    textarea:focus {
        outline: none;
        border-color: #9E1B1E;
    }

    textarea {
        resize: vertical;
        min-height: 120px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .error-message {
        color: #9E1B1E;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid #F7F7F7;
    }

    .btn-submit {
        flex: 1;
        padding: 1rem;
        background: #9E1B1E;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-submit:hover {
        background: #7d1519;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(158, 27, 30, 0.3);
    }

    .btn-cancel {
        flex: 1;
        padding: 1rem;
        background: white;
        color: #666;
        border: 2px solid #E5E5E5;
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-cancel:hover {
        border-color: #9E1B1E;
        color: #9E1B1E;
    }

    @media (max-width: 768px) {
        .main-container {
            padding: 0 1rem;
        }

        .form-card {
            padding: 1.5rem;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .toggle-btn {
            padding: 0.6rem 1.5rem;
            font-size: 1rem;
        }

        .form-actions {
            flex-direction: column;
        }
    }
</style>

<div class="main-container">
    <div class="form-card">
        <div class="form-header">
            <h1>Create a Post</h1>
            <p>Help the community by reporting a lost or found item</p>
        </div>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Toggle Lost/Found -->
            <div class="toggle-section">
                <div class="toggle-container">
                    <label class="toggle-btn active">
                        <input type="radio" name="type" value="lost" checked style="display: none;">
                        <i class="fas fa-magnifying-glass"></i> Lost Item
                    </label>
                    <label class="toggle-btn">
                        <input type="radio" name="type" value="found" style="display: none;">
                        <i class="fas fa-hand-holding"></i> Found Item
                    </label>
                </div>
            </div>

            <!-- Item Name -->
            <div class="form-group">
                <label>Item Name <span class="required">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" 
                       placeholder="e.g., Student ID, Samsung Phone, Red Backpack" required>
                @error('title')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Date and Campus -->
            <div class="form-row">
                <div class="form-group">
                    <label>Date Lost/Found <span class="required">*</span></label>
                    <input type="date" name="date_lost_found" value="{{ old('date_lost_found') }}" 
                           max="{{ date('Y-m-d') }}" required>
                    @error('date_lost_found')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Campus <span class="required">*</span></label>
                    <select name="campus" required>
                        <option value="">Select Campus</option>
                        <option value="Alangilan Campus" {{ old('campus') == 'Alangilan Campus' ? 'selected' : '' }}>Alangilan Campus</option>
                        <option value="Pablo Borbon Campus" {{ old('campus') == 'Pablo Borbon Campus' ? 'selected' : '' }}>Pablo Borbon Campus</option>
                        <option value="Lipa Campus" {{ old('campus') == 'Lipa Campus' ? 'selected' : '' }}>Lipa Campus</option>
                        <option value="Nasugbu Campus" {{ old('campus') == 'Nasugbu Campus' ? 'selected' : '' }}>Nasugbu Campus</option>
                        <option value="Malvar Campus" {{ old('campus') == 'Malvar Campus' ? 'selected' : '' }}>Malvar Campus</option>
                        <option value="Lemery Campus" {{ old('campus') == 'Lemery Campus' ? 'selected' : '' }}>Lemery Campus</option>
                        <option value="Balayan Campus" {{ old('campus') == 'Balayan Campus' ? 'selected' : '' }}>Balayan Campus</option>
                        <option value="San Juan Campus" {{ old('campus') == 'San Juan Campus' ? 'selected' : '' }}>San Juan Campus</option>
                    </select>
                    @error('campus')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Location and Category -->
            <div class="form-row">
                <div class="form-group">
                    <label>Specific Location (Optional)</label>
                    <input type="text" name="location_area" value="{{ old('location_area') }}" 
                           placeholder="e.g., Main Library, Canteen">
                    @error('location_area')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Category <span class="required">*</span></label>
                    <select name="category" required>
                        <option value="">Select Category</option>
                        <option value="ID / Documents" {{ old('category') == 'ID / Documents' ? 'selected' : '' }}>ID / Documents</option>
                        <option value="Gadgets" {{ old('category') == 'Gadgets' ? 'selected' : '' }}>Gadgets</option>
                        <option value="Clothing" {{ old('category') == 'Clothing' ? 'selected' : '' }}>Clothing</option>
                        <option value="Bags" {{ old('category') == 'Bags' ? 'selected' : '' }}>Bags</option>
                        <option value="Accessories" {{ old('category') == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                        <option value="Books" {{ old('category') == 'Books' ? 'selected' : '' }}>Books</option>
                        <option value="Others" {{ old('category') == 'Others' ? 'selected' : '' }}>Others</option>
                    </select>
                    @error('category')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label>Description <span class="required">*</span></label>
                <textarea name="description" required 
                          placeholder="Provide detailed information about the item (color, brand, condition, where exactly it was lost/found, etc.)">{{ old('description') }}</textarea>
                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image Upload -->
            <div class="form-group">
                <label>Upload Image (Optional)</label>
                <input type="file" name="image" accept="image/*" style="padding: 0.5rem;">
                @error('image')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Contact Information Display -->
            <div class="form-group">
                <label>Contact Information</label>
                <div style="background: #F7F7F7; padding: 1.25rem; border-radius: 8px; border: 2px solid #E5E5E5;">
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem; color: #666;">
                        <i class="fas fa-user" style="color: #9E1B1E;"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem; color: #666;">
                        <i class="fas fa-envelope" style="color: #9E1B1E;"></i>
                        <span>{{ Auth::user()->email }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem; color: #666;">
                        <i class="fas fa-phone" style="color: #9E1B1E;"></i>
                        <span>{{ Auth::user()->contact_number }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.75rem; color: #666;">
                        <i class="fas fa-building" style="color: #9E1B1E;"></i>
                        <span>{{ Auth::user()->campus }}</span>
                    </div>
                </div>
                <p style="font-size: 0.85rem; color: #999; margin-top: 0.5rem;">
                    <i class="fas fa-info-circle"></i> This information is auto-filled from your profile
                </p>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('home') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Post Item
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Toggle button functionality
    document.querySelectorAll('.toggle-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
@endpush
@endsection