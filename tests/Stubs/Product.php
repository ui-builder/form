<?php
namespace UiBuilder\Form\Tests\Stubs;

use Illuminate\Database\Eloquent\Model;
use GetThingsDone\Attributes\Attributes\{Code, Name, Text};
use Illuminate\Database\Eloquent\SoftDeletes;
use GetThingsDone\Attributes\Contracts\HasCastAttributes;
use GetThingsDone\Attributes\Concerns\InteractsWithCastAttributes;


class Product extends Model implements HasCastAttributes
{
    use InteractsWithCastAttributes, SoftDeletes;

    protected $fillable = [
        'code','name','size'
    ];
    
    protected $casts = [
        'code'  => Code::class,
        'name'  => Name::class,
        'size'  => Text::class
    ];
}