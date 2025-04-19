<?php

use Coopxl\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WithSridModel.
 *
 * @property int                                          id
 * @property \Coopxl\LaravelMysqlSpatial\Types\Point      location
 * @property \Coopxl\LaravelMysqlSpatial\Types\LineString line
 * @property \Coopxl\LaravelMysqlSpatial\Types\LineString shape
 */
class WithSridModel extends Model
{
    use SpatialTrait;

    protected $table = 'with_srid';

    protected $spatialFields = ['location', 'line'];

    public $timestamps = false;
}
