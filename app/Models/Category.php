<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'shop_category';
    public $primaryKey='cate_id';
    public $timestamps=false;

}
