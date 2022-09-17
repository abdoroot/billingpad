<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<!--content 1 -->
<tr><td align="center" >
        <table style="background: #fbfcfd" width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr><td align="center">
                    <!-- padding --><div style="height: 60px; line-height: 60px; font-size: 10px;"> </div>
                    <div style="line-height: 44px;">
                        <font face="Arial, Helvetica, sans-serif" size="5" color="#57697e" style="font-size: 34px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 34px; color: #57697e;">
                        <img src="{{asset('public/images/logo.jpeg')}}" width="193" height="60" alt="view and download the bill" border="0" style="display: block;" /></font></a>
                        {{$storeDetails->name}} - Sales Bill
					</span></font>
                    </div>
                    <!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;"> </div>
                </td></tr>
            <tr><td align="center">
                    <div style="line-height: 24px;">
                        <font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                        {{$messageData['message']}}
					</span></font>
                    </div>
                    <!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;"> </div>
                </td></tr>
            <tr><td align="center">
                    <div style="line-height: 24px;">
                        <a href="#" target="_blank" style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
                                <a class="btn btn-sm btn-primary" href="{{$messageData['link']}}"  border="0"  >View and download Your bill</a></font></a>
                    </div>
                    <!-- padding --><div style="height: 60px; line-height: 60px; font-size: 10px;"> </div>
                </td></tr>
        </table>
    </td></tr>
<!--content 1 END-->
