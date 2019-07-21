<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PullLog extends Model
{
    protected $table = 'pull_logs';

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
    ];

    protected $appends = ['message'];

    public function getStatusAttribute($value)
    {
        return $value == 1 ? "Valid" : "Invalid";
    }

    public function getMessageAttribute()
    {
        $data = json_decode($this->request_data);
        return isset($data->sms) ? $data->sms : '';
    }

}
