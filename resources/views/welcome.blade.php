@extends('frontend.layout')
<link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}">
@section('content')
    <style type="text/css">
        html,
        body {
            margin: 0;
            padding: 0;
        }

        * {
            box-sizing: border-box;
        }

        .slider {
            width: 90%;
            margin: 20px auto !important;
        }

        .slick-slide {
            margin: 0px 20px;
        }

        .slick-slide img {
            width: 100%;
        }

        .slick-prev:before,
        .slick-next:before {
            color: black;
        }


        .slick-slide {
            transition: all ease-in-out .3s;
            opacity: 1;
        }

        .slick-active {
            opacity: 1;
        }

        .slick-current {
            opacity: 1;
        }
    </style>
    <!-- Carousel Start -->
    <div class=" p-5" style="width:95% !important; margin:0rem auto !important; background-color:white">
        <div id="carouselExampleIndicators" class="carousel slide " data-bs-ride="true" style="border-radius: 10px">
            <div class="carousel-indicators">
                @if ($sliders->count() > 0)
                    @foreach ($sliders as $key => $item)
                        <button type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                            aria-current="true" aria-label="{{ $key }}"></button>
                    @endforeach
                @endif
                {{-- <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button> --}}
            </div>
            <div class="carousel-inner">
                @if ($sliders->count() > 0)
                    @foreach ($sliders as $key => $item)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('images/slider_images/' . $item->slider) }}" class="d-block  w-100"
                                alt="..." style="border-radius: 15px; ">
                        </div>
                        {{-- <div class="carousel-item">
        <img src="https://images.pexels.com/photos/1050244/pexels-photo-1050244.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="https://images.pexels.com/photos/1087727/pexels-photo-1087727.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" class="d-block w-100" alt="...">
      </div> --}}
                    @endforeach
                @endif
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        {{-- category --}}
        <div class="row my-3 ">
            <div class="col-9">
                <p class=""
                    style="font-size: 25px;font-weight:700; line-height:30px;color: #2e2f32;font-family: Bogle,Helvetica Neue,Helvetica,Arial,sans-serif;">
                    Your favorite departments</p>
            </div>
            <div class="col-3 text-end">
                <a href="{{ route('view.all.categories') }}" class="text-dark">View All</a>
            </div>
        </div>
        <div class="row text-center d-flex justify-content-center">
            @foreach ($categories as $key => $item)
                <div class="col-6 col-sm-6 col-md-3 col-lg-2 text-center ">
                    <a href="{{ route('view.category.products', ['id'=> $item->id]) }}" class="btn">
                        <div class="categore_image" style="height: 100px;width:100px; ">
                            <img style="height: 100%;width:100%;border-radius:50px; object-fit:cover"
                                src="{{ asset('images/category_images/' . $item->image) }}" alt="" class="">
                        </div>
                        <span class="d-inline-block pt-3" style="font-size:14px;lien-height:21px; color:#46474A">
                            {{ $item->title }}</span>
                    </a>
                </div>
                @php
                    if ($key == 5) {
                        break;
                    }
                @endphp
            @endforeach
        </div>
        {{-- products slider --}}
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
                    @php
                        if ($key == 5) {
                            break;
                        }
                    @endphp
                @endforeach
            @endif
        </div>
        <section class="center slider responsive ">
            @if ($products->count() > 0)
                @foreach ($products as $item)

                <div class="">
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
        </section>
    </div>


    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="{{ asset('slick/slick.js') }}" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).on('ready', function() {
            $(".vertical-center-4").slick({
                dots: true,
                vertical: true,
                centerMode: true,
                slidesToShow: 4,
                slidesToScroll: 2
            });
            $(".vertical-center-3").slick({
                dots: true,
                vertical: true,
                centerMode: true,
                slidesToShow: 3,
                slidesToScroll: 3
            });
            $(".vertical-center-2").slick({
                dots: true,
                vertical: true,
                centerMode: true,
                slidesToShow: 2,
                slidesToScroll: 2
            });
            $(".vertical-center").slick({
                dots: true,
                vertical: true,
                centerMode: true,
            });
            $(".vertical").slick({
                dots: true,
                vertical: true,
                slidesToShow: 3,
                slidesToScroll: 3
            });
            $(".regular").slick({
                dots: true,
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3
            });
            $(".center").slick({
                dots: false,
                infinite: true,
                centerMode: true,
                slidesToShow: 4,
                slidesToScroll: 3
            });
            $(".variable").slick({
                dots: true,
                infinite: true,
                variableWidth: true
            });
            $(".lazy").slick({
                lazyLoad: 'ondemand', // ondemand progressive anticipated
                infinite: true
            });
        });



        $('.responsive').slick({
            dots: false,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    </script>

@endsection
