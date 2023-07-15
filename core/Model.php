<?php
class Model extends DataBase
{
    public function insertRecord($table = '', $data = [])
    {
        return $this->insert($table, $data);
    }
    public function deleteRecord($table = '', $condition = '')
    {
        return $this->delete($table, $condition);
    }
    public function updateRecord($table = '', $data = [], $condition = '')
    {
        return $this->update($table, $data, $condition);
    }
    public function fetchAll($table = '', $field = '*')
    {
        return $this->getAll("SELECT $field FROM $table");
    }
    public function fetch($table = '', $field = '*')
    {
        return $this->get("SELECT $field FROM $table");
    }
    public function exists($sql = '')
    {
        return $this->exists($sql);
    }
}
