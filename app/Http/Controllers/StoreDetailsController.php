<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\storeDetails;

class StoreDetailsController extends Controller
{
 public function storeDetails(Request $request)
 {
     $storeDetails = storeDetails::find(1);
     return view('store_details.edit',compact('storeDetails'));
 }

    public function UpdateStoreDetails(Request $request)
    {
        $storeDetails = storeDetails::find(1);
        $storeDetails->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number
        ]);

        return redirect(route('storeDetails'))->with('message', "Updated successfully");
    }

}
