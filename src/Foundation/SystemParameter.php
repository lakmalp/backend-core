<?php

namespace Premialabs\Foundation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemParameter extends Model
{
    use HasFactory;

    protected $fillable = [
        'value'
    ];
}
