<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $guarded;

    public function images()
    {
        return PropertyImage::where('property_id', $this->id)->get();
    }
}
