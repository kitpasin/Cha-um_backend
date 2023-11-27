<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInfo extends Model
{
    use HasFactory;
    protected $table = "bank_infos";
    protected $primaryKey = "id";
    protected $guarded = [];
}
