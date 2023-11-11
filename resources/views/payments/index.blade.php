@extends('layouts.master-without-nav')
@section('title')
    @lang('locale.titles.payment_methods')
@endsection
@section('css')

@endsection
@section('content')
<div class="container">
    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- <h1 class="text-center">@lang('locale.titles.sign_up')</h1> -->
        <!--Core Feature end-->
        <!--footer start-->
        
            @component('membership::components.alert',['response'=>session('response')])

@endcomponent

<div class="row mt-5">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body checkout-tab">

                                               {!! Form::open(['url'=>route('payment.create'),'method'=>'post'])!!}

                        <div class="step-arrow-nav mt-n3 mx-n3 mb-3">

                            <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                           
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3 active" id="pills-payment-tab" data-bs-toggle="pill" data-bs-target="#pills-payment" type="button" role="tab" aria-controls="pills-payment" aria-selected="true" data-position="2"><i class="ri-bank-card-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                        Payment Info</button>
                                </li>
                              
                            </ul>
                        </div>

                        <div class="tab-content">

                      
                    

                            <div class="tab-pane fade active show" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">
                                <div>
                                    <h5 class="mb-1">Payment Selection</h5>
                                    <p class="text-muted mb-4">Please select your payment
                                        option</p>
                                </div>

                                <div class="row g-4">

                                    @foreach($paymentMethods as $gateway)
                                    <div class="col-lg-4 col-sm-6">
                                        <div data-bs-toggle="collapse" data-bs-target="#paymentmethodCollapse.show" aria-expanded="false" aria-controls="paymentmethodCollapse">
                                            <div class="form-check card-radio">
                                                <input id="paymentMethod{{$gateway->id}}" name="payment_method" type="radio" class="form-check-input" @if($gateway->is_default) checked @endif value="{{$gateway->id}}">
                                                <label class="form-check-label" for="paymentMethod{{$gateway->id}}">
                                                    <!-- <span class="fs-16 text-muted me-2"><i class="ri-paypal-fill align-bottom"></i></span> -->
                                                    <span class="fs-14 text-wrap">{{$gateway->title}}</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach

                                    @error('payment_method')

                                    <div class="text-danger">{{$message}}</div>

                                    @enderror



                                </div>

                               

                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab" data-previous="pills-bill-address-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Skip for Now</button>
                                    <button type="submit" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="pills-finish-tab"><i class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>Pay</button>
                                </div>
                            </div>

                            <!-- end tab pane -->

                       
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                                              {!! Form::close() !!}

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Selected Category</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-borderless align-middle mb-0">
                            <thead class="table-light text-muted">
                                <tr>
                                    <th style="width: 90px;" scope="col" colspan="2">Name</th>
                                   
                                    <th scope="col" class="text-end">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  
                                    <td colspan="2">
                                        <h5 class="fs-14"><a href="apps-ecommerce-product-details" class="text-dark">{{$data['title']??''}}</a>
                                        </h5>
                                      
                                    </td>
                                    <td class="text-end">{{$data['amount']??''}}</td>
                                </tr>
                              
                             <!--    <tr>
                                    <td class="fw-semibold" colspan="2">Sub Total :</td>
                                    <td class="fw-semibold text-end">$ 359.96</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Discount <span class="text-muted">(VELZON15)</span>
                                        : </td>
                                    <td class="text-end">- $ 50.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Shipping Charge :</td>
                                    <td class="text-end">$ 24.99</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Estimated Tax (12%): </td>
                                    <td class="text-end">$ 18.20</td>
                                </tr> -->
                                <tr class="table-active">
                                    <th colspan="2">Total :</th>
                                    <td class="text-end">
                                        <span class="fw-semibold">
                                           {{$data['amount']??''}}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>








</div>
</div>




@endsection


@section('script')

@endsection