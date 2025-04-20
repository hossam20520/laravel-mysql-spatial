<?php

namespace Coopxl\LaravelMysqlSpatial\Eloquent;

use Illuminate\Database\Query\Expression;
use Illuminate\Database\Grammar;

class SpatialExpression extends Expression
{
    /**
     * Laravel 12-compatible version of getValue
     */
    public function getValue(Grammar $grammar)
    {
        return "ST_GeomFromText(?, ?)";
    }

    public function getSpatialValue()
    {
        return $this->value->toWkt();
    }

    public function getSrid()
    {
        return $this->value->getSrid();
    }
}
