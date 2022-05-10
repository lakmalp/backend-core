<?php

namespace Premialabs\Foundation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelAudit extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'model_id',
        'before_json',
        'after_json',
        'by_user_id'
    ];

    protected $casts = [
        'before_json' => 'array',
        'after_json' => 'array'
    ];

    public function by_user()
    {
        return $this->belongsTo(User::class);
    }
}
