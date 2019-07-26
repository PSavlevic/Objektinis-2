<?php

namespace App;

class App
{

    /** @var \Core\FileDB **/
    public $db;

    public function __construct()
    {
        self::$db = new \Core\FileDB(DB_FILE);
        self::$db->load();
    }

    public function __destruct()
    {
        self::$db->save();
    }
}

?>