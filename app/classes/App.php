<?php

namespace App;

class App
{

    /** @var \Core\FileDB **/
    public static $db;

    public function __construct()
    {
        session_start();
        self::$db = new \Core\FileDB(DB_FILE);
        self::$db->load();
    }

    public function __destruct()
    {
        self::$db->save();
    }
}

?>