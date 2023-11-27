<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminStatus extends Model
{
    use HasFactory;
    protected $table = "admin_statuses";
    protected $primaryKey = "id";
    protected $guarded = [];
}
