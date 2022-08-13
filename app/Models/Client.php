<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'dob',
        'phone',
        'email',
        'address',
        'payments',
        'total',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function payments_list()
    {
        return $this->hasMany(Payment::class, 'client_id', 'id');
    }
}
