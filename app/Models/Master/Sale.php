<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Setting\State;
use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sale extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile_number',
        'alternate_mobile_number',
        'social_security_number',
        'date_of_birth',
        'prospect',
        'source',
        'email',
        'order_status',
        'state_id',
        'zip_code',
        'previous_address',
        'street_address',
        'full_address',
        'city',
        'screen_shot',
        'brand_id',
        'user_id',
        'package_id',
        'audio'
        
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function packages()
    {
        return $this->belongsTo(Package::class,'package_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
