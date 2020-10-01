<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentVerificationController extends Controller
{
    public function verify(Request $request)
    {
        $status = $request->q;
        // dd($status);
        $oid = $request->oid;
        $refId = $request->refId;
        $amt = $request->amt;
        // dump($oid, $refId, $amt);

        if ($status == 'su') {
            $url = "https://uat.esewa.com.np/epay/transrec";
            $data = [
                'amt' => 100,
                'rid' => $refId,
                'pid' => '123456789147',
                'scd' => 'epay_payment',
            ];

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);

            if (strpos($response, "Success") == true) {
                dd('transaction was successfull');
            } else {
                dd('transaction failed');
            }
        } else {
            dd('transaction failed');
        }
    }
}
