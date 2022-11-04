<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treasuri extends Model
{
    protected $table = 'treasuris';
    protected $fillable =
    ['name' , 'is_master' , 'last_isal_exhcange','last_isal_collect','created_at','updated_at','added_by','updated_by','com_code','date','active'];
    use HasFactory;
}
