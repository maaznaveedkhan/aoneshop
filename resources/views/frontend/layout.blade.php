@php
    use App\Models\Category;
    $categories = Category::all();
@endphp

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>A One LLC</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" />

  </head>
  <body>
    <!-- Header Start -->
    <header>
      <div class="header_wrapper">
        <div class="logo">
            <a href="{{url('/')}}">
          <img
            src="{{ asset('assets/images/aone_emart.png') }}"
            class="desktop_logo"
            alt=""
          />
        </a>
        <a href="{{url('/')}}">
          <img src="{{ asset('assets/images/aone_emart.png') }}" alt="" class="moblie_logo" />
        </a>
        </div>
        <div class="zip_code">
          <a
            href="#"
            class="text-light text-decoration-none"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
            >Zip Code</a
          >

          <!-- Modal -->
          <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                    Enter The Zip Code
                  </h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form action="{{route('search.zip.code')}}" method="GET">
                    @csrf
                    <div class="">
                      <input type="text" required name="zip_code" placeholder="Enter Area Zip Code" class="form-control w-50">
                        <br>
                       <input type="submit" value="Submit" class="btn btn-block btn-success">
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    Close
                  </button>

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="categories">
          <a
            class="text-decoration-none text-light"
            data-bs-toggle="offcanvas"
            href="#offcanvasExample"
            role="button"
            aria-controls="offcanvasExample"
          >
            <b>
              <svg class="category_icon"
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-grid"
                viewBox="0 0 16 16"
              >
                <path
                  d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"
                />
              </svg>
              Deparments</b
            >
          </a>

          <div
            class="offcanvas offcanvas-start"
            tabindex="-1"
            id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel"
          >
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                <a href="{{ url('/') }}" class="btn btn-oultine-dark">  A ONE LLC</a>

              </h5>
              <button
                type="button"
                class="btn-close text-reset"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
              ></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav">
                <li class="nav-item fw-bold">
                  <a
                    class="nav-link text-dark active"
                    aria-current="page"
                    href="{{ url('/') }}"
                    >Home</a
                  >
                </li>
               @foreach ($categories as $category)
               <li class="nav-item text-start">
                <a href="{{ route('view.category.products',['id'=>$category->id]) }}" class="nav-link text-dark " href="#">{{ $category->title }}</a>
              </li>
               @endforeach

              </ul>
            </div>
          </div>
        </div>
        <div class="search_bar">
          <!-- <input type="search" placeholder="Search Everything...." /> -->
          <form action="{{ route('search.results.products') }}" method="GET">
            @csrf
          <div class="input-group ">

            <input required type="text" name="data" id="search_q" class="form-control" placeholder="Search Everything ....." aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-warning" type="submit" id="button-addon2"><i class="fa fa-search text-dark "></i></button>

            <div id="search_results" class="shadow-sm border rounded" style="width: -webkit-fill-available;position: absolute;  border-radius:0%;background-color:white;padding:1rem; top:47px;z-index:1">

            </div>
        </form>
        </div>
        </div>
        <div class="mobile_search_bar">
          <div id="myOverlay" class="overlay">
            <span class="closebtn" onclick="closeSearch()" title="Close Overlay"
              >×</span
            >
            <div class="overlay-content">
              <form action="{{ route('search.results.products') }}" method="GET">
                @csrf
                <input type="text"  id="search_" placeholder="Search.." name="data" />
                <button type="submit"><i class="fa fa-search "></i></button>
                <div id="search_res" class="shadow-sm border rounded" style="width: -webkit-fill-available;position: absolute;  border-radius:0%;background-color:white;padding:1rem; top:47px;z-index:1">

                </div>
              </form>
            </div>
          </div>
          <a href="#" class="btn" class="openBtn" onclick="openSearch()">
            <i class="fa fa-search fa-2x text-light" aria-hidden="true"></i>
          </a>
        </div>
        <div class="my_account">
          <a href="#" id="dropdownMenuLinkAccount" data-bs-toggle="dropdown" aria-expanded="false" class="dropdown-toggle text-light">My Account

          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLinkAccount">
            @guest()
            <li><a class="dropdown-item text-dark" href="{{route('login')}}">Login</a></li>
            <li><a class="dropdown-item text-dark" href="{{route('register')}}">Register</a></li>
            @endguest
            @auth
            <li><a class="dropdown-item text-dark" href="{{url('/user/dashboard')}}">Dashboard</a></li>
            <li><a class="dropdown-item text-dark" href="{{route('logout')}}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a></li>
            @endauth
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </ul>
        </div>
        <div class="cart">
          <a href="{{ route('cart') }}" class="btn"> <i class="fa fa-shopping-cart fa-2x text-light" aria-hidden="true"></i> <sup class=""><b>
          @if (session()->has('cart'))
            {{count( session()->get('cart')) }}
          @endif
          </b></sup></a>
        </div>
      </div>


    </header>
    <div id="special_category" class="text-center">
      <div class="row pt-1">
        <div class="col-6">
          <a href="#" class="text-light text-decoration-none">Save now 20% </a>
        </div>
        <div class="col-6 " >
          <div id="special_mobile_category">
            <a class=" text-light text-decoration-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Special Category</a>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
              <div class="offcanvas-header">
                <h5 id="offcanvasRightLabel">Special Category</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">

              </div>
            </div>
          </div>

          <ul id="special_items">
            <li>
              <a href="">clothes</a>
            </li>
            <li>
              <a href="">Mates</a>
            </li>
            <li>
              <a href="">Accessories</a>
            </li>
          </ul>
        </div>
      </div>

    </div>
    <!-- Header End -->


    <div id="main_content">
        @yield('content')

    </div>


    <footer>
      <div class="row">
        <div class="col text-center p-4">
          <p>© {{date('Y')}} AONE EMART. All Rights Reserved.</p>
        </div>
      </div>
    </footer>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script>
      function openSearch() {
        document.getElementById("myOverlay").style.display = "block";
        document.querySelector(".carousel-control-next-icon").style.display = "none";
        document.querySelector(".carousel-control-prev-icon").style.display = "none";
      }

      function closeSearch() {
        document.getElementById("myOverlay").style.display = "none";
        document.querySelector(".carousel-control-next-icon").style.display = "inline-block";
        document.querySelector(".carousel-control-prev-icon").style.display = "inline-block";

      }
    </script>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"
integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    $('#search_results').hide();
    $('#search_res').hide();
    $(document).ready(function() {
        $('#search_q').keyup(function() {
        var q = $('#search_q').val();

        var q = $('#search_q').val();
        // console.log(q);

        $.ajax({
            url: '{{ route('search.results.products') }}',
            method: "get",
            data: {
                _token: '{{ csrf_token() }}',
                data: q,
            },
            success: function(response) {
                $('#search_results').empty();
                if(response.length === 0)
                {
                    $('#search_results').show();
                    $('#search_results').append('<p>no result found </p>');

                }else{
                    $('#search_results').show();
                    $('#search_results').append(response);
                }
                // window.location.reload();
                console.log(response);
            }
        });
        });

    $('#search_').keyup(function() {

        var q = $('#search_').val();
        // console.log(q);

        $.ajax({
            url: '{{ route('search.results.products') }}',
            method: "get",
            data: {
                _token: '{{ csrf_token() }}',
                data: q,
            },
            success: function(response) {
                $('#search_res').empty();
                if(response.length === 0)
                {
                    $('#search_res').show();
                    $('#search_res').append('<p>no result found </p>');

                }else{
                    $('#search_res').show();
                    $('#search_res').append(response);
                }
                // window.location.reload();
                console.log(response);
            }
        });


    });





});
</script>
  </body>
</html>
