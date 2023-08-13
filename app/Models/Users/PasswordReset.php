<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;
    
    public $table = "password_resets";
    public $timestamps = false;
    protected $primaryKey = "email";

    protected $fillable = ['email', 'token', 'created_at'];



}
