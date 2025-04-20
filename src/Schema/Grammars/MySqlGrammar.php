<?php

namespace Coopxl\LaravelMysqlSpatial\Schema\Grammars;

use Coopxl\LaravelMysqlSpatial\Schema\Blueprint;
use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Grammars\MySqlGrammar as BaseMySqlGrammar;
use Illuminate\Support\Fluent;

class MySqlGrammar extends BaseMySqlGrammar
{
    const COLUMN_MODIFIER_SRID = 'Srid';

    public function __construct(Connection $connection)
    {
        parent::__construct($connection);

        if (!in_array(self::COLUMN_MODIFIER_SRID, $this->modifiers)) {
            $this->modifiers[] = self::COLUMN_MODIFIER_SRID;
        }
    }

    public function typeGeometry(Fluent $column)
    {
        return 'GEOMETRY';
    }

    public function typePoint(Fluent $column)
    {
        return 'POINT';
    }

    public function typeLinestring(Fluent $column)
    {
        return 'LINESTRING';
    }

    public function typePolygon(Fluent $column)
    {
        return 'POLYGON';
    }

    public function typeMultipoint(Fluent $column)
    {
        return 'MULTIPOINT';
    }

    public function typeMultilinestring(Fluent $column)
    {
        return 'MULTILINESTRING';
    }

    public function typeMultipolygon(Fluent $column)
    {
        return 'MULTIPOLYGON';
    }

    public function typeGeometrycollection(Fluent $column)
    {
        return 'GEOMETRYCOLLECTION';
    }

    public function compileSpatial(Blueprint $blueprint, Fluent $command)
    {
        return $this->compileKey($blueprint, $command, 'spatial');
    }

    protected function modifySrid(\Illuminate\Database\Schema\Blueprint $blueprint, Fluent $column)
    {
        if (!is_null($column->srid) && is_int($column->srid) && $column->srid > 0) {
            return ' srid '.$column->srid;
        }
    }

    // ✅ إصلاح نهائي لمشكلة withTablePrefix
    public function withTablePrefix($prefix)
    {
        $this->tablePrefix = $prefix;

        return $this;
    }
}
