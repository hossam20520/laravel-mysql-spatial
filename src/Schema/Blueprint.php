<?php

namespace Coopxl\LaravelMysqlSpatial\Schema;

use Illuminate\Database\Schema\Blueprint as IlluminateBlueprint;

class Blueprint extends IlluminateBlueprint
{
    public function geometry($column, $subtype = null, $srid = 0)
    {
        return $this->addColumn('geometry', $column, compact('subtype', 'srid'));
    }

    public function point($column, $srid = 0)
    {
        return $this->addColumn('point', $column, compact('srid'));
    }

    public function lineString($column, $srid = 0)
    {
        return $this->addColumn('linestring', $column, compact('srid'));
    }

    public function polygon($column, $srid = 0)
    {
        return $this->addColumn('polygon', $column, compact('srid'));
    }

    public function multiPoint($column, $srid = 0)
    {
        return $this->addColumn('multipoint', $column, compact('srid'));
    }

    public function multiLineString($column, $srid = 0)
    {
        return $this->addColumn('multilinestring', $column, compact('srid'));
    }

    public function multiPolygon($column, $srid = 0)
    {
        return $this->addColumn('multipolygon', $column, compact('srid'));
    }

    public function geometryCollection($column, $srid = 0)
    {
        return $this->addColumn('geometrycollection', $column, compact('srid'));
    }

    public function spatialIndex($columns, $name = null)
    {
        return $this->indexCommand('spatial', $columns, $name);
    }

    public function dropSpatialIndex($index)
    {
        return $this->dropIndexCommand('dropIndex', 'spatial', $index);
    }
}
