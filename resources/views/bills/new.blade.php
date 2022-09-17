@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-sm-12">
                    <a class="btn btn-primary mb-2 btn-lg" href="{{route('home')}}"><i class="fa fa-arrow-left"></i> Return Home</a><br>

                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-center font-weight-bold mb-1" style="font-weight: bold;">Billing Pad</h2>
                         
                            <div class="row pb-2 p-2">
                                <div class="col-md-7">
                                    <p><h5 class="font-weight-bold mb-1" style="font-weight: bold;">Store Details</h5></p>
                                    <p class="mb-0"><strong>Store</strong>: {{$storeDetails->name}}</p>
                                    <p class="mb-0"><strong>Address</strong>: {{$storeDetails->address}}</p>
                                    <p class="mb-0"><strong>Phone Number</strong>: {{$storeDetails->phone_number}}</p>
                                </div>

                                <div class="col-md-5 text-right">
                                    <p><h5 class="font-weight-bold mb-1" style="font-weight: bold;">Bill TO:</h5></p>
                                    <p class="mb-2"> <input type="text" class="form-control" placeholder="Customer name" name="customer_name"></p>
                                    <p><input type="text" class="form-control" placeholder="Phone Number" name="customer_phone"></p>
                                </div>
                            </div>

                            <div class="col-10">
                                <button type="button" id="addRow" class="btn btn-primary btn-lg mb-2"><i class="fa fa-plus"></i> Add New Row</button>
                                <!--<button type="button" id="print" class="btn btn-primary btn-sm mb-2 right"><i class="fa fa-save"></i> Save</button>-->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered mb-0" id="billTable" style="min-width: 550px;">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase small font-weight-bold">SR No.</th>
                                        <th class="text-uppercase small font-weight-bold">Items Name</th>
                                        <th class="text-uppercase small font-weight-bold">Quantity</th>
                                        <th class="text-uppercase small font-weight-bold">Unit Rate</th>
                                        <th class="text-uppercase small font-weight-bold">Amount</th>
                                        <th class="text-uppercase small font-weight-bold">#</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                                <table class="table table-bordered mt-2" id="footerTable">
                                    <tr><td>Discount %</td><td><input name='discount' step='0.01' type="number" class='discount form-control'></td></tr>
                                    <tr><td>Discount Amount</td><td id="discountIn">0</td></tr>
                                    <tr><td>Gross Total</td><td id="grossTotal">0</td></tr>
                                    <tr><td>Net Total</td><td id="netTotal">0</td></tr>
                                </table>
                            </div><!--table responsive end-->
                            
                             <div class="col-10">
                                <button type="button" id="print" class="btn btn-primary btn-lg mb-2 right"><i class="fa fa-save"></i> Save</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('extra-script')
<script>
    $(document).ready(function () {
        //load with five rows
        for (let i = 0; i < 5; i++) {
            addEmptyRow();
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
        saveBill();
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

    function saveBill(print=false){
        rows = $('#billTable tbody tr').length;
        customerName = $('input[name="customer_name"]').val();
        customerPhone = $('input[name="customer_phone"]').val();
        discountPercent = $('input[name="discount"]').val();
        discountAmount = $('#discountIn').text();
        grossTotal     = $('#grossTotal').text();
        netTotal       = $('#netTotal').text();
        emptyNamesCounter = 0;
        emptyNamesCounter = 0;
        allRows = [];
        bill = {
            "customer_name"  :customerName,
            "customer_phone" :customerPhone,
            "rows"           :allRows,
            "discountPercent":discountPercent,
            "discountAmount" :discountAmount,
            "grossTotal"     :grossTotal,
            "netTotal"       :netTotal,
        };

        for (let i = 1; i < rows+1; i++) {

            itemNameValue = $("#tr_"+i+" input[name='itemName']").val();
            itemQty = $("#tr_"+i+" input[name='itemQty']").val();
            itemPrice = $("#tr_"+i+" input[name='itemPrice']").val();
            itemAmount = $("#tr_"+i+" .price-amount").text();

            if(itemNameValue == "") {
                emptyNamesCounter++;
            }else{
                rowArray = {
                    "name": itemNameValue,
                    "itemQty":itemQty,
                    "itemPrice": itemPrice,
                    "itemAmount": itemAmount
                };
                //add to jsonObject
                allRows.push(rowArray);
            }
        }

        if(emptyNamesCounter == rows){
            alert('You can\'t Save empty rows');
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
