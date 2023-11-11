<div class="tab-pane fade" id="custom-v-pills-Logo" role="tabpanel" aria-labelledby="custom-v-pills-Logo-tab">
    <div class="row">
        <div class="tab-pane" id="news" role="tabpanel">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card border">
                        <div class="card-body">
                            <h4>{{lang('Dark Logo')}}</h4>
                            <div class="card">
                                <img class="card-img-top img-fluid" src="@if(isset($general_setting['dark_logo_url'])){{$general_setting['dark_logo_url']}}@else {{asset('assets/images/logo-dark.png')}} @endif"
                                     alt="Card image cap" id="dark_logo_image">
                                <input class="form-control mb-2" type="file" name="dark_logo" id="dark_logo" required>
                                <p class="text-center">(290px X 51px)</p>
                                <span style="color: red;display: none;" id="dark_logo_error"></span>
                                <div class="card-body">
                                    <div class="text-end">
                                        <input type="button" id="update_dark_logo" class="btn btn-primary"
                                               value="{{lang('Update')}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card border">
                        <div class="card-body">
                            <h4>{{lang('Light Logo')}}</h4>
                            <div class="card">
                                <img class="card-img-top img-fluid" src="@if(isset($general_setting['light_logo_url'])){{$general_setting['light_logo_url']}}@else {{asset('assets/images/logo-light.png')}} @endif"
                                     alt="Card image cap" id="light_logo_image">
                                <input class="form-control mb-2" type="file" name="light_logo" id="light_logo" required>
                                <p class="text-center">(290px X 51px)</p>
                                <span style="color: red;display: none;" id="light_logo_error"></span>
                                <div class="card-body">
                                    <div class="text-end">
                                        <input type="button" id="update_light_logo" class="btn btn-primary"
                                               value="{{lang('Update')}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               {{-- <div class="col-lg-3">
                    <div class="card border">
                        <div class="card-body">
                            <h4>{{lang('Small Dark Logo')}}</h4>
                            <div class="card">
                                <img class="card-img-top img-fluid" src="@if(isset($general_setting['dark_logo_small_url'])){{$general_setting['dark_logo_small_url']}}@else {{asset('assets/images/small/img-1.jpg')}} @endif"
                                     alt="Card image cap" id="dark_logo_small_image">
                                <input class="form-control mb-2" type="file" name="dark_logo_small" id="dark_logo_small" required>
                                <p class="text-center">(32px X 32px)</p>
                                <span style="color: red;display: none;" id="dark_logo_small_error"></span>
                                <div class="card-body">
                                    <div class="text-end">
                                        <input type="button" id="update_dark_logo_small" class="btn btn-primary"
                                               value="{{lang('Update')}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card border">
                        <div class="card-body">
                            <h4>{{lang('Small Light Logo')}}</h4>
                            <div class="card">
                                <img class="card-img-top img-fluid" src="@if(isset($general_setting['light_logo_small_url'])){{$general_setting['light_logo_small_url']}}@else {{asset('assets/images/small/img-1.jpg')}} @endif"
                                     alt="Card image cap" id="light_logo_small_image">
                                <input class="form-control mb-2" type="file" name="light_logo_small" id="light_logo_small" required>
                                <p class="text-center">(32px X 32px)</p>
                                <span style="color: red;display: none;" id="light_logo_small_error"></span>
                                <div class="card-body">
                                    <div class="text-end">
                                        <input type="button" id="update_light_logo_small" class="btn btn-primary"
                                               value="{{lang('Update')}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
</div>
