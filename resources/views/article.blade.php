@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row card"
            style="height: 100% ;box-shadow: 0 4px 7px -1px rgba(0, 0, 0, 0.11), 0 2px 4px -1px rgba(0, 0, 0, 0.07);">
            <form class="p-4" id="articleForm">
                <input type="hidden" name="" value="{{ $article->id }}">
                <div class="row">
                    <!-- Title Field -->
                    <div class="col-6 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Enter article title" value="{{ old('title', $article->title) }}" required>
                    </div>

                    <!-- Categories Dropdown -->
                    <div class="col-6 mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="" disabled selected>Select a category</option>

                            @foreach ($CatList as $category)
                                <option value="{{ $category->id }}" class="cat_id"
                                    {{ $article->cat_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_title }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <!-- Short Description Field -->
                <div class="col-12 mb-3">
                    <label for="short_description" class="form-label">Short Description</label>
                    <textarea class="form-control" id="short_description" name="short_description" rows="1"
                        placeholder="Enter a brief description" required>{{ old('short_description', $article->short_description) }}</textarea>
                </div>

                <!-- Description Field -->
                <div class=" col-12 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <div id="quillEditor" style="height: 500px;"></div>

                </div>
                <input type="hidden" id="description" name="description"
                    value="{{ old('description', $article->description) }}" />
                <!-- Submit Button -->
                {{-- <div class="d-grid"> --}}
                <button type="submit" class="btn btn-sm float-end btn-primary " id="insert">Submit</button>
                <button type="submit" class="btn btn-sm float-end btn-primary " id="articleEdit">Submit</button>
                {{-- </div> --}}
            </form>

        </div>

    </div>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <!-- Your custom Quill JavaScript -->
    <script src="{{ asset('assets/js/quill.js') }}"></script>
    <script src="{{ asset('assets/js/article.js') }}"></script>
@endsection
