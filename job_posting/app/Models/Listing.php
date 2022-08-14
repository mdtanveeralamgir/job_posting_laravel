<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use function PHPUnit\Framework\isNull;

class Listing extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        if(isset($filters['tag']))
        {
            $query->where('tags', 'like', '%' . $filters['tag'] . '%');
        }
        if(isset($filters['search']))
        {
            $query->where('title', 'like', '%' . $filters['search'] . '%')
            ->orWhere('description', 'like', '%' . $filters['search'] . '%')
            ->orWhere('tags', 'like', '%' . $filters['search'] . '%');
        }
    }

    protected function logo(): Attribute
    {
        return Attribute::make(
            get: function($path) {
                return is_null($path) ? 'images/no-image.png' : 'storage/' . $path;
            
            }
        );
    }
}
