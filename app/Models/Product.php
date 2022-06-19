<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    /**
     * App\Models\Product
     *
     * @property int $id
     * @property int $user_id
     * @property int $clothe_id
     * @property string|null $deleted_at
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \App\Models\Clothe|null $clothe
     * @method static \Database\Factories\ProductFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Product query()
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereClotheId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Product whereUserId($value)
     * @mixin \Eloquent
     */
    class Product extends Model
    {
        use HasFactory;

        protected $fillable = [
            'user_id',
            'clothe_id',
            'size',
        ];

        public function clothe(): BelongsTo {
            return $this->belongsTo(Clothe::class);
        }
    }
