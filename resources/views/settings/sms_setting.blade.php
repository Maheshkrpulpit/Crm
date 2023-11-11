@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="nav nav-pills flex-column nav-pills-tab custom-verti-nav-pills text-center"
                            role="tablist" aria-orientation="vertical">
                            <a class="nav-link active show" id="custom-v-pills-home-tab"
                                data-bs-toggle="pill" href="#custom-v-pills-home" role="tab"
                                aria-controls="custom-v-pills-home" aria-selected="true">

                                Clickatell Sms Gateway</a>
                            <a class="nav-link" id="custom-v-pills-Twilio-tab" data-bs-toggle="pill"
                                href="#custom-v-pills-Twilio" role="tab"
                                aria-controls="custom-v-pills-Twilio" aria-selected="false">

                                Twilio SMS Gateway</a>
                            <a class="nav-link" id="custom-v-pills-MSG91-tab" data-bs-toggle="pill"
                                href="#custom-v-pills-MSG91" role="tab"
                                aria-controls="custom-v-pills-MSG91" aria-selected="false">

                                MSG91</a>
                            <a class="nav-link" id="custom-v-pills-Text_local-tab"
                                data-bs-toggle="pill" href="#custom-v-pills-Text_local"
                                role="tab" aria-controls="custom-v-pills-Text_local"
                                aria-selected="false">

                                Text Local</a>
                            <a class="nav-link" id="custom-v-pills-SMS_Country-tab"
                                data-bs-toggle="pill" href="#custom-v-pills-SMS_Country"
                                role="tab" aria-controls="custom-v-pills-SMS_Country"
                                aria-selected="false">

                                SMS Country</a>
                            <a class="nav-link" id="custom-v-pills-Bulk_SMS-tab"
                                data-bs-toggle="pill" href="#custom-v-pills-Bulk_SMS" role="tab"
                                aria-controls="custom-v-pills-Bulk_SMS" aria-selected="false">

                                Bulk SMS</a>
                            <a class="nav-link" id="custom-v-pills-Mobi_Reach-tab"
                                data-bs-toggle="pill" href="#custom-v-pills-Mobi_Reach"
                                role="tab" aria-controls="custom-v-pills-Mobi_Reach"
                                aria-selected="false">

                                Mobi Reach</a>
                            <a class="nav-link" id="custom-v-pills-Nexmo-tab" data-bs-toggle="pill"
                                href="#custom-v-pills-Nexmo" role="tab"
                                aria-controls="custom-v-pills-Nexmo" aria-selected="false">

                                Nexmo</a>
                            <a class="nav-link" id="custom-v-pills-AfricasTalking-tab"
                                data-bs-toggle="pill" href="#custom-v-pills-AfricasTalking"
                                role="tab" aria-controls="custom-v-pills-AfricasTalking"
                                aria-selected="false">

                                AfricasTalking</a>
                            <a class="nav-link" id="custom-v-pills-SMS_Egypt-tab"
                                data-bs-toggle="pill" href="#custom-v-pills-SMS_Egypt"
                                role="tab" aria-controls="custom-v-pills-SMS_Egypt"
                                aria-selected="false">

                                SMS Egypt</a>
                            <a class="nav-link" id="custom-v-pills-Custom_SMS_Gateway-tab"
                                data-bs-toggle="pill" href="#custom-v-pills-Custom_SMS_Gateway" role="tab"
                                aria-controls="custom-v-pills-Custom_SMS_Gateway" aria-selected="false">

                                Custom SMS Gateway</a>
                        </div>
                        <hr>
                    </div> <!-- end col-->
                    <div class="col-lg-9">
                        <div class="tab-content text-muted mt-3 mt-lg-0">
                            <div class="tab-pane fade active show" id="custom-v-pills-home"
                                role="tabpanel" aria-labelledby="custom-v-pills-home-tab">
                                <div class="col-md-7">
                                    <form action="">
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="nameInput"
                                                    class="form-label">Clickatell
                                                    Username</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input autofocus="" type="text"
                                                    class="form-control" name="clickatell_user"
                                                    value="" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="websiteUrl"
                                                    class="form-label">Clickatell
                                                    Password</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="password" class="form-control"
                                                    name="clickatell_password" value=""
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="dateInput" class="form-label">Api
                                                    Key</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control"
                                                    name="clickatell_api_id" value=""
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="dateInput"
                                                    class="form-label">Status</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <select class="form-control"
                                                    name="clickatell_status" autocomplete="off">
                                                    <option value="" selected="selected">
                                                        Select
                                                    </option>
                                                    <option value="enabled">Enabled</option>
                                                    <option value="disabled">Disabled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5 text text-center disblock"
                                            style="margin: -108px 0px 0px 793px;">
                                            <a href="https://www.clickatell.com/"
                                                target="_blank"><img
                                                    src="https://demo.smart-school.in/backend/images/clickatell.png?1694156584">
                                                <p>https://www.clickatell.com</p>
                                            </a>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit"
                                                class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--end tab-pane-->
                            <div class="tab-pane fade" id="custom-v-pills-Twilio" role="tabpanel"
                                aria-labelledby="custom-v-pills-Twilio-tab">
                                <div class="col-md-7">
                                    <form action="">
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="nameInput" class="form-label">Twilio
                                                    Account SID</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input autofocus="" type="text"
                                                    class="form-control" name="clickatell_user"
                                                    value="" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="websiteUrl"
                                                    class="form-label">Authentication Token</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="password" class="form-control"
                                                    name="clickatell_password" value=""
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="dateInput"
                                                    class="form-label">Registered
                                                    Phone Number</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control"
                                                    name="clickatell_api_id" value=""
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="dateInput"
                                                    class="form-label">Status</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <select class="form-control"
                                                    name="clickatell_status" autocomplete="off">
                                                    <option value="" selected="selected">
                                                        Select
                                                    </option>
                                                    <option value="enabled">Enabled</option>
                                                    <option value="disabled">Disabled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5 text text-center disblock"
                                            style="margin: -108px 0px 0px 793px;">
                                            <a href="https://www.twilio.com/?v=t"
                                                target="_blank"><img
                                                    src="https://demo.smart-school.in/backend/images/twilio.png?1694156584">
                                                <p>https://www.twilio.com</p>
                                            </a>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit"
                                                class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--end tab-pane-->
                            <div class="tab-pane fade" id="custom-v-pills-MSG91" role="tabpanel"
                                aria-labelledby="custom-v-pills-MSG91-tab">
                                <form action="">
                                    <div class="col-md-7">
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="nameInput" class="form-label">Auth
                                                    Key</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input autofocus="" type="text"
                                                    class="form-control" name="clickatell_user"
                                                    value="" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="websiteUrl" class="form-label">Sender
                                                    ID</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control"
                                                    name="sender_ID" value=""
                                                    autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="dateInput"
                                                    class="form-label">Status</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <select class="form-control"
                                                    name="clickatell_status" autocomplete="off">
                                                    <option value="" selected="selected">
                                                        Select
                                                    </option>
                                                    <option value="enabled">Enabled</option>
                                                    <option value="disabled">Disabled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5 text text-center disblock"
                                            style="margin: -108px 0px 0px 793px;">
                                            <a href="https://msg91.com/" target="_blank"><img
                                                    src="https://demo.smart-school.in/backend/images/msg91.png?1694156584">
                                                <p>https://msg91.com</p>
                                            </a>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit"
                                                class="btn btn-primary">Save</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane fade" id="custom-v-pills-Text_local" role="tabpanel"
                            aria-labelledby="custom-v-pills-Text_local-tab">
                            <div class="col-md-7">
                                <form action="">
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="nameInput"
                                                class="form-label">Username</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input autofocus="" type="text"
                                                class="form-control" name="clickatell_user"
                                                value="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="websiteUrl"
                                                class="form-label">Hashkey</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="password" class="form-control"
                                                name="clickatell_password" value=""
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput" class="form-label">Sender
                                                ID</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                name="clickatell_api_id" value=""
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput"
                                                class="form-label">Status</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="clickatell_status"
                                                autocomplete="off">
                                                <option value="" selected="selected">
                                                    Select
                                                </option>
                                                <option value="enabled">Enabled</option>
                                                <option value="disabled">Disabled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text text-center disblock"
                                        style="margin: -108px 0px 0px 793px;">
                                        <a href="https://www.textlocal.in/" target="_blank"><img
                                                src="https://demo.smart-school.in/backend/images/textlocal.png?1694156584">
                                            <p>https://www.textlocal.in</p>
                                        </a>

                                    </div>

                                    <div class="text-end">
                                        <button type="submit"
                                            class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane fade" id="custom-v-pills-SMS_Country"
                            role="tabpanel" aria-labelledby="custom-v-pills-SMS_Country-tab">
                            <div class="col-md-7">
                                <form action="">
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="nameInput"
                                                class="form-label">Username</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input autofocus="" type="text"
                                                class="form-control" name="clickatell_user"
                                                value="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="websiteUrl" class="form-label">Auth
                                                Key</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="password" class="form-control"
                                                name="clickatell_password" value=""
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="websiteUrl"
                                                class="form-label">Authentication Token</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="password" class="form-control"
                                                name="clickatell_password" value=""
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput" class="form-label">Sender
                                                ID</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                name="clickatell_api_id" value=""
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput"
                                                class="form-label">Password</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="password" class="form-control"
                                                name="password" value=""
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput"
                                                class="form-label">Status</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="clickatell_status"
                                                autocomplete="off">
                                                <option value="" selected="selected">
                                                    Select
                                                </option>
                                                <option value="enabled">Enabled</option>
                                                <option value="disabled">Disabled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text text-center disblock"
                                        style="margin: -108px 0px 0px 793px;">
                                        <a href="https://www.textlocal.in/" target="_blank"><img
                                                src="https://demo.smart-school.in/backend/images/textlocal.png?1694156584">
                                            <p>https://www.textlocal.in</p>
                                        </a>

                                    </div>

                                    <div class="text-end">
                                        <button type="submit"
                                            class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane fade" id="custom-v-pills-Bulk_SMS" role="tabpanel"
                            aria-labelledby="custom-v-pills-Bulk_SMS-tab">
                            <div class="col-md-7">
                                <form action="">
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="nameInput"
                                                class="form-label">Username</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input autofocus="" type="text"
                                                class="form-control" name="clickatell_user"
                                                value="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="websiteUrl"
                                                class="form-label">Password</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="password" class="form-control"
                                                name="clickatell_password" value=""
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput"
                                                class="form-label">Status</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="clickatell_status"
                                                autocomplete="off">
                                                <option value="" selected="selected">
                                                    Select
                                                </option>
                                                <option value="enabled">Enabled</option>
                                                <option value="disabled">Disabled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text text-center disblock"
                                        style="margin: -108px 0px 0px 793px;">
                                        <a href="https://www.bulksms.com/" target="_blank"><img
                                                src="https://demo.smart-school.in/backend/images/bulk_sms.png?1694156584"
                                                class="img-responsive center-block">
                                            <p>https://www.bulksms.com/</p>
                                        </a>

                                    </div>

                                    <div class="text-end">
                                        <button type="submit"
                                            class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane fade" id="custom-v-pills-Mobi_Reach" role="tabpanel"
                            aria-labelledby="custom-v-pills-Mobi_Reach-tab">
                            <div class="col-md-7">
                                <form action="">
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="nameInput" class="form-label">Auth
                                                Key</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input autofocus="" type="text"
                                                class="form-control" name="clickatell_user"
                                                value="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="websiteUrl" class="form-label">Sender
                                                ID</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="password" class="form-control"
                                                name="clickatell_password" value=""
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput" class="form-label">Route
                                                ID</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                name="clickatell_api_id" value=""
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput"
                                                class="form-label">Status</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="clickatell_status"
                                                autocomplete="off">
                                                <option value="" selected="selected">
                                                    Select
                                                </option>
                                                <option value="enabled">Enabled</option>
                                                <option value="disabled">Disabled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text text-center disblock"
                                        style="margin: -108px 0px 0px 793px;">
                                        <a href="https://user.mobireach.com.bd/"
                                            target="_blank"><img
                                                src="https://demo.smart-school.in/backend/images/mobireach.jpg?1694160597">
                                            <p>https://user.mobireach.com.bd/</p>
                                        </a>

                                    </div>

                                    <div class="text-end">
                                        <button type="submit"
                                            class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane fade" id="custom-v-pills-Nexmo" role="tabpanel"
                            aria-labelledby="custom-v-pills-Nexmo-tab">
                            <div class="col-md-7">
                                <form action="">
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="nameInput" class="form-label">Nexmo Api
                                                Key</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input autofocus="" type="text"
                                                class="form-control" name="clickatell_user"
                                                value="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="websiteUrl" class="form-label">Nexmo Api
                                                Secret</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="password" class="form-control"
                                                name="clickatell_password" value=""
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput" class="form-label">Registered /
                                                From Number</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                name="clickatell_api_id" value=""
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput"
                                                class="form-label">Status</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="clickatell_status"
                                                autocomplete="off">
                                                <option value="" selected="selected">
                                                    Select
                                                </option>
                                                <option value="enabled">Enabled</option>
                                                <option value="disabled">Disabled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text text-center disblock"
                                        style="margin: -108px 0px 0px 793px;">
                                        <a href="https://dashboard.nexmo.com/sign-up"
                                            target="_blank"><img
                                                src="https://demo.smart-school.in/backend/images/nexmo.jpg?1694162156">
                                            <p>https://dashboard.nexmo.com/sign-up</p>
                                        </a>

                                    </div><br>

                                    <div class="text-end">
                                        <button type="submit"
                                            class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane fade" id="custom-v-pills-AfricasTalking"
                            role="tabpanel" aria-labelledby="custom-v-pills-AfricasTalking-tab">
                            <div class="col-md-7">
                                <form action="">
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="nameInput"
                                                class="form-label">Username</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input autofocus="" type="text"
                                                class="form-control" name="clickatell_user"
                                                value="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="websiteUrl" class="form-label">Api
                                                Key</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="password" class="form-control"
                                                name="clickatell_password" value=""
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput" class="form-label">Short
                                                Code</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                name="clickatell_api_id" value=""
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput"
                                                class="form-label">Status</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="clickatell_status"
                                                autocomplete="off">
                                                <option value="" selected="selected">
                                                    Select
                                                </option>
                                                <option value="enabled">Enabled</option>
                                                <option value="disabled">Disabled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text text-center disblock"
                                        style="margin: -108px 0px 0px 793px;">
                                        <a href="https://africastalking.com/" target="_blank"><img
                                                src="https://demo.smart-school.in/backend/images/africastalking.png?1694162156">
                                            <p>https://africastalking.com/</p>
                                        </a>

                                    </div><br>

                                    <div class="text-end">
                                        <button type="submit"
                                            class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane fade" id="custom-v-pills-SMS_Egypt" role="tabpanel"
                            aria-labelledby="custom-v-pills-SMS_Egypt-tab">
                            <div class="col-md-7">
                                <form action="">
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="nameInput"
                                                class="form-label">Username</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input autofocus="" type="text"
                                                class="form-control" name="clickatell_user"
                                                value="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="websiteUrl"
                                                class="form-label">Password</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="password" class="form-control"
                                                name="clickatell_password" value=""
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput" class="form-label">Sender
                                                ID</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control"
                                                name="clickatell_api_id" value=""
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput" class="form-label">Type</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="smseg_type"
                                                autocomplete="off">
                                                <option value="">
                                                    Select </option>
                                                <option
                                                    value="https://smssmartegypt.com/sms/api/?">
                                                    Local SMS </option>
                                                <option
                                                    value="https://smssmartegypt.com/sms/api/InterAPI?">
                                                    International SMS </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput"
                                                class="form-label">Status</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="clickatell_status"
                                                autocomplete="off">
                                                <option value="" selected="selected">
                                                    Select
                                                </option>
                                                <option value="enabled">Enabled</option>
                                                <option value="disabled">Disabled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text text-center disblock"
                                        style="margin: -233px 0px 0px 793px;">
                                        <a href="https://smseg.com/" target="_blank"><img
                                                src="https://demo.smart-school.in/backend/images/smseg.png?1694162156">
                                            <p>https://smseg.com/</p>
                                        </a>

                                    </div>

                                    <div class="text-end">
                                        <button type="submit"
                                            class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane fade" id="custom-v-pills-Custom_SMS_Gateway" role="tabpanel"
                            aria-labelledby="custom-v-pills-Custom_SMS_Gateway-tab">
                            <div class="col-md-7">
                                <form action="">
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="nameInput"
                                                class="form-label">Gateway Name</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <input autofocus="" type="text"
                                                class="form-control" name="clickatell_user"
                                                value="" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="dateInput"
                                                class="form-label">Status</label>
                                        </div>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="clickatell_status"
                                                autocomplete="off">
                                                <option value="" selected="selected">
                                                    Select
                                                </option>
                                                <option value="enabled">Enabled</option>
                                                <option value="disabled">Disabled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5 text text-center disblock"
                                        style="margin: -84px 0px 0px 793px;">
                                        <a href=""><img src="https://demo.smart-school.in/backend/images/custom-sms.png?1694162156"></a>

                                    </div>

                                    <div class="text-end">
                                        <button type="submit"
                                            class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end tab-pane-->
                    </div>
                </div> <!-- end col-->
            </div> <!-- end row-->
        </div><!-- end card-body -->
    </div>
    <!--end card-->
</div>





@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/pages/profile-setting.init.js') }}"></script>
        <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection