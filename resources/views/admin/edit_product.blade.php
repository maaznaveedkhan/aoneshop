@extends('admin.layouts.appadmin')
@section('content')
<style>
    .images-preview-div img {
        padding: 10px;
        max-width: 100px;
    }
    input[type="file"] {
    display: block;
    }
    .imageThumb {
    max-height: 75px;
    border: 2px solid;
    padding: 1px;
    cursor: pointer;
    }
    .pip {
    display: inline-block;
    margin: 10px 10px 0 0;
    }
    .remove {
    display: block;
    background: #444;
    border: 1px solid black;
    color: white;
    text-align: center;
    cursor: pointer;
    }
    .remove:hover {
    background: white;
    color: black;
    }
</style>
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Update Product</h6>
                    <form method="POST" action="{{ route('update_product', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3">
                                <label for="title" class="form-label">Name</label>
                                <input type="text" required name="name" value="{{ $product->name }}" required
                                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="shortdescription" class="form-label">Short Description</label>
                                <input type="text" name="short_description" value="{{ $product->short_description }}"
                                    class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="longdescription" class="form-label">Long Description</label>
                                <textarea name="long_description" value="{!! $product->long_description !!}" class="ckeditor form-control" required id="" cols="30" rows="10"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="longdescription" class="form-label">Data Sheet</label>
                                <textarea name="datasheet" value="{{ $product->datasheet }}" class="ckeditor form-control" required id="" cols="30" rows="10"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="longdescription" class="form-label">Select Category</label>
                                <select class="form-select form-select-sm mb-3" name="category_id" required id="category_id" aria-label="" >
                                    <option value="option_select" disabled >Select</option>
                                    @foreach($categories as $item)
                                    <option value="{{ $item->id }}"
                                        @if($item->id==$product->category_id) selected
                                        @endif   >{{$item->title  }}</option>

                                        {{-- <option value="{{ $item->id }}" @if($item->id == $product->category_id) selected @endif>{{ $item->title}}</option> --}}
                                        {{-- <option value="{{ $item->id }}" {{$item->id == $product->category_id   ? 'selected' : ''}}>{{ $item->title}}</option> --}}
                                    @endforeach
                                </select>
                                {{-- <select name="category_id" class="form-select form-select-sm mb-3"
                                    aria-label=".form-select-sm example" >
                                    <option >Select Category </option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" {{$product->category_id == $item->id  ? 'selected' : ''}}>{{ $item->title }}</option>
                                    @endforeach
                                </select> --}}
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Thumbnail</label>
                                <input type="file" id="image" name="product_thumbnail" class="form-control" id="exampleInputPassword1">
                                <img id="preview" src="{{ asset('images/category_images/'.$item->image) }}"
                                                        alt="image" style="max-height: 250px; ">
                            </div>
                            {{-- <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img class="img-fluid"
                                            src="{{ asset('images/product_images/' . $product['product_thumbnail']) }}"
                                            alt="">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Images</label>
                                <input type="file" multiple name="product_images[]" class="form-control"
                                    id="prod_thumbnail">
                                    <img style="visibility:hidden" id="prview" src="" width=100 height=100 />
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    {{-- {{ dd(json_decode($product->product_images)) }} --}}
                                    @foreach (json_decode($product->product_images) as $item)
                                        <div class="col-md-2">
                                            <img class="img-fluid" src="{{ asset('images/product_images/' . $item) }}"
                                                alt="">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="size" class="form-label">Price</label>
                                <input type="number" name="price" value="{{ $product->price }}" class="form-control"
                                    id="exampleInputPassword1">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="size" class="form-label">Discounted Price</label>
                                <input type="number" name="discounted_price" value="{{ $product->discounted_price }}"
                                    class="form-control" id="exampleInputPassword1">
                            </div>
                            {{-- <div class="col-md-6 mb-3">
                                <label for="size" class="form-label">Size</label>
                                <input type="text" name="size" value="{{ $product->size }}" class="form-control"
                                    id="exampleInputPassword1">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="size" class="form-label">Color</label>
                                <input type="text" name="color" value="{{ $product->color }}" class="form-control"
                                    id="exampleInputPassword1">
                            </div> --}}
                            <div class="col-md-6 mb-3">
                                <label for="longdescription" class="form-label">Select ZipCOde</label>
                                <select name="zipcode" class="form-select form-select-sm mb-3"
                                    aria-label=".form-select-sm example">
                                    <option disabled>Select ZipCode </option>
                                    @foreach ($zipcodes as $item)
                                        <option value="{{ $item->id }}" @if($item->id==$product->zipcode) selected

                                        @endif>{{ $item->zipcode }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="size" class="form-label">Delivery Charges</label>
                                <input type="number" name="delivery_charges" value="{{ $product->delivery_charges }}"
                                    class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Form End -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function (e) {
        $('#image').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        });
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        prod_thumbnail.onchange = evt => {
            const [file] = prod_thumbnail.files
            if (file) {
                prview.style.visibility = 'visible';

                prview.src = URL.createObjectURL(file)
            }
        }
    </script>
    <script>
        $(document).ready(function() {
        if (window.File && window.FileList && window.FileReader) {
            $("#images").on("change", function(e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                var file = e.target;
                $("<span class=\"pip\">" +
                    "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                    "<br/><span class=\"remove\">Remove image</span>" +
                    "</span>").insertAfter("#images");
                $(".remove").click(function(){
                    $(this).parent(".pip").remove();
                });

                // Old code here
                /*$("<img></img>", {
                    class: "imageThumb",
                    src: e.target.result,
                    title: file.name + " | Click to remove"
                }).insertAfter("#files").click(function(){$(this).remove();});*/

                });
                fileReader.readAsDataURL(f);
            }
            console.log(files);
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
        });
        // Old Selected Value
        $(function() {
            $("select").each(function (index, element) {
                        const val = $(this).data('value');
                        if(val !== '') {
                            $(this).val(val);
                        }
                });
        })
</script>
@endsection
