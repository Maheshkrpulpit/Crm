<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Package extends Model
{
 
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'amount',
        'comission',
        'brand_id',
        'status'
        
    ];
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
