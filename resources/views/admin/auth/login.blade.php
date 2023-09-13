@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    @if(session('success') )
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                       {{session()->get('success')}}
                    </div>
                    @endif
                    @if(count($errors) > 0 )
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <ul class="p-0 m-0" style="list-style: none;">
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('admin.login.data') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                            <label for="cnic" class="col-md-4 col-form-label text-md-end">{{ __('CNIC Number') }}</label>

                            <div class="col-md-6">
                                <input placeholder="Enter CNIC Number Without Dashes(-)" id="cnic" type="number" class="form-control @error('cnic') is-invalid @enderror" name="cnic" value="{{ old('cnic') }}" required autocomplete="cnic" autofocus>

                                @error('cnic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}
                        {{-- <div class="row mb-3">
                            <label for="quota/domicile" class="col-md-4 col-form-label text-md-end">{{ __('quota/domicile Address') }}</label>

                            <div class="col-md-6">
                                <select name="quota/domicile" id="Quota" class="form-control" required>
                                    <option value="">- Select -</option>
                                   
                                   <option value="FEDERAL">FEDERAL</option>
                                       
                                       
                                       <option value="PUNJAB">PUNJAB</option>
                                                                                    
                                                                                    <option value="KHYBER PAKHTUNKHWA">KHYBER PAKHTUNKHWA</option>
                                                                                   
                                                                                     <option value="SINDH RURAL">SINDH RURAL</option>
                                                                                     
                                                                                     <option value="SINDH URBAN">SINDH URBAN</option>
                                                                                     
                                                                                     <option value="BALOCHISTAN">BALOCHISTAN</option>
                                                                                     
                                                                                       <option value="FATA">Ex FATA</option>
                                                                                       
                                                                                    <option value="AJK">AJK</option>
                                                                                    
                                                                                    <option value="GILGIT BALTISTAN">GILGIT BALTISTAN</option>
                                   
                                  </select>

                                @error('quota/domicile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
