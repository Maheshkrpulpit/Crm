<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class GeneralSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['school_name', 'school_code', 'phone', 'email', 'address', 'session', 'session_start_month', 'date_format', 'timezone', 'start_day_of_week', 'currency_format', 'base_url', 'file_upload_path'];

    const CREATED_AT = "created_at";

}
