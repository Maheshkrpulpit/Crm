<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThemeSetting extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','config'];

    public function language_detail()
    {
        return $this->belongsTo('\App\Models\Language','language','id');
    }
    
   
}
