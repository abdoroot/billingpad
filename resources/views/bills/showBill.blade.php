@guest
  @php 
  $hideNav = true; 
  @endphp
@endguest

@php 
  $title = $billData->customer_name." Invoice #".$request->id;
@endphp

@extends('layouts.app')

@section('content')
<div class="container">

<div class="text-center">
    @guest
      <button type="button" id="print" class="btn btn-primary btn-lg mb-2 "><i class="fa fa-print"></i> Print</button>
    @else
        <button type="button" id="print" class="btn btn-primary btn-lg mb-2 "><i class="fa fa-print"></i> Print</button>
        <button type="button" data-toggle="modal" data-target="#SentTOemail" class="btn btn-primary btn-lg mb-2 "><i class="fa fa-share"></i> Share to email</button>
        <button type="button" data-toggle="modal" data-target="#SentToWhatsAPpp" class="btn btn-primary btn-lg mb-2 "><i class="fa fa-share"></i> Share to WhatsApp</button>
        <a class="btn btn-primary mb-2 btn-lg" href="{{route('home')}}"><i class="fa fa-arrow-left"></i> Return Home</a><br>
    @endguest
</div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row justify-content-center" id="printable">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center font-weight-bold mb-1" style="font-weight: bold;">Billing Pad</h2>
                              <div style="text-align: center">
                    <img src="{{asset('public/images/logo.jpeg')}}" width="193" height="80" alt="logo" border="0" />
                </div>
                              <div class="row pb-2 p-2">
                                <div class="col-sm-7">
                                    <p><h5 class="font-weight-bold mb-1" style="font-weight: bold;">Store Details</h5></p>
                                    <p class="mb-0"><strong>Store</strong>: {{$storeDetails->name}}</p>
                                    <p class="mb-0"><strong>Address</strong>: {{$storeDetails->address}}</p>
                                    <p class="mb-0"><strong>Phone Number</strong>: {{$storeDetails->phone_number}}</p>
                                </div>

                                <div class="col-sm-5 text-right">
                                    <p><h5 class="font-weight-bold mb-1" style="font-weight: bold;">Bill TO:</h5></p>
                                    <p class="mb-0"><strong>Customer name</strong>: {{$billData->customer_name}}</p>
                                    <p class="mb-0"><strong>Customer phone</strong>: {{$billData->customer_phone}}</p>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" id="billTable">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase small font-weight-bold">SR No.</th>
                                        <th class="text-uppercase small font-weight-bold">Items Name</th>
                                        <th class="text-uppercase small font-weight-bold">Quantity</th>
                                        <th class="text-uppercase small font-weight-bold">Unit Rate</th>
                                        <th class="text-uppercase small font-weight-bold">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $counter = 0; @endphp
                                    @foreach($billData->rows as $key => $value)
                                        @php $counter++ @endphp
                                        <tr>
                                            <td>{{$counter}}</td>
                                            <td>{{(isset($value->name)) ? $value->name:""}}</td>
                                            <td>{{(isset($value->itemQty)) ? $value->itemQty:""}}</td>
                                            <td>{{(isset($value->itemPrice)) ? $value->itemPrice:""}}</td>
                                            <td>{{(isset($value->itemAmount)) ? $value->itemAmount:""}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <table class="table table-bordered mt-2" id="footerTable">
                                    <tr><td>Discount %</td><td id="discount">{{$billData->discountPercent}}</td></tr>
                                    <tr><td>Discount Amount</td><td id="discountIn">{{$billData->discountAmount}}</td></tr>
                                    <tr><td>Gross Total</td><td id="grossTotal">{{$billData->grossTotal}}</td></tr>
                                    <tr><td>Net Total</td><td id="netTotal">{{$billData->netTotal}}</td></tr>
                                </table>
                            </div><!--table responsive end-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="SentToWhatsAPpp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Share Invoce To Customer WhatsApp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient Number(With Country Code):</label>
                            <input type="text" required name="mobilenumber" value="92" class="form-control" id="recipient-name">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-secondary " data-dismiss="modal">Close</button>
                    <button class="btn btn-lg btn-primary" id="ShareWhatsAppBtn">Share</button>
                </div>
        </div>
    </div>
</div>


<div class="modal fade" id="SentTOemail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="{{route('sendEmail',$bill->id)}}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="email" required name="email" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea name="message"  class="form-control" id="message-text"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-secondary " data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-lg btn-primary" value="Send message">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('extra-script')

<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<script>
currentUrl = "{{url()->current()}}";
@if(isset($request->download))
$(document).ready(function () {
     Print();
 });
@endif


$("#SentToWhatsAPpp").on("click", "#ShareWhatsAppBtn", function() {
       number = $("input[name=mobilenumber]").val();
       if(number.length < 6){
           alert('Please enter valid number');
       }else{
           //alert(currentUrl+"/print");
           window.location = 'https://wa.me/'+number+"?text=DownLoad Your Bill from Here "+currentUrl+"/print";
       }
});



    $("#addRow").click(function () {
        addEmptyRow();
    });

    function addEmptyRow(){
        var length = $('#billTable').find('tbody tr').length;
        length = length+1;
        $('#billTable > tbody').append("<tr id='tr_"+length+"'>" +
            "<td>"+length+"</td>"+
            "<td><input name='itemName' trId='"+length+"' type='text' class='rowInput form-control itemName'></td>"+
            "<td><input type='number' step='0.01' name='itemQty' trId='"+length+"' class='rowInput form-control itemQty'></td>"+
            "<td><input type='number' step='0.01' name='itemPrice' trId='"+length+"' class='rowInput form-control itemPrice'></td>"+
            "<td class='price-amount'>0</td>"+
            '<td><button  type="button" class="btn btn-danger btn-sm mb-2 remove-row"><i class="fa fa-trash"></i></button></td>'+
            "</tr>"
        );
    }

    function reSetSerial(){
        $('table > tbody  > tr').each(function(index, tr) {
            $('#billTable tbody tr:eq(' + index + ') td:eq(0)').text(index+1)
        });
    }

    $("#billTable").on("click", ".remove-row", function() {
        $(this).closest("tr").remove();
        reSetSerial();
    });

    $("#print").click(function () {
        Print();
    });

    function rowTotal(id){
        qty = $('#tr_'+trId+' input[name="itemQty"]').val();
        itemPrice = $('#tr_'+trId+' input[name="itemPrice"]').val();
        ItemRowTotal = qty * itemPrice;
        $('#tr_'+trId+' .price-amount').text(ItemRowTotal);
        tableTotal();
    }

    $("#footerTable").on("input", ".discount", function() {
        tableTotal();
    });

    $("#billTable").on("input", ".rowInput", function() {
        trId = $(this).attr('trid');
        rowTotal(trId);
    });

    function tableTotal() {
        prices = [];
        $('.price-amount').each(function(index, value) {
            price = parseFloat($(this).text());
            prices.push(price);
        });

        const sum = prices.reduce((partialSum, a) => partialSum + a, 0);
        if(sum > 0){
            discountPercentage = $('input[name="discount"]').val();
            if(discountPercentage == ""){discountPercentage =0;}
            discountIn = sum * discountPercentage /100;
            $("#grossTotal").text(sum);
            $("#discountIn").text(discountIn);
            $("#netTotal").text(sum-parseFloat(discountIn));
            //netTotal
        }
    }

    function Print(){
        //printJS('printable', 'html');
        printJS({
            printable: 'printable',
            type: 'html',
            css:'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'
        });
    }

    function saveBill(print=false){
        rows = $('#billTable tbody tr').length;
        customerName = $('input[name="customer_name"]').val();
        customerPhone = $('input[name="customer_phone"]').val();
        emptyNamesCounter = 0;
        emptyNamesCounter = 0;
        allRows = [];
        bill = {
            "customer_name"  :customerName,
            "customer_phone" :customerPhone,
            "rows"           :allRows,
            "discountPercent":1,
            "discountAmount" :1,
            "grossTotal"     :1,
            "netTotal"       :1,
        };

        for (let i = 1; i < rows+1; i++) {

            itemNameValue = $("#tr_"+i+" input[name='itemName']").val();
            itemQty = $("#tr_"+i+" input[name='itemQty']").val();
            itemPrice = $("#tr_"+i+" input[name='itemPrice']").val();

            if(itemNameValue == "") {
                emptyNamesCounter++;
            }else{
                rowArray = {
                    "name": itemNameValue,
                    "itemQty":itemQty,
                    "itemPrice": itemPrice
                };
                //add to jsonObject
                allRows.push(rowArray);
            }
        }

        if(emptyNamesCounter == rows){
            alert('You can\'t print empty rows');
        }else{
            //save to data base first
            //console.log(bill);
            $.ajax('{{route('saveBill')}}', {
                data : JSON.stringify(bill),
                contentType : 'application/json',
                type : 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                , statusCode: {
                    400: function() {
                        alert( "some Thing went wrong" );
                    }
                }
                ,  statusCode: {
                    200: function(result) {
                        window.location = '{{route('showBill','')}}/'+result.id;
                    }
                }
            });
        }
    }

</script>
@endsection
