<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdSlidePosition extends Model
{
    use HasFactory;
    protected $table = "ad_slide_positions";
    protected $primaryKey = "id";
    protected $guarded = [];
}
