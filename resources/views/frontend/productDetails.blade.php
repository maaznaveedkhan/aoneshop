@extends('frontend.layout')

@section('content')
    <!-- Basic Styles For Gallery -->
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('product_slider/css/reset.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('product_slider/css/jquery-picZoomer.css') }}">
    <style type="text/css">

    .piclist{
        margin-top: 30px;
    }
    .piclist li{
        display: inline-block;
        width: 50px;
        height: 50px;
    }
    .piclist li img{
        width: 100%;
        height: auto;
    }

    /* custom style */
    .picZoomer-pic-wp,
    .picZoomer-zoom-wp{
        border: 1px solid #fff;
    }

    @media screen and (max-width:500px){
        .picZoomer-pic-wp{
            width: 290px !important;
        }
    }
    @media screen and (min-width:691px) and (max-width:876px){
        .picZoomer-pic-wp{
            width: 320px !important;
        }
    }



    </style>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="{{ asset('product_slider/src/jquery.picZoomer.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('.picZoomer').picZoomer();


            //切换图片
            $('.piclist li').on('click',function(event){
                var $pic = $(this).find('img');
                $('.picZoomer-pic').attr('src',$pic.attr('src'));
            });
        });
    </script>

<div class="jquery-script-ads"><script type="text/javascript"><!--
    google_ad_client = "ca-pub-2783044520727903";
    /* jQuery_demo */
    google_ad_slot = "2780937993";
    google_ad_width = 728;
    google_ad_height = 90;
    //-->
    </script>
    <script type="text/javascript"
    src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
    </script></div>
    <div class="jquery-script-clear"></div>
    </div>
    </div>


    <div class=" my-5 py-5 px-2" style="background-color: white; border-radius:20px; margin:0rem auto !important;">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-7 text-center">
                <div class="picZoomer" style="text-align: -webkit-center;">
                    <img src="{{ asset('images/product_images/' . $product->product_thumbnail) }}" height="320" width="320" alt="">
                </div>
                <ul class="piclist">
                    @foreach (json_decode($product->product_images) as $item)

                        <li><img src="{{ asset('images/product_images/' . $item) }}" alt=""></li>
                @endforeach

                </ul>

            </div>
            <div class="col-12 col-sm-12 col-md-3 py-3  text-wrap  border rounded">
                <h1 class="p-3"   style="font-size: 20px;margin-top:4px:color:##2e2f32;line-height:1.25; font-weight:700;">{{ $product->name }}</h1>
                <div class="pl-5" style="padding-left: 1rem">
                    <span class=""> <b class=""style="font-size: 26px;margin-top:4px:color:##2e2f32;line-height:1.25; font-weight:700;" >${{ $product->discounted_price }}</b></span>
                    <span class=""><sub class="pb-4 ">${{ $product->price }}</sub></span>
                    <br>
                    <a href="{{ route('add.to.cart',['id'=>$product->id]) }}" class="btn btn-primary mt-2" style="border-radius: 20px">Add To Cart</a>
                </div>
                <div class="row   mt-2">
                    <hr>
                    <div class="col-4   "style="padding-left: 1rem" >
                        <p class=""><b class="">Brand</b></p>
                    </div>
                    <div class="col-6 text-wrap">
                        {{ $category->title }}
                    </div>

                </div>
                <div class="row   mt-2">
                    <hr>
                    <div class="col-6" style="padding-left: 1rem">
                        <p><b><i class="fa fa-truck" aria-hidden="true"></i> Delivery Charges</b></p>
                    </div>
                    <div class="col-5">
                        ${{ $product->delivery_charges }}
                    </div>

                </div>
                <div class="row   mt-2">
                    <hr>
                    <div class="col-4"style="padding-left: 1rem" >
                        <p><b><i class="fa fa-genderless" aria-hidden="true"></i> Gender</b></p>
                    </div>
                    <div class="col-6 text-uppcase">
                        {{ $product->gender }}
                    </div>

                </div>
            </div>
        </div>
        <div class="w-75 my-2" style="margin: 1rem auto">
            <div class="col-12 col-sm-12 col-md-7">
               <h5>About This Item</h5>
                <p class="text-wrap ">
                    {!! $product->long_description !!}
                </p>
            </div>
        </div>
        <div class="w-75 my-2"  style="margin: 1rem auto">
            <div class="col-12 col-sm-12 col-md-7">
               <h5>Size </h5>
                <p class="text-wrap ">
                    {!! $product->short_description !!}
                </p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);

        (function() {
          var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

      </script>

@endsection
