<?php

namespace App\Models\Tickets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tickets\Ticket;

class TicketCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'color',
        'is_default'
    ];


    public function tickets()
    {
        return $this->hasOne(Ticket::class, 'category_id', 'id');
    }

}
