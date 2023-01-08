<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class AccessLogs extends Model
{
    use HasFactory, Sortable;

    public $sortable = [
        'id',
        'name',
        'ip',
        'a_time',
    ];

    protected $fillable = [
        'name',
        'ip',
        'path',
        'a_time'
    ];

    public function getTime()
    {
        return Carbon::createFromTimestamp($this->a_time);
    }
}
