<div class="form-field">
    <label for="name">Name</label>
    <input type="text" id="name" name="name"
        class="form-control-styled @error('name') is-invalid @enderror"
        value="{{ old('name', $category->name ?? '') }}"
        placeholder="e.g. Nature & Mountains">
    @error('name')<div class="form-error">{{ $message }}</div>@enderror
</div>

<div class="form-field">
    <label for="image">Image</label>
    @if($category && $category->image)
        <img src="{{ asset('storage/' . $category->image) }}" class="current-img-preview" alt="">
    @endif
    <input type="file" id="image" name="image" class="form-control-styled" accept="image/*">
    <div class="hint">Leave blank to keep the current image</div>
</div>

<div class="form-field">
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="3"
        class="form-control-styled">{{ old('description', $category->description ?? '') }}</textarea>
</div>

<div class="form-row">
    <div class="form-field">
        <label for="status">Status</label>
        <select id="status" name="status" class="form-control-styled">
            <option value="published" {{ old('status', $category->status ?? 'published') === 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft" {{ old('status', $category->status ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
    </div>
    <div class="form-field">
        <label for="sort_order">Sort Order</label>
        <input type="number" id="sort_order" name="sort_order" min="0" class="form-control-styled"
            value="{{ old('sort_order', $category->sort_order ?? 0) }}">
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn-primary-dash">
        <i class="fa fa-check"></i> {{ $category ? 'Save Changes' : 'Create Category' }}
    </button>
</div>