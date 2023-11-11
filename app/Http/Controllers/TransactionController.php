<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Transaction;

use App\Traits\Payment;


class TransactionController extends Controller
{
    use Payment;

    public $reference_no;

   public function callback($type)
   {

        return $this->paymentCallback($type);
   }

   public function showPaymentMethods()
   {

        $paymentMethods=\App\Models\PaymentSetting::where('status',1)->get();

        $data=session('order_detail');


        return view('payments.index',compact('paymentMethods','data'));
   }

       /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Request $request)
    {
        $request->validate(['payment_method'=>'required']);
        
        try {

            $data=session('order_detail');

            $this->getReferenceNo();


        if(isset($data) && count($data)):

        $data['reference']=$this->reference_no;



       $response=$this->initializePayment($request->payment_method,$data);

     //  echo '<pre>';print_r($response);die;


      if(isset($response['info']['data']['link']))
      {
         return redirect($response['info']['data']['link']);
      }


      endif;


            
        } catch (Exception $e) {

            echo $e->getMessage();
            
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('membership::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('membership::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function getReferenceNo($postfix='',$ref_no='')
    {
      if($ref_no && !\App\Models\TransactionReferenceId::where('trans_ref_id',$ref_no)->exists()):

        $ref_obj=\App\Models\TransactionReferenceId::create(['trans_ref_id'=>$ref_no]);

          $this->reference_no= $ref_obj->trans_ref_id;



      else:

           $ref_no=rand(0000000000,9999999999);

           $ref_no=$ref_no.$postfix;

           $this->getReferenceNo('',$ref_no);

      endif;

    }
}
