<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable=['user_id','api_id','tx_ref','api_ref','type','item_id','ip','amount','charged_amount','currency','status','response'];

    





}
