<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chargeback extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['days_to_act'];

    public function getDaysToActAttribute()
    {
        $currentDate = Carbon::now();
        if (!$currentDate->gt($this->expired_date)) {
            return $currentDate->diff($this->expired_date)->days . " Hari";
        } else {
            return "-";
        }
    }

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

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by_id = $user->id;
        });

        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by_id = $user->id;
        });
    }
}
