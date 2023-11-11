<div class="tab-pane fade" id="custom-v-pills-login" role="tabpanel" aria-labelledby="custom-v-pills-login-tab">
    <div class="row">
        <div class="col-lg-3">
            <div class="card border">
                <div class="card-body">
                    <h4> {{lang('Admin Panel')}}</h4>
                    <div class="card">
                        <img class="card-img-top img-fluid" src="@if(isset($general_setting['admin_login_background_url'])){{$general_setting['admin_login_background_url']}}@else {{asset('assets/images/small/img-1.jpg')}} @endif"
                             alt="Card image cap" id="admin_login_background_image">
                        <input class="form-control mb-2" type="file" name="admin_login_background" id="admin_login_background" required>
                        <p class="text-center">(1460px X 1080px)</p>
                        <span style="color: red;display: none;" id="admin_login_background_error"></span>
                        <div class="card-body">
                            <div class="text-end">
                                <input type="button" id="update_admin_login_background" class="btn btn-primary"
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
                    <h4>{{lang('User Panel')}}</h4>
                    <div class="card">
                        <img class="card-img-top img-fluid" src="@if(isset($general_setting['user_login_background_url'])){{$general_setting['user_login_background_url']}}@else {{asset('assets/images/small/img-1.jpg')}} @endif"
                             alt="Card image cap" id="user_login_background_image">
                        <input class="form-control mb-2" type="file" name="user_login_background" id="user_login_background" required>
                        <p class="text-center">(1460px X 1080px)</p>
                        <span style="color: red;display: none;" id="user_login_background_error"></span>
                        <div class="card-body">
                            <div class="text-end">
                                <input type="button" id="update_user_login_background" class="btn btn-primary"
                                       value="{{lang('Update')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>