<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductReview
 *
 * @property int $id
 * @property string $content Review content
 * @property int $rating Review rating
 * @property int $product_id
 * @property int $buyer_id
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ProductReview newModelQuery()
 * @method static Builder|ProductReview newQuery()
 * @method static Builder|ProductReview query()
 * @method static Builder|ProductReview whereBuyerId($value)
 * @method static Builder|ProductReview whereContent($value)
 * @method static Builder|ProductReview whereCreatedAt($value)
 * @method static Builder|ProductReview whereId($value)
 * @method static Builder|ProductReview whereProductId($value)
 * @method static Builder|ProductReview whereRating($value)
 * @method static Builder|ProductReview whereStatus($value)
 * @method static Builder|ProductReview whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ProductReview extends Model
{
    use HasFactory;

    protected $table = 'product_reviews';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = true;
}
