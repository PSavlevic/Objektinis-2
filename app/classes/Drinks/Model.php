<?php

namespace App\Drinks;

class Model
{
    public static $db;
    private $table_name = 'drinks';

    public function __construct(\Core\FileDB $fileDB)
    {
        self::$db = $fileDB;
        self::$db->load();
        self::$db->createTable($this->table_name);
    }

    /** 2uzd turi irasyti $drink i duombaze
     * @param Drink $drink
     */
    public function insert(Drink $drink)
    {
        return self::$db->insertRow($this->table_name, $drink->getData());
    }

    /**
     * 3uzd
     * @param array $conditions
     * @return Drink[]
     */
    public function get($conditions = [])
    {
        $drinks = [];
        $rows = self::$db->getRowsWhere($this->table_name, $conditions);
        foreach ($rows as $row_id => $row_data) {
            $row_data['id'] = $row_id;
            $drinks[] = new Drink($row_data);
        }
        return $drinks;
    }

    /**
     * 4uzd
     * @param Drink $drink
     * @return bool
     */
    public function update(Drink $drink)
    {
        return self::$db->updateRow($this->table_name, $drink->getId(), $drink->getData());
    }

    /**
     * 5uzd
     * @param Drink $drink
     * @return bool
     */
    public function delete(Drink $drink)
    {
        return self::$db->deleteRow($this->table_name, $drink->getId());
    }

    public function __destruct()
    {
        self::$db->save();
    }
}

?>