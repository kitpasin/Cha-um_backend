<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebInfoType extends Model
{
    use HasFactory;
    
    protected $table = "web_info_types";
    protected $primaryKey = "id";
    protected $guarded = [];
}
