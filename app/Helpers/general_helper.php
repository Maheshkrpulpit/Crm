<?php

use App\Models\Student;
use App\Models\Language;
use App\Models\Master\Sclass;
use App\Models\GeneralSetting;
use App\Models\Setting\SystemField;
use App\Models\Setting\FieldType;
use App\Models\Setting\State;
use App\Models\Master\ClassSection;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



if (!function_exists('getFormattedPermissions')) {
    /**
     * @return string
     */
    function getFormattedPermissions(){
        // Define a cache key
        $cacheKey = config('constants.cache_keys.formatted_permission_table');
        Cache::forget($cacheKey);
        // Check if data is already cached
        if (Cache::has($cacheKey)) {
            // Retrieve cached data
            $formattedPermissions = Cache::get($cacheKey);
        } else {
            $permissions = Permission::orderBy('name')->get();
            // Group permissions by the first part of the name (before the dot)
            $groupedPermissions = $permissions->groupBy(function ($permission) {
                $parts = explode('.', $permission->name);

                // Group by the first part of the name
                return $parts[0]; 
            });

            // Transform the grouped data into an array of permissions for each group with the first part removed
            $formattedPermissions = $groupedPermissions->map(function ($group) {
                return $group->pluck('name','id')->map(function ($name) {
                    $parts = explode('.', $name);
                    return end($parts); // Remove the first part and keep the rest
                })->toArray();
            })->toArray();

            // Cache the formatted permissions data for lifetime
            Cache::forever($cacheKey, $formattedPermissions);
        }
        return $formattedPermissions;
    }

}



function getAuthUserName($user)
{
    $name = $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name;
    return ucfirst($name);
}

function curlGet($curlUrl)
{
    // Prepare new cURL resource
    $crl = curl_init($curlUrl);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($crl, CURLINFO_HEADER_OUT, true);

    // Set HTTP Header for POST request
    curl_setopt($crl, CURLOPT_HTTPHEADER, array());

    // Submit the POST request
    $result = curl_exec($crl);
    if ($result === false) {
        curl_close($crl);
        return false;
    } else {
        curl_close($crl);
        return (array)json_decode($result);
    }
    // Close cURL session handle
}

function curlGetWithHeader($curlUrl, $header = '')
{
    // Prepare new cURL resource
    $crl = curl_init($curlUrl);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($crl, CURLINFO_HEADER_OUT, true);

    // Set HTTP Header for POST request
    if ($header)
        curl_setopt($crl, CURLOPT_HTTPHEADER, $header);

    // Submit the POST request
    $result = curl_exec($crl);
    if ($result === false) {
        curl_close($crl);
        return false;
    } else {
        curl_close($crl);
        return (array)json_decode($result);
    }
    // Close cURL session handle
}

function getSubscriptionPaymentStatusFromCode($payment_status)
{
    switch ($payment_status) {
        case "1":
            $response = '<span class="badge badge-pill badge-success">Completed</span>';
            break;
        case "2":
            $response = '<span class="badge badge-pill badge-danger">Failed</span>';
            break;

        default:
            $response = '<span class="badge badge-pill badge-warning">Pending</span>';
            break;
    }
    return $response;
}

function getSubscriptionEmailCreditStatusFromCode($credit_status)
{
    switch ($credit_status) {
        case "1":
            $response = '<span class="badge badge-pill badge-success">Added</span>';
            break;

        default:
            $response = '<span class="badge badge-pill badge-danger">Not Added</span>';
            break;
    }
    return $response;
}

function getDataFromXElasticEmailApiKey($elastic_email_id)
{
    $curlUrl = 'https://api.elasticemail.com/v4/subaccounts/' . urlencode($elastic_email_id);
    $header = array(
        'X-ElasticEmail-ApiKey: ' . env('X_ELASTIC_EMAIL_API_KEY')
    );
    $urlParams = array();
    $curlUrl = $curlUrl . '?' . http_build_query($urlParams);
    $curlResponse = curlGetWithHeader($header, $curlUrl);
    if ($curlResponse && !empty($curlResponse)) {
        return $curlResponse;
    }
    return false;
}

function getRoleName($role_id)
{
    $rolesArray = array("1" => "Admin", "2" => "Recruiter", "3" => "Candidate");
    return $rolesArray[$role_id];
}

function getCountryData($field, $country_id)
{
    $country = DB::table('countries')
        ->select("$field")
        ->where('id', $country_id)
        ->first();
    return $country ? $country->$field : '';
}

function getYesNoBadge($val)
{
    if ($val)
        return '<span class="inline-flex rounded-full items-center my-1 py-0.5 pl-2.5 pr-2.5 text-sm font-medium bg-indigo-100 text-indigo-700 span-green">Yes</span>';
    else
        return '<span class="inline-flex rounded-full items-center my-1 py-0.5 pl-2.5 pr-2.5 text-sm font-medium bg-indigo-100 text-indigo-700 span-red">No</span>';
}

function getFileName($uuid)
{
    $row = DB::table('uploads')
        ->select("file_name")
        ->where('id', $uuid)
        ->first();
    return $row ? $row->file_name : '';
}

function getFileUrl($uuid)
{
    $fileUrl = '';
    $row = DB::table('uploads')
        ->select("file_name", "file_path")
        ->where('id', $uuid)
        ->first();
    if ($row) {
        $path = storage_path() . '/app/' . $row->file_path . '/' . $row->file_name;
        // what kind of image file is that?
        $contentType = File::mimeType("$path"); //echo $contentType;die;
        // read file content
        $fileUrl = file_get_contents($path);
        // here you tell the browser what kind of image is that e.g. jpeg,png,gif...
        header("Content-Type: $contentType");
    }
    echo $fileUrl;
}

function removeUnwantedPostFields($post)
{
    unset($post['_method']);
    unset($post['_token']);
    return $post;
}


function makeAndStoreAvatarFromBase64($data)
{
    $image_array_1 = explode(";", $data);
    $image_array_2 = explode(",", $image_array_1[1]);
    $data = base64_decode($image_array_2[1]);
    $imageName = uniqid() . time() . '.png'; //echo storage_path().'/app/public/avatars/'.$imageName;die;
    if (Storage::disk('local')->put('public/avatars/' . $imageName, $data, 'public')) {
        // if($oldImg){
        //   Storage::delete('/public/avatars/'.$oldImg);
        // }
        return $imageName;
    } else {
        return false;
    }
}

function saveSystemFiles($file, $oldFileName)
{

    // Get filename with the extension
    $filenameWithExt = $file->getClientOriginalName();
    //Get just filename
    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    // Get just ext
    $extension = $file->getClientOriginalExtension();
    // Filename to store
    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
    // Upload Image
    $path = $file->storeAs('public/system_files', $fileNameToStore);

    if ($oldFileName)
        Storage::delete('/public/system_files/' . $oldFileName);

    return $fileNameToStore;
}

function showAvatar($imageName)
{
    $avatar = asset('themes/front/images/placeholder-user.png');
    if (is_file(storage_path() . '/app/public/avatars/' . $imageName)) {
        $avatar = asset('storage/avatars/' . $imageName);
    }
    return $avatar;
}

function getStudentId($user_id)
{
    $row = DB::table('students')
        ->select("id")
        ->where('user_id', $user_id)
        ->first();
    return $row ? $row->id : '';
}

function getSubjectsFromCourse($course_id, $subject_type)
{
    $course = DB::table('courses')
        ->where('id', $course_id)
        ->first();
    $subjectIds = explode(",", $course->subjects);
    $subjects = Subject::select("id", DB::raw("CONCAT(subjects.name, ' (' ,subjects.code, ')') as name"))
        ->where('subject_type', $subject_type)
        ->whereIn('id', $subjectIds)
        ->orderBy('name')
        ->get()
        ->pluck('name', 'id');
    if ($subjects) {
        $subjects = $subjects->toArray();
    } else {
        $subjects = [];
    }
    return $subjects;
}

function getAllSubjectsFromCourse($course_id)
{
    $course = DB::table('courses')
        ->where('id', $course_id)
        ->first();
    $subjectIds = explode(",", $course->subjects);
    $subjects = Subject::select("id", DB::raw("CONCAT(subjects.name, ' (' ,subjects.code, ')') as name"))
        ->whereIn('id', $subjectIds)
        ->orderBy('name')
        ->get()
        ->pluck('name', 'id');
    if ($subjects) {
        $subjects = $subjects->toArray();
    } else {
        $subjects = [];
    }
    return $subjects;
}

function getCollegeCourseSubjectRow($collegeId, $courseId, $subjectId)
{
    return DB::table('college_course_subjects')->where(["college_id" => $collegeId, "course_id" => $courseId, "subject_id" => $subjectId])->first();
}

function get_all_sessions_list()
{
    return SessionSetting::select('id', 'session')->where('status', 1)->orderBy('session', 'desc')->get();
}

function get_saved_session()
{
    if (Session::has('global_session_year')) {
        return Session::get('global_session_year');
    } else {
        $session = DB::table('session_settings')->select('id', 'session')->where('session_year', date('Y'))->where('status', 1)->first();
        if (isset($session->id)) :
            session(['global_session_year' => $session->id]);
        endif;
        return $session->id ?? '';
    }
}

function get_program_type_examination_form_openings($where)
{
    return DB::table('program_type_examination_form_openings')->where($where)->first();
}

function check_user_have_role($role)
{

    if (auth()->user()->id) :

        $roles = auth()->user()->getRoleNames()->toArray();


        if (in_array($role, $roles)) :
            return true;
        endif;

        return false;
    endif;
}

function user_has_all_permissions($permissions)
{


    if (auth()->user()->id) :

        if (is_super_admin()) :
            return true;
        endif;

        $response = true;

        $userPermissions = auth()->user()->getPermissionsViaRoles()->pluck('name')->toArray();


        foreach ($permissions as $permission) :

            if (!in_array($permission, $userPermissions)) :

                $response = false;
                break;

            endif;

        endforeach;

        return $response;

    endif;
}

function user_has_any_permission($permissions)
{

    if (auth()->user()->id) :

        if (is_super_admin()) :
            return true;
        endif;

        if (!count($permissions)) :
            return true;

        endif;

        $response = false;

        $userPermissions = auth()->user()->getPermissionsViaRoles()->pluck('name')->toArray();

        //echo '<pre>';print_r($userPermissions);die;

        foreach ($permissions as $permission) :

            if (in_array($permission, $userPermissions)) :

                $response = true;
                break;

            endif;

        endforeach;

        return $response;

    endif;
}

function is_super_admin()
{
    $userRoles = auth()->user()->getRoleNames()->toArray();

    if (in_array('superadmin', $userRoles)) :
        return true;


    endif;
}


function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}

function initials($str)
{
    $ret = '';
    foreach (explode(' ', $str) as $word)
        $ret .= strtoupper($word[0]);
    return $ret;
}

function get_selected_program()
{
    if (Session::has('current_program_type')) {
        return Session::get('current_program_type');
    } else {


        return '';
    }
}

function get_timezones(): array
{
    return [
        'Pacific/Midway' => "(GMT-11:00) Midway Island",
        'US/Samoa' => "(GMT-11:00) Samoa",
        'US/Hawaii' => "(GMT-10:00) Hawaii",
        'US/Alaska' => "(GMT-09:00) Alaska",
        'US/Pacific' => "(GMT-08:00) Pacific Time (US &amp; Canada)",
        'America/Tijuana' => "(GMT-08:00) Tijuana",
        'US/Arizona' => "(GMT-07:00) Arizona",
        'US/Mountain' => "(GMT-07:00) Mountain Time (US &amp; Canada)",
        'America/Chihuahua' => "(GMT-07:00) Chihuahua",
        'America/Mazatlan' => "(GMT-07:00) Mazatlan",
        'America/Mexico_City' => "(GMT-06:00) Mexico City",
        'America/Monterrey' => "(GMT-06:00) Monterrey",
        'Canada/Saskatchewan' => "(GMT-06:00) Saskatchewan",
        'US/Central' => "(GMT-06:00) Central Time (US &amp; Canada)",
        'US/Eastern' => "(GMT-05:00) Eastern Time (US &amp; Canada)",
        'US/East-Indiana' => "(GMT-05:00) Indiana (East)",
        'America/Bogota' => "(GMT-05:00) Bogota",
        'America/Lima' => "(GMT-05:00) Lima",
        'America/Caracas' => "(GMT-04:30) Caracas",
        'Canada/Atlantic' => "(GMT-04:00) Atlantic Time (Canada)",
        'America/La_Paz' => "(GMT-04:00) La Paz",
        'America/Santiago' => "(GMT-04:00) Santiago",
        'Canada/Newfoundland' => "(GMT-03:30) Newfoundland",
        'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
        'Greenland' => "(GMT-03:00) Greenland",
        'Atlantic/Stanley' => "(GMT-02:00) Stanley",
        'Atlantic/Azores' => "(GMT-01:00) Azores",
        'Atlantic/Cape_Verde' => "(GMT-01:00) Cape Verde Is.",
        'Africa/Casablanca' => "(GMT) Casablanca",
        'Europe/Dublin' => "(GMT) Dublin",
        'Europe/Lisbon' => "(GMT) Lisbon",
        'Europe/London' => "(GMT) London",
        'Africa/Monrovia' => "(GMT) Monrovia",
        'Europe/Amsterdam' => "(GMT+01:00) Amsterdam",
        'Europe/Belgrade' => "(GMT+01:00) Belgrade",
        'Europe/Berlin' => "(GMT+01:00) Berlin",
        'Europe/Bratislava' => "(GMT+01:00) Bratislava",
        'Europe/Brussels' => "(GMT+01:00) Brussels",
        'Europe/Budapest' => "(GMT+01:00) Budapest",
        'Europe/Copenhagen' => "(GMT+01:00) Copenhagen",
        'Europe/Ljubljana' => "(GMT+01:00) Ljubljana",
        'Europe/Madrid' => "(GMT+01:00) Madrid",
        'Europe/Paris' => "(GMT+01:00) Paris",
        'Europe/Prague' => "(GMT+01:00) Prague",
        'Europe/Rome' => "(GMT+01:00) Rome",
        'Europe/Sarajevo' => "(GMT+01:00) Sarajevo",
        'Europe/Skopje' => "(GMT+01:00) Skopje",
        'Europe/Stockholm' => "(GMT+01:00) Stockholm",
        'Europe/Vienna' => "(GMT+01:00) Vienna",
        'Europe/Warsaw' => "(GMT+01:00) Warsaw",
        'Europe/Zagreb' => "(GMT+01:00) Zagreb",
        'Europe/Athens' => "(GMT+02:00) Athens",
        'Europe/Bucharest' => "(GMT+02:00) Bucharest",
        'Africa/Cairo' => "(GMT+02:00) Cairo",
        'Africa/Harare' => "(GMT+02:00) Harare",
        'Europe/Helsinki' => "(GMT+02:00) Helsinki",
        'Europe/Istanbul' => "(GMT+02:00) Istanbul",
        'Asia/Jerusalem' => "(GMT+02:00) Jerusalem",
        'Europe/Kiev' => "(GMT+02:00) Kyiv",
        'Europe/Minsk' => "(GMT+02:00) Minsk",
        'Europe/Riga' => "(GMT+02:00) Riga",
        'Europe/Sofia' => "(GMT+02:00) Sofia",
        'Europe/Tallinn' => "(GMT+02:00) Tallinn",
        'Europe/Vilnius' => "(GMT+02:00) Vilnius",
        'Asia/Baghdad' => "(GMT+03:00) Baghdad",
        'Asia/Kuwait' => "(GMT+03:00) Kuwait",
        'Africa/Nairobi' => "(GMT+03:00) Nairobi",
        'Asia/Riyadh' => "(GMT+03:00) Riyadh",
        'Europe/Moscow' => "(GMT+03:00) Moscow",
        'Asia/Tehran' => "(GMT+03:30) Tehran",
        'Asia/Baku' => "(GMT+04:00) Baku",
        'Europe/Volgograd' => "(GMT+04:00) Volgograd",
        'Asia/Muscat' => "(GMT+04:00) Muscat",
        'Asia/Tbilisi' => "(GMT+04:00) Tbilisi",
        'Asia/Yerevan' => "(GMT+04:00) Yerevan",
        'Asia/Kabul' => "(GMT+04:30) Kabul",
        'Asia/Karachi' => "(GMT+05:00) Karachi",
        'Asia/Tashkent' => "(GMT+05:00) Tashkent",
        'Asia/Kolkata' => "(GMT+05:30) Kolkata",
        'Asia/Kathmandu' => "(GMT+05:45) Kathmandu",
        'Asia/Yekaterinburg' => "(GMT+06:00) Ekaterinburg",
        'Asia/Almaty' => "(GMT+06:00) Almaty",
        'Asia/Dhaka' => "(GMT+06:00) Dhaka",
        'Asia/Novosibirsk' => "(GMT+07:00) Novosibirsk",
        'Asia/Bangkok' => "(GMT+07:00) Bangkok",
        'Asia/Jakarta' => "(GMT+07:00) Jakarta",
        'Asia/Krasnoyarsk' => "(GMT+08:00) Krasnoyarsk",
        'Asia/Chongqing' => "(GMT+08:00) Chongqing",
        'Asia/Hong_Kong' => "(GMT+08:00) Hong Kong",
        'Asia/Kuala_Lumpur' => "(GMT+08:00) Kuala Lumpur",
        'Australia/Perth' => "(GMT+08:00) Perth",
        'Asia/Singapore' => "(GMT+08:00) Singapore",
        'Asia/Taipei' => "(GMT+08:00) Taipei",
        'Asia/Ulaanbaatar' => "(GMT+08:00) Ulaan Bataar",
        'Asia/Urumqi' => "(GMT+08:00) Urumqi",
        'Asia/Irkutsk' => "(GMT+09:00) Irkutsk",
        'Asia/Seoul' => "(GMT+09:00) Seoul",
        'Asia/Tokyo' => "(GMT+09:00) Tokyo",
        'Australia/Adelaide' => "(GMT+09:30) Adelaide",
        'Australia/Darwin' => "(GMT+09:30) Darwin",
        'Asia/Yakutsk' => "(GMT+10:00) Yakutsk",
        'Australia/Brisbane' => "(GMT+10:00) Brisbane",
        'Australia/Canberra' => "(GMT+10:00) Canberra",
        'Pacific/Guam' => "(GMT+10:00) Guam",
        'Australia/Hobart' => "(GMT+10:00) Hobart",
        'Australia/Melbourne' => "(GMT+10:00) Melbourne",
        'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
        'Australia/Sydney' => "(GMT+10:00) Sydney",
        'Asia/Vladivostok' => "(GMT+11:00) Vladivostok",
        'Asia/Magadan' => "(GMT+12:00) Magadan",
        'Pacific/Auckland' => "(GMT+12:00) Auckland",
        'Pacific/Fiji' => "(GMT+12:00) Fiji",
    ];
}

function get_months(): array
{
    return ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',];
}

function get_week_days(): array
{
    return ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
}

function get_currency_formates(): array
{
    return [
        "####.##" => '12345678.00',
        "#,###.##" => '12,345,678.00',
        "#,##,###.##" => '1,23,45,678.00',
        "#.###.##" => '12.345.678.00',
        "#.###,##" => '12.345.678,00',
        "#  =###.##" => '12 345 678.00 (Not For RTL)'
    ];
}

function get_date_formates(): array
{
    return [
        "d-m-Y" => 'dd-mm-yyyy',
        "d-M-Y" => 'dd-mmm-yyyy',
        "d/m/Y" => 'dd/mm/yyyy',
        "d.m.Y" => 'dd.mm.yyyy',
        "m-d-Y" => 'mm-dd-yyyy',
        "m/d/Y" => 'mm/dd/yyyy',
        "m.d.Y" => 'mm.dd.yyyy',
        "Y/m/d" => 'yyyy/mm/dd',
    ];
}

// function get_academic_years()
// {
//     return AcademicYear::where('status', 1)->get();
// }

function defaultLanguage()
{
    return 'en';
}

function set_general_setting($key, $value): bool
{
    if ($key != null && $value != null) {
        if (GeneralSetting::where("setting_key", $key)->count() > 0) {
            $general_setting = GeneralSetting::where("setting_key", $key)->get()[0];
            $general_setting->setting_value = $value;
            $general_setting->update();
        } else {
            GeneralSetting::insert(["setting_key" => $key, "setting_value" => $value]);
        }
        return true;
    }
    return false;
}

function get_general_setting($key): string
{
    $data = GeneralSetting::select('setting_value')->where('setting_key', $key)->get();
    if (count($data) > 0) {
        return $data[0]->setting_value;
    }
    return '';
}

// function get_current_year()
// {
//     return AcademicYear::select('name')->where('id', get_general_setting('academic_year_id'))->first();
// }

function get_time($timezone = 'Asia/Kolkata')
{
    if ($timezone == "" || $timezone == null) {
        $timezone = 'Asia/Kolkata';
    }
    $date = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now(), 'UTC')
        ->setTimezone($timezone);
    return date('h:i A', strtotime($date));
}

function get_field_types(): array
{
    return [
        'text',
        'number',
        'checkbox',
        'radio',
        'textarea',
        'select',
        'file',
        'multiple',
    ];
}

function get_states(): Collection
{
    return State::all();
}

function get_sections($class_id = null)
{
    $data = ClassSection::with('section')->where('class_id', $class_id)->get();
    if (count($data) > 0) {
        $section = [];
        foreach ($data as $value){
            $section[] = $value->section;
        }
        return $section;
    }
    return null;
}

function get_system_fields($status = null, $field_name = '',$except_fields = []): \Illuminate\Database\Eloquent\Collection
{
    if ($status !== null) {
        $query = SystemField::where('status', $status)->orderBy('id', 'asc');
        if($field_name != null && $field_name != ""){
            $query->where('name',$field_name);
        }
        if($except_fields != null && count($except_fields) > 0 ){
            $query->whereNotIn('name',$except_fields);
        }
        return $query->get();
    }else {
        return SystemField::orderBy('id')->get();
    }
}

// function get_system_fields($status = null, $field_name = '', $except_fields = []): \Illuminate\Database\Eloquent\Collection
// {
//     if ($status !== null) {
//         $query = SystemField::select('system_fields.*')
//             ->join('field_types', 'system_fields.type', '=', 'field_types.id')
//             ->where('system_fields.status', $status)
//             ->orderBy('system_fields.id');

//         if ($field_name != null && $field_name != "") {
//             $query->where('system_fields.name', $field_name);
//         }

//         if ($except_fields != null && count($except_fields) > 0) {
//             $query->whereNotIn('system_fields.name', $except_fields);
//         }

//         return $query->get();
//     } else {
//         return SystemField::orderBy('id')->get();
//     }
// }


function get_student_list($class_id = null, $section_id = null){
    $cond = null;
    if($class_id != null){
        $cond['class_id'] = $class_id;
    }
    if($section_id != null){
        $cond['section_id'] = $section_id;
    }
    if($cond != null){
        return Student::where($cond)->get();
    }
    return Student::all();
}
