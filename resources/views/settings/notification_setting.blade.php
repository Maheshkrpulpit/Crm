@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Session List</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-bordered align-middle table-nowrap mb-0">
                            <tbody>
                                <tr class="main_head tr-list_head">
                                    <td class="set_border_right">Sl No.</td>
                                    <td class="set_border_right">Module Name</td>
                                    <td class="set_border_right">Actions</td>
                                    <td class="set_border_right">Student</td>
                                    <td class="set_border_right">Parent/Guardian</td>
                                    <td class="set_border_right">Employee/Admin</td>
                                </tr>




                                <tr>

                                </tr>
                                <tr>
                                    <td class="set_border_right" rowspan="1">1</td>
                                    <td class="set_border_right" rowspan="1">Attendance</td>




                                    <td class="set_border_right">Late, Absent</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22463[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22463[enabled]"
                                            name="notification_settings[22463[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22464[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22464[enabled]"
                                            name="notification_settings[22464[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden" value="0"><input
                                            disabled="disabled" id="notification_settings_0[enabled]"
                                            name="notification_settings[0[enabled]]" type="checkbox" value="1">
                                    </td>
                                </tr>



                                <tr>

                                </tr>
                                <tr>
                                    <td class="set_border_right" rowspan="4">2</td>
                                    <td class="set_border_right" rowspan="4">Event</td>




                                    <td class="set_border_right">Event Create/Update</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22465[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22465[enabled]"
                                            name="notification_settings[22465[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22466[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22466[enabled]"
                                            name="notification_settings[22466[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22467[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22467[enabled]"
                                            name="notification_settings[22467[enabled]]" type="checkbox" value="1">
                                    </td>
                                </tr>




                                <tr>
                                    <td class="set_border_right">Examination</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22468[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22468[enabled]"
                                            name="notification_settings[22468[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22469[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22469[enabled]"
                                            name="notification_settings[22469[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                </tr>




                                <tr>
                                    <td class="set_border_right">Online Exam Schedule Publish/Cancel
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22498[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22498[enabled]"
                                            name="notification_settings[22498[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                </tr>




                                <tr>
                                    <td class="set_border_right">Online Exam Results Publish</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22499[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22499[enabled]"
                                            name="notification_settings[22499[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                </tr>



                                <tr>

                                </tr>
                                <tr>
                                    <td class="set_border_right" rowspan="2">3</td>
                                    <td class="set_border_right" rowspan="2">Finance</td>




                                    <td class="set_border_right">Fee Scheduled/Updated</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22470[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22470[enabled]"
                                            name="notification_settings[22470[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22471[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22471[enabled]"
                                            name="notification_settings[22471[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                </tr>




                                <tr>
                                    <td class="set_border_right">Collect fees</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22472[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22472[enabled]"
                                            name="notification_settings[22472[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22473[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22473[enabled]"
                                            name="notification_settings[22473[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                </tr>



                                <tr>

                                </tr>
                                <tr>
                                    <td class="set_border_right" rowspan="1">4</td>
                                    <td class="set_border_right" rowspan="1">Timetable</td>




                                    <td class="set_border_right">Swap, Cancel, Update</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22474[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22474[enabled]"
                                            name="notification_settings[22474[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22475[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22475[enabled]"
                                            name="notification_settings[22475[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22476[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22476[enabled]"
                                            name="notification_settings[22476[enabled]]" type="checkbox" value="1">
                                    </td>
                                </tr>



                                <tr>

                                </tr>
                                <tr>
                                    <td class="set_border_right" rowspan="1">5</td>
                                    <td class="set_border_right" rowspan="1">Gradebook</td>




                                    <td class="set_border_right">Report Publish</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22477[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22477[enabled]"
                                            name="notification_settings[22477[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22478[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22478[enabled]"
                                            name="notification_settings[22478[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                </tr>



                                <tr>

                                </tr>
                                <tr>
                                    <td class="set_border_right" rowspan="4">6</td>
                                    <td class="set_border_right" rowspan="4">HR</td>




                                    <td class="set_border_right">Manual credit pending</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22479[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22479[enabled]"
                                            name="notification_settings[22479[enabled]]" type="checkbox" value="1">
                                    </td>
                                </tr>




                                <tr>
                                    <td class="set_border_right">Leave Application</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22480[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22480[enabled]"
                                            name="notification_settings[22480[enabled]]" type="checkbox" value="1">
                                    </td>
                                </tr>




                                <tr>
                                    <td class="set_border_right">Leave approved/denied</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22481[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22481[enabled]"
                                            name="notification_settings[22481[enabled]]" type="checkbox" value="1">
                                    </td>
                                </tr>




                                <tr>
                                    <td class="set_border_right">Payslip Approved/Rejected</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22482[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22482[enabled]"
                                            name="notification_settings[22482[enabled]]" type="checkbox" value="1">
                                    </td>
                                </tr>



                                <tr>

                                </tr>
                                <tr>
                                    <td class="set_border_right" rowspan="1">7</td>
                                    <td class="set_border_right" rowspan="1">News</td>




                                    <td class="set_border_right">News Publish</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22483[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22483[enabled]"
                                            name="notification_settings[22483[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22484[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22484[enabled]"
                                            name="notification_settings[22484[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22485[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22485[enabled]"
                                            name="notification_settings[22485[enabled]]" type="checkbox" value="1">
                                    </td>
                                </tr>



                                <tr>

                                </tr>
                                <tr>
                                    <td class="set_border_right" rowspan="1">8</td>
                                    <td class="set_border_right" rowspan="1">Applicant Registration
                                    </td>




                                    <td class="set_border_right">Registration Application Submitted
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22486[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22486[enabled]"
                                            name="notification_settings[22486[enabled]]" type="checkbox" value="1">
                                    </td>
                                </tr>



                                <tr>

                                </tr>
                                <tr>
                                    <td class="set_border_right" rowspan="3">9</td>
                                    <td class="set_border_right" rowspan="3">Assignment</td>




                                    <td class="set_border_right">Create, Edit, Delete, Unassign</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22487[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22487[enabled]"
                                            name="notification_settings[22487[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                </tr>




                                <tr>
                                    <td class="set_border_right">Reject Accept</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22488[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22488[enabled]"
                                            name="notification_settings[22488[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22489[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22489[enabled]"
                                            name="notification_settings[22489[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                </tr>




                                <tr>
                                    <td class="set_border_right">Response Submitted</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22490[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22490[enabled]"
                                            name="notification_settings[22490[enabled]]" type="checkbox" value="1">
                                    </td>
                                </tr>



                                <tr>

                                </tr>
                                <tr>
                                    <td class="set_border_right" rowspan="1">10</td>
                                    <td class="set_border_right" rowspan="1">Discipline</td>




                                    <td class="set_border_right">Complaint Registered</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22491[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22491[enabled]"
                                            name="notification_settings[22491[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22492[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22492[enabled]"
                                            name="notification_settings[22492[enabled]]" type="checkbox" value="1">
                                    </td>
                                </tr>



                                <tr>

                                </tr>
                                <tr>
                                    <td class="set_border_right" rowspan="1">11</td>
                                    <td class="set_border_right" rowspan="1">Discussion</td>




                                    <td class="set_border_right">Post</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22493[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22493[enabled]"
                                            name="notification_settings[22493[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22494[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22494[enabled]"
                                            name="notification_settings[22494[enabled]]" type="checkbox" value="1">
                                    </td>
                                </tr>



                                <tr>

                                </tr>
                                <tr>
                                    <td class="set_border_right" rowspan="1">12</td>
                                    <td class="set_border_right" rowspan="1">Gallery</td>




                                    <td class="set_border_right">Publish</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22495[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22495[enabled]"
                                            name="notification_settings[22495[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22496[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22496[enabled]"
                                            name="notification_settings[22496[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22497[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22497[enabled]"
                                            name="notification_settings[22497[enabled]]" type="checkbox" value="1">
                                    </td>
                                </tr>



                                <tr>

                                </tr>
                                <tr>
                                    <td class="set_border_right" rowspan="1">13</td>
                                    <td class="set_border_right" rowspan="1">Placement</td>




                                    <td class="set_border_right">Publish</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22500[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22500[enabled]"
                                            name="notification_settings[22500[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                </tr>



                                <tr>

                                </tr>
                                <tr>
                                    <td class="set_border_right" rowspan="1">14</td>
                                    <td class="set_border_right" rowspan="1">Task</td>




                                    <td class="set_border_right">Task Assigned</td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22501[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22501[enabled]"
                                            name="notification_settings[22501[enabled]]" type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[0[enabled]]" type="hidden"
                                            value="0"><input disabled="disabled"
                                            id="notification_settings_0[enabled]" name="notification_settings[0[enabled]]"
                                            type="checkbox" value="1">
                                    </td>
                                    <td class="set_border_right">
                                        <input name="notification_settings[22502[enabled]]" type="hidden"
                                            value="0"><input checked="checked"
                                            id="notification_settings_22502[enabled]"
                                            name="notification_settings[22502[enabled]]" type="checkbox" value="1">
                                    </td>
                                </tr>



                            </tbody>
                        </table>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div><!-- end row -->



        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/pages/profile-setting.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
