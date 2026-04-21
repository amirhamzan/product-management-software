<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    protected $appends = ['formatted_date'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Formatting the date to human readable language
    // Access using formatted_date
    public function getFormattedDateAttribute()
    {
        if (! $this->created_at) {
            return null;
        }

        return $this->created_at->diffForHumans();
    }
}
