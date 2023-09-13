@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.register.data') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input placeholder="Enter CNIC Without Dashes (-)" id="cnic" type="number" class="form-control @error('cnic') is-invalid @enderror" name="cnic" value="{{ old('cnic') }}" required autocomplete="cnic">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
