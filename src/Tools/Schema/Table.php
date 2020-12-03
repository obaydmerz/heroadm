<?php

namespace OMerz\HeroADM\Tools;


class Table
{
    public $name;
    public $columns = array();
    public $foreignKeys = array();
    public $indexes = array();

    public static function manager()
    {
        return DB::connection()->getDoctrineSchemaManager();
    }

    public function __construct($tableName, $columns, $indexes, $foreignKeys){
        $this->name = $tableName;
        $this->indexes = $indexes;
        $this->columns = $columns;
        $this->foreignKeys = $foreignKeys;
    }

    public function exists(){
        $table = $this->name;
        if (!is_array($table)) {
            $table = [$table];
        }

        return static::manager()->tablesExist($table);
    }
}
