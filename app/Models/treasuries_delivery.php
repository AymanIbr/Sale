<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class treasuries_delivery extends Model
{
    use HasFactory;
    protected $table = 'treasuries_deliveries';
    protected $fillable = [
        'treasuries_id','treasuries_can_delivery_id','added_by','updated_by','com_code',
          ];
}
