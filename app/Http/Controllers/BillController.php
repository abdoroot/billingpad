<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\storeDetails;
use App\Models\Bill;

class BillController extends Controller
{
    public function newBill(Request $request){
        $storeDetails = storeDetails::find(1);
        return view('bills.new',compact('storeDetails'));
    }

    public function allBills(Request $request){
        $bill = Bill::all();
        return view('bills.all',compact('bill'));
    }

    public function deleteBill(Request $request){
        $deleteBill = Bill::where('id',$request->id)->delete();
        if($deleteBill){
            return redirect(route('allBills'))->with('message', 'deleted successfully.');
        } else{
            return redirect(route('allBills'))->with('message', 'Unable to delete bill. Please try again.');
        }
    }

    public function showBill(Request $request){
      
    $storeDetails = storeDetails::find(1);

        if($request->has('email')){
            //send email to customer
            $messageData =[
                'email' => $request->email,
                'message' => $request->message,
                'link' => route('showBill',$request->id)."/download",
            ];

            $emailTemplate =  view('bills.emailTemplate',compact('messageData','storeDetails'));

            $to = $request->email;
            $subject = 'Billing Pad Store Bill#'.$request->id;
            $from = 'billingpaduhsblades.com';
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: '.$from."\r\n".
                'Reply-To: '.$from."\r\n" .
                'X-Mailer: PHP/' . phpversion();
            if(mail($to, $subject, $emailTemplate, $headers)){
                session()->flash('message', 'Your mail has been sent successfully.');
            } else{
                session()->flash('message', 'Unable to send email. Please try again.');
            }
        }

        $bill = Bill::find($request->id);
        $billData = json_decode($bill->data);
        return view('bills.showBill',compact('bill','billData','storeDetails','request'));
    }

    public function saveBill(Request $request){
        $newBill = Bill::create(['data' => json_encode($request->all())]);
        if($newBill){
            return response()->json($newBill,200);
        }else{
            return response()->json('Some thing went wrong',400);
        }
    }


}
