<?php

namespace App\Models\Mails;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailDeliveredMessage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'email',
        'subject',
        'discription',
        'message',
        'status',
        'templtete_code',
    ];
}
