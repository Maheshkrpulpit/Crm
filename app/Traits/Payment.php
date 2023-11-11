<?php

namespace App\Traits;

use KingFlamez\Rave\Facades\Rave as Flutterwave;


trait Payment
{

public function paymentMethod($type)
{

       $method= \App\Models\PaymentSetting::find($type);

       return strtolower($method->title??'');

}

 public function initializePayment($type,$data)
 {

    switch($this->paymentMethod($type)):

    	case 'flutterwave':

    	return $this->flutterwave($data);

    	break;

        case 'atompay':

        return $this->atompay($data);

        break;


    endswitch;

 }

 public function atompayCallback()
 {
    $atompay=new \App\PaymentGateways\Atompay;


    $gatewaySettings=\App\Models\PaymentSetting::where('title','atompay')->first();



    $settings=(array)json_decode($gatewaySettings->options);
     
    $response=$atompay->atomResponse($settings);

     echo '<pre>';print_r($response);die;
 }

 public function atompay($data)
 {
    $atompay=new \App\PaymentGateways\Atompay;

    $business_settings=\App\Models\BusinessSetting::first();


     $data['return_url'] = route('payment.callback','atompay');
     // $data['hash_key']='KEYRESP123657234';
     $data['currency']=$data['currency']??$business_settings->default_currency;

    $gatewaySettings=\App\Models\PaymentSetting::where('title','atompay')->first();



    $settings=(array)json_decode($gatewaySettings->options);

    $data=$data+$settings;



    $request=(object)$data;

    //echo '<pre>';print_r($request);die;





    $response=$atompay->atom_request($request);

     return $response;


 }

 public function paymentCallback($type)
 {
    
    switch($type):

    	case 'flutterwave':


    	return $this->flutterwaveCallback();

    	break;

        case 'atompay':


        return $this->atompayCallback();

        break;


    endswitch;
 }


     public function flutterwave($data)
    {
        //This generates a payment reference
        $reference = Flutterwave::generateReference();

         $business_settings=\App\Models\BusinessSetting::first();

        $data['currency']=$data['currency']??$business_settings->default_currency;


        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => $data['amount'],
            'email' => $data['email'],
            'tx_ref' => $data['reference'],
            'currency' => 'NGN', //$data['currency'],
            'redirect_url' => route('payment.callback','flutterwave'),
            'customer' => [
                'email' => $data['email'],
                "phone_number" => $data['phone'],
                "name" => $data['name'],
                "customer_id"=>$data['customer_id'],
            ],

            "customizations" => [
                "title" => $data['title']??'',
                "description" => $data['description']??''
            ]
        ];

        $payment = Flutterwave::initializePayment($data);

        //echo '<pre>';print_r($payment);die;



        // if ($payment['status'] !== 'success') {
        //     // notify something went wrong
        //     return;
        // }



        return array('info'=>$payment);
    }


    /**
     * Obtain Rave callback information
     * @return void
     */
    public function flutterwaveCallback()
    {
       
        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {
        
        $transactionID = Flutterwave::getTransactionIDFromCallback();
        $data = Flutterwave::verifyTransaction($transactionID);

        $response=$data['data']??[];


         $order_detail=session('order_detail');

         if(count($order_detail) && $data['status']=='success'):

            $payment=['user_id'=>$order_detail['user_id']??1,
                      'api_id'=>$response['id'],
                      'tx_ref'=>$response['tx_ref'],
                      'api_ref'=>$response['flw_ref'],
                      'type'=>$order_detail['type']??'',
                      'item_id'=>$order_detail['item_id']??'',
                      'ip'=>$response['ip'],
                      'amount'=>$response['amount'],
                      'charged_amount'=>$response['charged_amount'],
                      'currency'=>$response['currency'],
                      'status'=>$response['status'],
                      'response'=>json_encode($data),

                  ];


                    session(['is_paid_reference'=>1]);



                  if(isset($order_detail['controller']) && isset($order_detail['action'])):

                   // echo '<pre>';print_r($order_detail);die;

                     $order = (new $order_detail['controller'])->{$order_detail['action']}();

                    if(isset($order['user_id'])):

                        $payment['user_id']=$order['user_id'];

                    endif;

                  endif;



                 \App\Models\Transaction::create($payment);

                 request()->session()->forget(['order_detail', 'is_paid_reference']);

                   if($order_detail['return_route']):


                    return redirect($order_detail['return_route'])->withSuccess($order['message']);

                   endif;


        elseif(count($order_detail)):

            echo 'something went wrong.please try again';die;

         endif;







        if($data['status']=='success'):

            $response=$data['data'];

            $membership=session('membership_data');

            if(!isset($membership['member'])):

                $member=\Modules\Membership\Entities\Member::where('email',$response['customer']['email'])->first();


                $membership['member']['id']=$member->id;

            endif;



            $payment=['user_id'=>$membership['member']['id'],
                      'api_id'=>$response['id'],
                      'tx_ref'=>$response['tx_ref'],
                      'api_ref'=>$response['flw_ref'],
                      'type'=>'membership',
                      'item_id'=>$membership['category']??'',
                      'ip'=>$response['ip'],
                      'amount'=>$response['amount'],
                      'charged_amount'=>$response['charged_amount'],
                      'currency'=>$response['currency'],
                      'status'=>$response['status'],
                      'response'=>json_encode($data),
                  ];


                   \Modules\Membership\Entities\MemberMembership::where('member_id',$membership['member']['id'])->update(['is_paid'=>1]);

                   \App\Models\Transaction::create($payment);


        endif;

      
             $response= ['status' => 1,
                        'message' => __("Payment is successful."),
                        'type'=>'success',
                    ];

            
            return redirect()->route('membership.member.show')->with('response',$response);
        }
        elseif ($status ==  'cancelled'){
            //Put desired action/code after transaction has been cancelled here
             $response= ['status' => 0,
                        'message' => __("Payment is cancelled."),
                        'type'=>'danger',
                    ];
            return redirect()->route('membership.payment.methods')->with('response',$response);
        }
        else{

            echo '<pre>';print_r(request()->all());
            //Put desired action/code after transaction has failed here
        }
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (including parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here

    }







}