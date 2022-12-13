<?php

namespace App\Models\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMetaData extends Model
{
    use HasFactory;
    protected $table = 'user_metadata';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'key',
        'value'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getMetaByKey($userId, $metaKey)
    {
        $meta = userMetaData::where('user_id', $userId)
            ->where('key', $metaKey)
            ->first();
        if($meta)
        {
            return $meta->value;
        }

        return '';
    }
}
