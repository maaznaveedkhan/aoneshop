@extends('frontend.layout')
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
@section('content')
    <div class=" border rounded px-5 p-5" style="background-color: white">
       @if($result == 'Available Comming Soon'){
        <div class="row text-center">
            <div class="col-12 text-success">
                <h1 class="text-center text-success">{{ $result }}</h1>
            </div>
        </div>
       }
       @else
       <div class="row">


       @foreach ($result as $item)
       <div class="col-6 col-sm-6 col-md-4  col-lg-3 col-xl-2  mt-2">
        <a href="{{ route('view.product.details',['id'=>$item->id]) }}">
        <img src="{{ asset('images/product_images/' . $item->product_thumbnail) }}"
            style="height: 170px;width: 10rem;object-fit: fill;" alt="" class="img-fluid">
        </a>
        <div class="button text-start" style="margin-top: -1rem">
            <a href="{{ route('add.to.cart', ['id' => $item->id]) }}" class=""
                style="background-color: #0071DC; color:white; text-decoration:none; display:inline-block; font-size:16px;font-weight:700;line-height:18.4px; padding:10px 15px; border-radius:20px;font-family:Bogle,Helvetica Neue,Helvetica,Arial,sans-serif;"><i
                    class="fa fa-plus text-light"> </i> Add</a>
        </div>
        <div class="mt-4 text-start">
            @if (!is_null($item->discounted_price))
                <div>
                    <span
                        style="color: #2A8754 ; text-decoration:none; display:inline-block; font-size:18px;font-weight:700;line-height:1.5; ">Now
                        ${{ $item->discounted_price }} </span>
                    <span
                        style="text-decoration: line-through; font-size:14px; margin-rigth:4px; color:#74767c;">${{ $item->price }}</span>
                </div>
            @else
                <div class="text-start">
                    <span
                        style="color: black; text-decoration:none; display:inline-block; font-size:18px;font-weight:700;line-height:1.5; ">${{ $item->discounted_price }}
                    </span>
                    {{-- <span style="text?-decoration: line-through; font-size:14px; margin-rigth:4px; color:#74767c;">${{ $item->price }}</span> --}}
                </div>
            @endif
        </div>

        <div class="text-wrap text-start"
            style="font-size: 16px;margin-top:4px:color:##2e2f32;line-height:1.25; font-weight:400;">

            {{ $item->name }}

        </div>
        <div class="text-start">
            <span
                style="background: #e6f1fc;color: #004f9a;padding-left: 4px;padding-right: 4px;align-items: center;
border-radius: 0.125rem;
font-family: Bogle,Helvetica Neue,Helvetica,Arial,sans-serif;
font-size: .75rem;
font-weight: 400;
line-height: 1.5rem;
padding: 0 0.5rem;
white-space: nowrap;">{{ $item->delivery_time }}</span>
        </div>
    </div>
       @endforeach
    </div>
       @endif
    </div>
@endsection


