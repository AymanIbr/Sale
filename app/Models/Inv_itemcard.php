<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inv_itemcard extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Inv_itemcard_category(){
        return $this->belongsTo(Inv_itemcard_category::class , 'inv_itemcard_categories_id','id');
    }

    public function Inv_uom(){
        return $this->belongsTo(Inv_uoms::class  , 'uom_id','id');
    }
}
