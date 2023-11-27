<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageConfig extends Model
{
    use HasFactory;

    protected $table = "language_configs";
    protected $primaryKey = "id";
    protected $guarded = [];
  
}
