<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionReferenceId extends Model
{
    use HasFactory;

    protected $fillable=['trans_ref_id'];
}
