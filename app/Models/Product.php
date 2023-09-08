<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;
use Spatie\Tags\HasTags;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTags;
    use HasStatuses;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'category_id',
        'short_description',
        'description',
        'sku',
        'price',
        'discount_price',
        'discount_percentage',
        'is_active',
        'is_featured',
        'published_at',
        'meta',
        'views',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attributes() : BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class);
    }

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Is Featured Scope
     *
     * @param Builder $query
     * @return void
     */
    public function scopeIsFeatured($query)
    {
        $query->where('is_featured', 1);
    }

    /**
     * Is Active Scope
     *
     * @param Builder $query
     * @return void
     */
    public function scopeIsActive($query)
    {
        $query->where('is_active', 1);
    }
}
