<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\RequestStatus;

class SystemRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'created_by',
        'approved_by'
    ];

    protected $casts = [
        'status' => RequestStatus::class,
    ];

    // the user who created this request
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
