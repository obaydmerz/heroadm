<?php

namespace OMerz\HeroADM\Tools\Schema;

use OMerz\HeroADM\Tools\Table;
use Illuminate\Support\Facades\DB;
use Doctrine\DBAL\Schema\SchemaException;
use Doctrine\DBAL\Schema\Table as DoctrineTable;

class HEROSchemaManager
{
    // todo: trim parameters

    public static function __callStatic($method, $args)
    {
        return static::manager()->$method(...$args);
    }

    public static function manager()
    {
        return DB::connection()->getDoctrineSchemaManager();
    }

    public static function getDatabaseConnection()
    {
        return DB::connection()->getDoctrineConnection();
    }

    public static function tableExists($table)
    {
        if (!is_array($table)) {
            $table = [$table];
        }

        return static::manager()->tablesExist($table);
    }

    public static function listTables()
    {
        $tables = [];

        foreach (static::manager()->listTableNames() as $tableName) {
            $tables[$tableName] = static::listTableDetails($tableName);
        }

        return $tables;
    }

    /**
     * @param string $tableName
     *
     * @return OMerz\HeroADM\Tools\Schema\Table
     */
    public static function table($tableName)
    {
        $columns = static::manager()->listTableColumns($tableName);

        $foreignKeys = [];
        if (static::manager()->getDatabasePlatform()->supportsForeignKeyConstraints()) {
            $foreignKeys = static::manager()->listTableForeignKeys($tableName);
        }

        $indexes = static::manager()->listTableIndexes($tableName);

        //return new Table($tableName, $columns, $indexes, $foreignKeys, false, []);
        return new Table($tableName, $columns, $indexes, $foreignKeys);
    }
}
