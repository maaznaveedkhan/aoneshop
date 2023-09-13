@extends('frontend.layout')
@section('content')
<?php

use App\Models\Order;
?>

<style>
    	span {cursor:pointer; }
		.minus, .plus {
    width: 20px;
    height: 15px;
    background: #74767C;
    border-radius: 16px;
    padding: 5px 5px 11px 5px;
    border: 1px solid #ddd;
    display: inline-block;
    vertical-align: middle;
    text-align: center;
    color: white;
}
		input{
			height:34px;
      width: 50px;
      text-align: center;
      font-size: 16px;
			border:1px solid #ddd;
			border-radius:20px;
      display: inline-block;
      vertical-align: middle;
        }
</style>

 <!-- Modal Address -->
 <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog">
     <div class="modal-content">
         <div class="modal-header">
             <h1 class="modal-title fs-5" id="exampleModalLabel">Enter Your Address/Zip
                 Code</h1>
             <button type="button" class="btn-close" data-bs-dismiss="modal"
                 aria-label="Close"></button>
         </div>
         <div class="modal-body">
             <form action="{{ route('enter.address') }}" method="GET">
                @csrf
                 <div class="row mb-2">
                     <div class="col-auto">
                         <label for="" class="form-label">Enter Address Or Zip
                             Code</label>
                         <input type="text" name="address" id=""
                             class="form-control">
                     </div>
                 </div>
                 <button type="submit" class="btn btn-primary">Save Address</button>
             </form>
         </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-secondary"
                 data-bs-dismiss="modal">Close</button>

         </div>
     </div>
 </div>
</div>

    <div class="  p-5" style="background-color: white">
        <div class="row d-flex justify-content-around">
            <div class="col-12 col-sm-12 col-md-7 col-lg-8 px-2">

                @php $total = 0 @endphp
                @php
                    $delivery_charges = 0;
                @endphp
                @if (session('cart') && count(session('cart')) != 0)
                    <div class="d-flex">
                        <h1 style="color: #2e2f32;font-weight: 700; font-size:24px;">Cart </h1>
                        <p id="total_items" class="" style="font-size: 20px;color: #46474a;margin-left:4px;">
                            ({{ count(session('cart')) }} Items)</p>
                    </div>

                    <form action="{{ route('checkout') }}" method="GET" id="checkout">



                        <div class="wrapper_container_cart border shadow-sm rounded ">
                            <div class=" d-flex justify-content-between     flex-wrap header_card_addres py-4 px-3"
                                style="background-color: #F2F8FD ; ">
                                <p
                                    style="background-color: #F2F8FD ; font-size: 24px;font-weight:700; line-height:25px;font-family: Bogle,Helvetica Neue,Helvetica,Arial,sans-serif;">
                                  @if (Auth::user())

                                  @php
                                      $address = Order::where('user_id',Auth::user()->id)->first();
                                  @endphp
                                    @if (session('address'))
                                    {{ session()->get('address') }}!
                                    @else
                                    @if (!empty($address->address))
                                            {{ $address->address }}!


                                     @else
                                     Please Enter Your Address Or Zip Code!
                                     @endif

                                    @endif

                                    @elseif (session('address'))
                                    {{ session()->get('address') }}!

                                    @else
                                    Please Enter Your Address Or Zip Code!
                                  @endif  </p>

                                <a href="" class="text-decoration-underline text-dark" data-bs-toggle="modal"
                                    data-bs-target="#addressModal">Enter Your Zip Code</a>

                            </div>


                            @foreach (session('cart') as $id => $details)
                                <input type="hidden" name="ids[]" value="{{ $id }}">
                                <input type="hidden" name="quantities[]" value="{{ $details['quantity'] }}">
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                @php
                                    $delivery_charges += $details['delivery_charges'];
                                @endphp

                                <div class="row  p-2">

                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-5 col-sm-5 col-md-4">
                                                <div class="product_image_div" style="height: 90px;width:90px;">
                                                    <img src="{{ $details['image'] }}" class="" style="width: 100%;height:100%; object-fit:contain;">
                                                </div>
                                            </div>
                                            <div class="col-7 col-sm-7 col-md-8">
                                                <div style="font-size: 16px;margin-top:4px:color:#2e2f32;line-height:1.25; font-weight:400;">{{ $details['name'] }}</div>
                                                ${{ $details['price'] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">

                                            <div class="col-12 text-end">
                                                <span style="color: black; text-decoration:none; display:inline-block; font-size:18px;font-weight:700;line-height:1.5; "> ${{ $details['price'] * $details['quantity'] }}</span>
                                            </div>

                                        <div class="row">
                                            <div class="col-4">
                                                <a id="{{ $id }}" class=" text-dark remove-from-cart">remove</a>
                                            </div>
                                            <div class="col-8" data-th="Quantity">
                                                <div class="number">
                                                    <span class="minus">-</span>
                                                    <input type="text" id="{{ $id }}" class="quantity update-cart" value="{{ $details['quantity'] }}"/>
                                                    <span class="plus">+</span>
                                                </div>
                                                {{-- <input type="number" id="{{ $id }}"
                                                    value="{{ $details['quantity'] }}"
                                                    class="form-control quantity update-cart" /> --}}
                                                {{-- <div class="cart-info quantity">
                                            <div class="btn-increment-decrement" onClick="decrement_quantity()">-</div><input class="input-quantity"
                                                id="input-quantity-" value=""><div class="btn-increment-decrement"
                                                onClick="increment_quantity()">+</div>
                                        </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="">
                                <input type="hidden" name="total" value="{{ $total + $delivery_charges }}">
                            @endforeach
                        </div>
                    </form>
                @endif

            </div>
            @if (session('cart') && count(session('cart')) != 0)
                <div class="col-12 col-sm-12 col-md-4 mt-5 col-lg-3  py-3 text-center border rounded">
                    <a href="#" class="btn btn-sm btn-primary btn-block text-center rounded"
                        onclick="event.preventDefault();
                                        document.getElementById('checkout').submit();"
                        style="border-radius: 20px !important"> Continue to checkout</a>
                    <hr>
                    <div class="row">
                        <div class="col-7">
                            <span><b>Subtotal </b>({{ count(session('cart')) }}Item)</span>
                        </div>
                        <div class="col-4 text-end">
                            ${{ $total }}
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-4">
                            <span><b>Taxes </b></span>
                        </div>
                        <div class="col-7 text-end">
                            Calculated at checkout

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-7">
                            <span><b>Delivery Charges
                                </b></span>
                        </div>
                        <div class="col-4 text-end">
                            <b>${{ $delivery_charges }}</b>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-7">
                            <span><b>Estimated total
                                </b></span>
                        </div>
                        <div class="col-4 text-end">
                            <b>${{ $total + $delivery_charges }}</b>
                        </div>
                    </div>

                </div>
            @else
                <div class="text-center">
                    <h1>Time to start shopping!
                        <br>
                    </h1>
                    <p>Your cart is empty</p>
                    <h1>Fill it up with savings from popular products</h1>
                    <a class="btn btn-outline-dark rounded " href="{{ url('/') }}">Shop home</a>
                </div>
            @endif
        </div>

    </div>

    <style>
        .product_image_div {
            height: 100px;
            /* width: 200px; */
            padding-right: 1rem;
        }

        .product_image_div img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }


        /* .btn-increment-decrement {
        display: inline-block;
        padding: 5px 0px;
        background: #e2e2e2;
        width: 30px;
        text-align: center;
        cursor:pointer;
    }

    .input-quantity {
     border: 0px;
        width: 30px;
        display: inline-block;
        margin: 0;
        box-sizing: border-box;
        text-align: center;
    } */
    </style>


@endsection
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {


			$('.minus').click(function () {
				var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.plus').click(function () {
				var $input = $(this).parent().find('input');
				$input.val(parseInt($input.val()) + 1);
				$input.change();
				return false;
			});



        $(".update-cart").change(function(e) {
            e.preventDefault();

            //   var ele = $(this);
            // alert(this.value);
            $.ajax({
                url: '{{ route('update.cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: this.id,
                    quantity: this.value,
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        $(".remove-from-cart").click(function(e) {
            e.preventDefault();

            // var ele = $(this);
            // alert(this.id)
            if (confirm("Are you sure want to remove?")) {
                $.ajax({
                    url: '{{ route('remove.from.cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: this.id,
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
    });
</script>
