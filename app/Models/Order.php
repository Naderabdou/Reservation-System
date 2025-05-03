<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        // 'canceled_type',
        'order_number',
        'service_id',
        'service_name',
        'service_price',
        'user_id',
        'name',
        'email',
        'phone',
        'reservation_date'

    ];

    //appends



    //casts
    // protected $casts = [
    //     'pickup_date' => 'datetime',
    //     'pickup_time' => 'datetime',
    // ];

    //relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function formatDate($column)
    {
        if (empty($this->attributes[$column])) {
            return null;
        }

        $date = Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes[$column]);

        // تعيين اللغة بناءً على إعدادات التطبيق
        Carbon::setLocale(app()->getLocale());

        // تنسيق التاريخ بناءً على اللغة
        $format = app()->getLocale() === 'ar' ? 'd M Y | h:i A' : 'd M Y | h:i A';

        return $date->translatedFormat($format);
    }
    // استخدام الدالة في كل `Accessor`
    public function getDateAttribute()
    {
        return $this->formatDate('created_at');
    }

    //resvation_date
    public function getReservationDateAttribute()
    {
        return $this->formatDate('reservation_date');
    }
}
