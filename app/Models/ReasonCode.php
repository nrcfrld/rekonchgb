<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReasonCode extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function principal()
    {
        return $this->belongsTo(Principal::class);
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%' . $query . '%')->OrWhere('code', $query);
    }
}
