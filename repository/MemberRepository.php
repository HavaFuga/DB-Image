<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 */
require_once '../lib/Repository.php';

class MemberRepository extends Repository
{
    protected $tableName = 'user';
    protected $tableId = 'uid';
    protected $order = 'name';


    public function edit($name, $email, $password)
    {
        $query = "UPDATE $this->tableName SET nachname=?, vorname=?, strasse=?, oid=?, email=?, tel=? WHERE $this->tableId=?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sss', $name, $email, $password);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $statement->close();
    }


}