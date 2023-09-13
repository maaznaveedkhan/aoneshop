@extends('admin.layouts.appadmin')
@section('content')
{{-- <style>
    .images-preview-div img {
        padding: 10px;
        max-width: 100px;
    }
    input[type="file"] {
    display: block;
    }
    .imageThumb {
    max-height: 75px;
    border: 2px solid;
    padding: 1px;
    cursor: pointer;
    }
    .pip {
    display: inline-block;
    margin: 10px 10px 0 0;
    }
    .remove {
    display: block;
    background: #444;
    border: 1px solid black;
    color: white;
    text-align: center;
    cursor: pointer;
    }
    .remove:hover {
    background: white;
    color: black;
    }
</style> --}}
<!-- Content wrapper -->
<div class="content-wrapper">
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    @if(session('success'))
        <h6 class="alert alert-success">
            {{ session('success') }}
        </h6>
    @endif
    <!-- Slide from Top Modal -->
    <div class="col-lg-4 col-md-6">
        <div class="mt-3 mb-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_category">
            Add New Category
            </button>
            <!-- Category Modal -->
            <div class="modal modal-top fade" id="add_category" tabindex="-1">
            <div class="modal-dialog">
                <form class="modal-content" action="{{ route('create_category') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTopTitle">New Category</h5>
                    <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col mb-3">
                        <label for="nameSlideTop" class="form-label">Title</label>
                        <input
                        name="title"
                        type="text"
                        id=""
                        class="form-control"
                        placeholder="Enter Title"
                        />
                    </div>
                    </div>
                    <div class="row g-2">
                    <div class="col mb-0">
                        <label for="emailSlideTop" class="form-label">Description</label>
                        <input
                        name="description"
                        type="text"
                        id=""
                        class="form-control"
                        placeholder="Enter Small Description"
                        />
                    </div>
                    <div class="col mb-0">
                        <label for="dobSlideTop" class="form-label">Image</label>
                        {{-- <input type="file" placeholder="Image" name="image" id="imgInp"> --}}

                        <input
                        name="image"
                        type="file"
                        id="imgInp"
                        class="form-control"
                        placeholder=""/>
                        <img style="visibility:hidden"  id="prview" src=""  width=100 height=100 />
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    <div class="row">
        <!-- Borderless Table -->
        <div class="card">
        <h5 class="card-header">All Categories</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-borderless">
            <thead>
                <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $key => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $item->title }}</strong></td>
                        <td>{{ $item->description }}</td>
                        <td><img src="{{ asset('images/category_images/'.$item->image) }}" alt="Category Image" height="80" width="80"></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#view{{ $key }}"
                                        ><i class="bx bx-eye-alt me-1"></i> View</button>
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}"
                                        ><i class="bx bx-edit-alt me-1"></i> Edit</button>
                                    <a class="dropdown-item" href="{{ route('delete_category',$item->id) }}"
                                        ><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                            <div class="modal fade" id="view{{ $key }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">{{ $item->title }}</h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-2">
                                                <div class="col-md-12 mb-3">
                                                    <label for="emailBasic" class="form-label">Description</label>
                                                    <input type="text" id="" class="form-control" disabled value="{{ $item->description }}" placeholder="" />
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="dobBasic" class="form-label">Image</label>
                                                    <img src="{{ asset('images/category_images/'.$item->image) }}" height="100" width="100" alt="">
                                                {{-- <input type="text" id="dobBasic" class="form-control" placeholder="DD / MM / YY" /> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="modal modal-top fade" id="view{{ $key }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form class="modal-content" action="" method="" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTopTitle">{{ $item->title }}</h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-2">
                                                <div class="col-md-12 mb-3">
                                                    <label for="emailSlideTop" class="form-label">Description</label>
                                                    <input
                                                        name="description"
                                                        value="{{ $item->description }}"
                                                        type="text"
                                                        id=""
                                                        class="form-control"
                                                        placeholder="Enter Small Description"/>
                                                    </div>
                                                <div class="col-md-12 mb-3">
                                                <label for="dobSlideTop" class="form-label">Image</label>
                                                <img src="{{ asset('images/category_images/'.$item->image) }}" height="50" width="50" alt="">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div> --}}
                            <div class="modal modal-top fade" id="edit{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form class="modal-content" action="{{ route('update_category',$item->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTopTitle">New Category</h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                <label for="nameSlideTop" class="form-label">Title</label>
                                                <input
                                                    name="title"
                                                    value="{{ $item->title }}"
                                                    type="text"
                                                    id=""
                                                    class="form-control"
                                                    placeholder="Enter Title"/>
                                                </div>
                                            </div>
                                            <div class="row g-2">
                                                <div class="col-md-12 mb-3">
                                                <label for="emailSlideTop" class="form-label">Description</label>
                                                <input
                                                    name="description"
                                                    value="{{ $item->description }}"
                                                    type="text"
                                                    id=""
                                                    class="form-control"
                                                    placeholder="Enter Small Description"/>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    {{-- <img src="{{ asset('images/category_images/'.$item->image) }}" height="50" width="50" alt=""> --}}
                                                    <label for="dobSlideTop" class="form-label">Image</label>
                                                <input
                                                    name="image"
                                                    type="file"
                                                    id="image"
                                                    class="form-control"
                                                    placeholder=""/>
                                                    <img id="preview" src="{{ asset('images/category_images/'.$item->image) }}"
                                                        alt="image" style="max-height: 250px; ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <p>No Categories Found!</p>
                @endforelse
            </tbody>
            </table>
        </div>
        </div>
        <!--/ Borderless Table -->
    </div>
</div>
<!-- / Content -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function (e) {
    $('#image').change(function(){
    let reader = new FileReader();
    reader.onload = (e) => {
        $('#preview').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
    });
});
</script>
{{-- <script>
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
        prview.style.visibility = 'visible';

        prview.src = URL.createObjectURL(file)
        }
    }
</script> --}}
@endsection
