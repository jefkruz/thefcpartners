<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
protected $guarded;

    public function realtor()
    {
        return User::find($this->user_id);
    }
}
