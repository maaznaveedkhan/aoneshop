@extends('admin.layouts.appadmin')
@section('content')
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
                    Add New Slider Image
                  </button>
                  <!-- Category Modal -->
                  <div class="modal modal-top fade" id="add_category" tabindex="-1">
                    <div class="modal-dialog">
                      <form class="modal-content" action="{{ route('add_slider') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTopTitle">New Slider</h5>
                          <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                          ></button>
                        </div>
                        <div class="modal-body">
                          {{-- <div class="row">
                            <div class="col mb-3">
                              <label for="nameSlideTop" class="form-label">Title</label>
                              <input
                                name="title"
                                type="text"
                                id="nameSlideTop"
                                class="form-control"
                                placeholder="Enter Title"
                              />
                            </div>
                          </div> --}}
                          <div class="row g-2">
                            {{-- <div class="col mb-0">
                              <label for="emailSlideTop" class="form-label">Description</label>
                              <input
                                name="description"
                                type="text"
                                id="emailSlideTop"
                                class="form-control"
                                placeholder="Enter Small Description"
                              />
                            </div> --}}
                            <div class="col mb-0">
                              <label for="dobSlideTop" class="form-label">Slider</label>
                              <input
                                name="slider"
                                type="file"
                                id="dobSlideTop"
                                class="form-control"
                                placeholder=""
                              />
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
                        <th>Slider</th>
                        {{-- <th>Description</th>
                        <th>Image</th> --}}
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($sliders as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{-- <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $item->title }}</strong></td> --}}
                                {{-- <td>{{ $item->description }}</td> --}}
                                <td><img src="{{ asset('images/slider_images/'.$item->slider) }}" alt="Category Image" height="80" width="80"></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"
                                            ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                        >
                                        <a class="dropdown-item" href=""
                                            ><i class="bx bx-trash me-1"></i> Delete</a
                                        >
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <p>No Record Found!</p>
                        @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Borderless Table -->
            </div>
        </div>
        <!-- / Content -->
@endsection
