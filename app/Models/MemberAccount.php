<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberAccount extends Model
{
    use HasFactory;
    protected $table = "member_accounts";
    protected $primaryKey = "id";
    protected $guarded = [];
}
