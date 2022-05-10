<?php

namespace Premialabs\Foundation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditableModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'model'
    ];
}
