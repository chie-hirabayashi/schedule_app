<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'start',
        'end',
    ];

    // XX時間前の表示用
    public function start_diff()
    {
        return (new Carbon($this->start))->diffForHumans();
    }

    // 開始の日付
    public function getStartDateAttribute()
    {
        return (new Carbon($this->start))->toDateString();
    }

    // 開始の時刻
    public function getStartTimeAttribute()
    {
        return date_parse_from_format('%Y-%m-%d %H:%i', $this->start)["hour"]
            ? (new Carbon($this->start))->toTimeString()
            : '';
    }

    // 終了の日付
    public function getEndDateAttribute()
    {
        return (new Carbon($this->end))->toDateString();
    }

    // 終了の時刻
    public function getEndTimeAttribute()
    {
        return date_parse_from_format('%Y-%m-%m %H:%i', $this->end)['hour']
            ? (new Carbon($this->end))->toTimeString()
            : '';
    }
}
