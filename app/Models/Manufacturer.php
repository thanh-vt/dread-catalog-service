<?php

namespace App\Models;

use Database\Factories\ManufacturerFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Manufacturer
 *
 * @method static ManufacturerFactory factory(...$parameters)
 * @method static Builder|Manufacturer newModelQuery()
 * @method static Builder|Manufacturer newQuery()
 * @method static Builder|Manufacturer query()
 * @mixin Eloquent
 */
class Manufacturer extends Model
{
    use HasFactory;

    protected $table = 'manufacturers';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = true;
}
