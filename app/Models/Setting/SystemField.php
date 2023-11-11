<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemField extends Model
{
    use HasFactory;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'label',
        'type',
        'validation',
        'values',
        'grid',
        'order',
        'show_on_table',
        'attributes',
        'status'
    ];

    public function field_types()
    {
        return $this->belongsTo(FieldType::class);
    }
}
