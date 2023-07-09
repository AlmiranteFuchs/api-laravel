<?php

namespace App\Models\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    // protected $table = 'transactions';

    protected $appends = [
        'transaction_duration',
        'transaction_result',
    ];

    protected $fillable = [
        'start_date',
        'end_date',
        'buy_price',
        'sell_price',
        'description',
    ];

    public function toArray(){
        $array = parent::toArray();
        unset($array['created_at'], $array['updated_at']);
        return $array;
    }

    // Redundant information, won't be stored in the database, attribute only
    public function gettransactionDurationAttribute()
    {
        $startDateTime = Carbon::parse($this->start_date);
        $endDateTime = Carbon::parse($this->end_date);
        
        $duration = $endDateTime->diffForHumans($startDateTime);

        return $duration;
    }

    public function gettransactionResultAttribute()
    {
        return $this->sell_price - $this->buy_price;
    }
}
