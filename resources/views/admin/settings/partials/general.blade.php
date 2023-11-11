<div class="tab-pane fade active show" id="custom-v-pills-General_Setting" role="tabpanel"
     aria-labelledby="custom-v-pills-General_Setting-tab">
    <div class="box box-primary">

        <div class="card-header border-0">
            <h5 class="box-title titlefix"><i class="fa fa-gear"></i>
                {{lang('General Setting')}}</h5>
            <div class="border mt-3 border-dashed"></div>
        </div>
        <br>
        <form action="{{route('settings.general_save')}}" method="POST">
            @csrf
            <div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="mb-3">
                            <label for="cleave-date" class="form-label">{{lang('Bussiness Name')}}</label>
                            <input type="text" class="form-control" placeholder="{{lang('Bussiness Name')}}"
                                   value="@if (isset($general_setting['school_name'])) {{$general_setting['school_name']}} @endif"
                                   id="school_name" name="school_name" required>
                        </div>

                    </div><!-- end col -->
                    <div class="col-xl-4">
                        <div class="mb-3">
                            <label for="cleave-date" class="form-label">{{lang('Footer Text')}}</label>
                            <input type="text" class="form-control" placeholder="{{lang('Footer Text')}}"
                                   value="@if (isset($general_setting['school_code'])) {{$general_setting['school_code']}} @endif"
                                   id="school_code" name="school_code" required>
                        </div>

                    </div><!-- end col -->

                    <div class="col-xl-4">
                        <div class="mb-3">
                            <label for="cleave-date-format" class="form-label">{{lang('Phone')}}</label>
                            <input type="tel" class="form-control" placeholder="{{lang('Phone')}}"
                                   value="@if (isset($general_setting['school_phone_number'])) {{$general_setting['school_phone_number']}} @endif"
                                   id="school_phone_number" name="school_phone_number" required>
                        </div>
                    </div><!-- end col -->
                    <div class="col-xl-4">
                        <div class="mb-3">
                            <label for="cleave-email" class="form-label">{{lang('Email')}}</label>
                            <input type="email" class="form-control"
                                   value="@if (isset($general_setting['school_email'])) {{$general_setting['school_email']}} @endif"
                                   placeholder="{{lang('Email')}}" id="school_email" name="school_email">
                        </div>

                    </div><!-- end col -->
                    <div class="col-xl-8">
                        <div class="mb-3">
                            <label for="cleave-date" class="form-label">{{lang('Address')}}</label>
                            <textarea class="form-control" id="school_address" name="school_address" rows="1" required>@if (isset($general_setting['school_address'])){{$general_setting['school_address']}}@endif</textarea>
                        </div>

                    </div><!-- end col -->
                </div><!-- end row -->
            </div>
            <div class="border mt-3 border-dashed"></div>
            <div class="mt-4">
                <h6 class="mb-3 fs-14 text-muted">{{lang('Date Time')}}</h6>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="mb-3">
                            <label for="choices-single-default"
                                   class="form-label text-muted">{{lang('Date Format')}}</label>
                            <select id="sch_date_format" name="sch_date_format" class=" form-control " data-choices
                                    name="choices-single-default" id="choices-single-default" required>
                                @foreach (get_date_formates() as $key => $formate)
                                    <option value="{{$key}}"
                                    @if (isset($general_setting['sch_date_format'])) @if ($general_setting['sch_date_format'] == $key)
                                        {{'selected'}} @endif
                                            @endif
                                    >{{$formate}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div><!-- end col -->

                    <div class="col-xl-4">
                        <div class="mb-3">
                            <label for="choices-single-default"
                                   class="form-label text-muted">{{lang('Timezone')}}</label>
                            <select id="sch_timezone" name="sch_timezone" class=" form-control " data-choices
                                    name="choices-single-default" id="choices-single-default" required>
                                @foreach (get_timezones() as $key => $timezone)
                                    <option value="{{$key}}"
                                    @if (isset($general_setting['sch_timezone'])) @if ($general_setting['sch_timezone'] == $key)
                                        {{'selected'}} @endif
                                            @endif
                                    >{{$timezone}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="mb-3">
                            <label for="choices-single-default"
                                   class="form-label text-muted">{{lang('Start Day Of Week')}}</label>
                            <select id="sch_start_week" name="sch_start_week" class=" form-control " data-choices
                                    name="choices-single-default" id="choices-single-default" required>
                                @foreach (get_week_days() as $week_day)
                                    <option value="{{$week_day}}"
                                    @if (isset($general_setting['sch_start_week'])) @if ($general_setting['sch_start_week'] == $week_day)
                                        {{'selected'}} @endif
                                            @endif
                                    >{{$week_day}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- end col -->
                </div><!-- end row -->
            </div>

            <div class="border mt-3 border-dashed"></div>

            <div class="mt-4">
                <h5 class="fs-14 mb-3 text-muted">{{lang('Currency')}}</h5>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label for="choices-single-default"
                                   class="form-label text-muted">{{lang('Currency Formate')}}</label>
                            <select id="currency_format" name="currency_format" class=" form-control " data-choices
                                    name="choices-single-default" id="choices-single-default" required>
                                @foreach (get_currency_formates() as $key => $formate)
                                    <option value="{{$key}}"
                                    @if (isset($general_setting['currency_format'])) @if ($general_setting['currency_format'] == $key)
                                        {{'selected'}} @endif
                                            @endif
                                    >{{$formate}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div><!-- end row -->
                <div class="border mt-3 border-dashed"></div>

            </div><!-- end row -->
            <div class="offcanvas-footer border-top p-3 text-center">
                <div class="col-lg-12">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">{{lang('Submit')}}
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
