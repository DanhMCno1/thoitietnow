<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;
    // Đảm bảo các cột được phép nhập vào
    protected $fillable = ['name', 'gso_id'];
}
