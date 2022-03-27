<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductPrice
 *
 * @property int $id
 * @property string $price Price value
 * @property string $unit Price unit
 * @property string $effect_date Price effect date
 * @property int $product_id
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ProductPrice newModelQuery()
 * @method static Builder|ProductPrice newQuery()
 * @method static Builder|ProductPrice query()
 * @method static Builder|ProductPrice whereCreatedAt($value)
 * @method static Builder|ProductPrice whereEffectDate($value)
 * @method static Builder|ProductPrice whereId($value)
 * @method static Builder|ProductPrice wherePrice($value)
 * @method static Builder|ProductPrice whereProductId($value)
 * @method static Builder|ProductPrice whereStatus($value)
 * @method static Builder|ProductPrice whereUnit($value)
 * @method static Builder|ProductPrice whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ProductPrice extends Model
{
    use HasFactory;

    protected $table = 'product_prices';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = true;
}
