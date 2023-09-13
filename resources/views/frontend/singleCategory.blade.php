@extends('frontend.layout')

@section('content')
    {{-- category --}}
    <div class=" p-5" style="width:80% !important; margin:1rem auto !important; background-color:white">
        <div class="container">
            @if (count($products) == 0)
                <h1 class="text-center">Products will be available soon!</h1>
            @else
            <div class="row my-5 ">
                <div class="col-9">
                    <p class=""
                        style="font-size: 25px;font-weight:700; line-height:30px;color: #2e2f32;font-family: Bogle,Helvetica Neue,Helvetica,Arial,sans-serif;">
                        Trending </p>
                </div>
                <div class="col-3 text-end">
                    {{-- <a href="" class="text-dark">View All</a> --}}
                </div>
            </div>
            <div class="row  text-center d-flex justify-content-center">
                @if ($products->count() > 0)
                    @foreach ($products as $key => $item)

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
                @endif
            </div>

            @endif
        </div>
    </div>
@endsection
