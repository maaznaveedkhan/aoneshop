@extends('admin.layouts.appadmin')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Borderless Table -->
        <div class="card">
        <h5 class="card-header">All Orders</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-borderless">
            <thead>
                <tr>
                <th>#</th>
                <th>Order No</th>
                <th>Total Items</th>
                <th>Payment Status</th>
                <th>Payment Method</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $key => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $item->order_number }}</strong></td>
                        <td>{{ $item->item_count }}</td>
                        <td>{{ $item->payment_status }}</td>
                        <td>{{ $item->payment_method }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#view{{ $key }}"
                                        ><i class="bx bx-eye-alt me-1"></i> Order Detail</button>
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit{{ $item->id }}"
                                        ><i class="bx bx-edit-alt me-1"></i> Edit</button>
                                    <a class="dropdown-item" href="{{ route('delete_category',$item->id) }}"
                                        ><i class="bx bx-trash me-1"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <p>No Orders Present!</p>
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
