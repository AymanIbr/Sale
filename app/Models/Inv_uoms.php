<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inv_uoms extends Model
{
    use HasFactory;

    protected $table = "inv_uoms";
    protected $fillable = [
        'name','active','is_master','added_by','updated_by','com_code','date',
          ];

          public function Inv_itemcards(){
            return $this->hasMany(Inv_itemcard::class , 'uom_id','id');
          }
}
