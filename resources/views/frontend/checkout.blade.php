@extends('frontend.layout')
<?php
use App\Models\Order;

?>
  @auth
  @php
      $order = Order::where('user_id', Auth::user()->id)->latest()->first();
  @endphp
@endauth
@section('content')
    <div class="container border rounded m-5" style="background-color: white">
        <div class="py-5 ">
            <h1 class="text-center text-danger">Fill This Form Correctly!</h1>
            <div class="row pl-5">
                <div class="col-7 ">
                    @php
                    $delivery_charges = 0
                @endphp
                    <form action="{{route('order.place')}}" method="GET">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Name</label>
                            <input type="text" required name="name" value="{{ Auth::user()->name }}"
                                class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input type="text" required readonly name="email" value="{{ Auth::user()->email }}"
                                class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Phone Number</label>
                            <input type="text" required name="phone_number" value="{{ $order->phone_number ?? '' }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">City </label>
                            <input type="text" required name="city" value="{{ $order->city ?? '' }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Address</label>
                            <input type="text" required name="address" @if (session('address'))
                                value="{{ session()->get('address') }}"
                                @else
                            value="{{ $order->address ?? '' }}"

                            @endif class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Post Code</label>
                            <input type="text" required name="post_code" value="{{ $order->post_code ?? '' }}" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Notes</label>
                            <textarea name="notes" class="form-control"> {{ $order->notes?? '' }}</textarea>
                        </div>

                        <div class="d-grid gap-2">

                            <button type="submit" class="btn btn-outline-primary" id="place_order" style="border-radius:15px;"
                                type="button">Place Order</button>
                        </div>
                    </form>
                </div>
                @php $total = 0 @endphp

                @if (session('cart') && count(session('cart')) != 0 )

                @foreach (session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                @php
                $delivery_charges  += $details['delivery_charges']
            @endphp
                @endforeach
                <div class="col-12 col-sm-12 col-md-3 offset-1 py-3 mr-1 text-center border rounded">
                    <a href="{{route('cart')}}" class="btn btn-sm btn-primary btn-block text-center rounded"
                    style="border-radius: 20px !important"> Continue to cart</a>
                    <hr>
                    <div class="row">
                        <div class="col-7">
                            <span><b>Subtotal </b>({{count(session('cart'))}}Item)</span>
                        </div>
                        <div class="col-4 text-end">
                            ${{$total}}
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
                       <b>${{$delivery_charges}}</b>
                    </div>
                </div>
                <hr>
                    <div class="row">
                        <div class="col-7">
                            <span><b>Estimated total
                            </b></span>
                        </div>
                        <div class="col-4 text-end">
                           <b>${{$total + $delivery_charges}}</b>
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
                        <a class="btn btn-outline-dark rounded " href="{{url('/')}}">Shop home</a>
                    </div>

                @endif
            </div>

        </div>
    </div>
@endsection
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>-->

<!--<script>-->
<!--$(document).ready(function(){-->
<!--$("#place_order").click(function(event){-->
<!--  event.preventDefault();-->
<!--  var settings = {-->
<!--  "url": "https://apitest.cybersource.com/pts/v2/payments/",-->
<!--  "method": "POST",-->
<!--  "timeout": 0,-->
<!--  "headers": {-->
<!--    "v-c-merchant-id": "testrest",-->
<!--    "Date": "",-->
<!--    "Host": "apitest.cybersource.com",-->
<!--    "Digest": "",-->
<!--    "Signature": "",-->
<!--    "Content-Type": "application/json",-->
<!--    "crossDomain": true,-->
<!--    "Access-Control-Allow-Origin":"*",-->
   
<!--  },-->
<!--  "data": JSON.stringify({-->
<!--    "clientReferenceInformation": {-->
<!--      "code": "TC50171_3"-->
<!--    },-->
<!--    "processingInformation": {-->
<!--      "commerceIndicator": "internet"-->
<!--    },-->
<!--    "orderInformation": {-->
<!--      "billTo": {-->
<!--        "firstName": "John",-->
<!--        "lastName": "Doe",-->
<!--        "address1": "1 Market St",-->
<!--        "postalCode": "94105",-->
<!--        "locality": "san francisco",-->
<!--        "administrativeArea": "CA",-->
<!--        "country": "US",-->
<!--        "email": "test@cybs.com"-->
<!--      },-->
<!--      "amountDetails": {-->
<!--        "totalAmount": "2325.00",-->
<!--        "currency": "USD",-->
<!--        "serviceFeeAmount": "30.0"-->
<!--      }-->
<!--    },-->
<!--    "paymentInformation": {-->
<!--      "card": {-->
<!--        "number": "4111111111111111",-->
<!--        "expirationMonth": "12",-->
<!--        "expirationYear": "2031"-->
<!--      }-->
<!--    },-->
<!--    "merchantInformation": {-->
<!--      "serviceFeeDescriptor": {-->
<!--        "name": "CyberSource Service Fee",-->
<!--        "contact": "800-999-9999",-->
<!--        "state": "CA"-->
<!--      }-->
<!--    }-->
<!--  }),-->
<!--};-->

<!--$.ajax(settings).done(function (response) {-->
<!--  console.log(response);-->
<!--  alert(response);-->
<!--});-->
<!--});-->
<!--});-->
    
<!--</script>-->
