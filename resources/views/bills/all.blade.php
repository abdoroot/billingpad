@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a class="btn btn-primary mb-2 btn-lg" href="{{route('home')}}"><i class="fa fa-arrow-left"></i> Return Home</a><br>

                <div class="card">
                    <div class="card-header">All Bills</div>
                    <div class="card-body" style='overflow: scroll;'>

                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <!--<th scope="col">#</th>-->
                                <th scope="col">Custome name</th>
                                <th scope="col">Custome Phone</th>
                                <th scope="col">Total</th>
                                <th scope="col">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $counter=0 @endphp
                            @foreach($bill as $key => $value)
                                @php
                                    $counter++;
                                    $billData = json_decode($value['data']);
                                @endphp
                                <tr>
                                    <!--<th scope="row">{{$counter}}</th>-->
                                    <td>{{$billData->customer_name}}</td>
                                    <td>{{$billData->customer_phone}}</td>
                                    <td>{{$billData->netTotal}}</td>
                                    <td>
                                        <a href="{{route('showBill',$value['id'])}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="{{route('deleteBill',$value['id'])}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




@section('extra-script')
<script>
</script>
@endsection
