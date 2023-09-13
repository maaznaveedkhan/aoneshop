@extends('frontend.layout')

@section('content')
 {{-- category --}}
 <div class=" p-5" style="width:80% !important; margin:1rem auto !important; background-color:white">
 <div class="container">
    <div class="row my-3 ">
    <div class="col-9">
        <p class=""
            style="font-size: 25px;font-weight:700; line-height:30px;color: #2e2f32;font-family: Bogle,Helvetica Neue,Helvetica,Arial,sans-serif;">
            All favorite departments</p>
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

    @endforeach
</div>
 </div>
</div>
@endsection
