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
                  <a href="{{ route('new_product') }}" class="btn btn-primary" >
                    Add New Product
                  </a>
                </div>
            </div>
            <div class="row">
                <!-- Borderless Table -->
              <div class="card">
                <h5 class="card-header">All Products</h5>
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
                        @forelse ($products as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $item->name }}</strong></td>
                                <td>{{ $item->short_description }}</td>
                                <td><img src="{{ asset('images/product_images/'.$item->product_thumbnail) }}" alt="Category Image" height="80" width="80"></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('edit_product',$item->id) }}"
                                            ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                        >
                                        <a class="dropdown-item" href="{{ route('delete_product',$item->id) }}"
                                            ><i class="bx bx-trash me-1"></i> Delete</a
                                        >
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
@endsection
