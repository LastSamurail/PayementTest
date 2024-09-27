<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Models\paiement;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function paiement(Request $request){

        $validator = Validator($request->all(), [
            'montant' => 'required',
            'phonenumber' => 'required',
            'type_paiement' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $phonenumber = $request->phonenumber;
        $montant = $request->montant;
        $type_paiement = $request->type_paiement;
        $reference = getRamdomText(8);

        $pay = new paiement();
        $pay->reference = $reference;
        $pay->phone_number = $phonenumber;
        $pay->status = 0;
        $pay->type_paiement = $type_paiement;
        $pay->montant = $montant;
        $pay->save();

        $pay = payment($reference, $montant, $phonenumber, $type_paiement);

        return redirect()->back() ->with('succes', 'Paiement enregistrer!');
        // dd($request['montant']);

    }


    public function verify_paiementStatus(Request $request){
        $allPaiement = paiement::where(['status'=> 0])->get();

        foreach ($allPaiement as $pay) {
            if (checkPayment($pay->reference) == 0) {
                $checkPayment = paiement::where(['reference'=>$pay->reference])->first();
                $checkPayment->status = 1;
                $checkPayment->save();

            }else{
                $checkPayment = paiement::where(['reference'=>$pay->reference])->first();
                $checkPayment->status = -1;
                $checkPayment->save();

            }

            return 1;
        }



    }


}