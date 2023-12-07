<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'message',
        'is_read',
        'is_saved',
        'related_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'related_id');
    }
}
