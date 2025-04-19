<?php

use Coopxl\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GeometryModel.
 *
 * @property int                                          id
 * @property \Coopxl\LaravelMysqlSpatial\Types\Point      location
 * @property \Coopxl\LaravelMysqlSpatial\Types\LineString line
 * @property \Coopxl\LaravelMysqlSpatial\Types\LineString shape
 */
class GeometryModel extends Model
{
    use SpatialTrait;

    protected $table = 'geometry';

    protected $spatialFields = ['location', 'line', 'multi_geometries'];
}
