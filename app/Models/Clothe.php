<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    /**
     * App\Models\Clothe
     *
     * @property int $id
     * @property string $color
     * @property string $size
     * @property string $img
     * @property float $price
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @method static \Database\Factories\ClotheFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|Clothe newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Clothe newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|Clothe query()
     * @method static \Illuminate\Database\Eloquent\Builder|Clothe whereColor($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Clothe whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Clothe whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Clothe whereImg($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Clothe wherePrice($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Clothe whereSize($value)
     * @method static \Illuminate\Database\Eloquent\Builder|Clothe whereUpdatedAt($value)
     * @mixin \Eloquent
     */
    class Clothe extends Model
    {
        use HasFactory;

        protected $fillable = [
            'color',
            'img',
            'price',
        ];
    }
