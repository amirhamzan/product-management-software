<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'quantity'];

    protected $appends = ['formatted_date'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Formatting the date to human readable language
    // Access using formatted_date
    public function getFormattedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
