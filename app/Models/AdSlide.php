<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdSlide extends Model
{
    use HasFactory;
    protected $table = "ad_slides";
    protected $primaryKey = "id";
    protected $guarded = [];
}
