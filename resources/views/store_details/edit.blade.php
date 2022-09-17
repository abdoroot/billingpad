@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            @if(session()->has('message'))
                <div class="alert alert-success mb-2">
                    {{ session('message') }}
                </div>
            @endif
                <a class="btn btn-primary mb-2 btn-lg" href="{{route('home')}}"><i class="fa fa-arrow-left"></i> Return Home</a><br>

            <div class="card">
                <div class="card-header">Store Details</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('UpdateStoreDetails') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" value="{{$storeDetails->name}}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" value="{{$storeDetails->address}}" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="email">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" value="{{$storeDetails->phone_number}}" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('address') }}" required autocomplete="email">

                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    {{ __('update') }}
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
