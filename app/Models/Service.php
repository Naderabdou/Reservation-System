<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en', 'desc_ar', 'desc_en', 'image', 'price', 'slug', 'is_available'];
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }
    public function getNameAttribute()
    {
        return $this['name_' . app()->getLocale()];
    }
    public function getDescAttribute()
    {
        return $this['desc_' . app()->getLocale()];
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
