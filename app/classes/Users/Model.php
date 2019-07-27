<?php

namespace App\Users;

use \App\App;
use \App\Users\User;

class Model
{

    private $table_name = 'users';

    public function __construct()
    {
        App::$db->createTable($this->table_name);
    }

    /** 2uzd turi irasyti $drink i duombaze
     * @param Drink $drink
     */
    public function insert(User $user) {
        return App::$db->insertRow($this->table_name, $user->getID(), $user->getData());
    }

    /**
     * 3uzd  Get array from DB under given conditions
     * @param array $conditions
     * @return User[]
     */
    public function get($conditions = []) {
        $users = [];
        $rows = App::$db->getRowsWhere($this->table_name, $conditions);
        foreach ($rows as $row_id => $row) {
            $row['id'] = $row_id;
            $users[] = new User($row);
        }
        return $users;
    }

    /**
     * 4uzd Update selected row content
     * @param Drink $drink
     * @return bool
     */
    public function update(User $user)
    {
        return App::$db->updateRow($this->table_name, $user->getId(), $user->getData());
    }

    /**
     * 5uzd istrinti table
     * @param Drink $drink
     * @return bool
     */
    public function delete(User $user)
    {
        App::$db->deleteRow($this->table_name, $user->getId());
    }

    public function deleteAll() {
        App::$db->truncateTable($this->table_name);
    }

    public function __destruct()
    {
        App::$db->save();
    }
}

?>