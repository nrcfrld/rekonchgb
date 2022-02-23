<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chargeback extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('ref_id', 'like', '%' . $query . '%')
            ->orWhere('merchant', 'like', '%' . $query . '%');
    }

    public function principal()
    {
        return $this->belongsTo(Principal::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function reasonCode()
    {
        return $this->belongsTo(ReasonCode::class);
    }
}
