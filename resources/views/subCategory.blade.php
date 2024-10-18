@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex">
                        <h6>Sub Categories Table</h6>
                        <a href="" id="btn-bar" class="ms-auto" data-bs-toggle="modal"
                            data-bs-target="#modalSubCat">Add</a>
                    </div>
                    <div class="card-body px-0  pb-2">
                        <div class="table-responsive p-1">
                            <table class="table align-items-center mb-0" id="subCategoriesTable">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Title
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Description</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created By</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created At</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- add/edit modal --}}

        <div class="modal fade" id="modalSubCat" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="h4 text-center">Create Sub Category</h2>
                        <button type="button" class="btn-close" style="color: gray;" data-bs-dismiss="modal"
                            aria-label="Close">X</button>
                    </div>
                    <div class="modal-body px-md-5">
                       
                        <form id="subCategoryForm">
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="title">Title</label>
                                <div class="input-group">
                                    <input type="text" class="form-control border-gray-300" placeholder="title"
                                        id="title" autofocus required>
                                </div>
                            </div>

                            {{-- <div class="form-group mb-4">
                                <label for="category">Select Category</label>
                                <div class="input-group">
                                    <select id="category" class="form-control border-gray-300" required>
                                        <option value="" disabled selected>Select a category</option>
                                        @foreach($categories as $category) <!-- Assuming you have categories available -->
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="des">Description</label>
                                    <div class="input-group">
                                        <textarea placeholder="Description" class="form-control border-gray-300" id="des" cols="10" rows="10"
                                            required>
                                          </textarea>
                                    </div>
                                </div>
                                <!-- End of Form -->


                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/subcategory.js') }}"></script>
@endsection
