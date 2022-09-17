@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Welcome ') }} - {{$user->name}}</div>

                <div class="card-body text-left">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class='row'>
                        <div class='col-6 mb-2'><a class="btn btn-lg btn-primary" href="{{route('newBill')}}">New Bill</a><br></div>
                        <div class='col-6  mb-2'><a class="btn btn-lg btn-primary" href="{{route('allBills')}}">All Bills</a><br></div>
                        <div class='col-6 mb-2'><a class="btn btn-lg btn-primary" href="{{route('storeDetails')}}">Store Details</a><br></div>
                        <div class='col-6 mb-2'><a class="btn btn-lg btn-primary" href="{{url('logout')}}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection

