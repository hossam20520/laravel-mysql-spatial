<?php

namespace Coopxl\LaravelMysqlSpatial\Schema;

use Closure;
use Illuminate\Database\Schema\MySqlBuilder;

class Builder extends MySqlBuilder
{
    /**
     * Create a new command set with a Closure.
     *
     * @param string  $table
     * @param Closure|null $callback
     *
     * @return Blueprint
     */
    protected function createBlueprint($table, Closure $callback = null)
    {
        // ✅ تمرير كائن الاتصال من داخل MySqlBuilder
        return new Blueprint($this->connection, $table, $callback);
    }
}
