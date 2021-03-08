<?php

namespace MVC\Core;

use MVC\Config\Database;
use PDO;

class ResourceModel implements ResourceModelInterface
{
    protected $table;
    protected $id;
    protected $model;

    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }
    public function getAll()
    {
        $sql = "SELECT * FROM $this->table";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
    public function get($id)
    {
		$sql = "SELECT * FROM $this->table WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
	}
    public function add($model)
    {
        $data = $model->getProperties();
        $k = array_keys($data);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $dataKey = implode(" , ", $k);
        $dataValue = ":" . implode(" , :", $k);
        $sql = "INSERT INTO $this->table ($dataKey) VALUES ($dataValue)";
		$req = Database::getBdd()->prepare($sql);
		return $req->execute($data);
    }
    public function edit($model)
    {
        $data = $model->getProperties();
        $k = array_keys($data);
        unset($arrModel["created_at"]);
        $data['updated_at']=date('Y-m-d H:i:s');
        $dataKey = implode(" , ", $k);
        $str = "";
        foreach ($k as $key => $value) {
            $str .= $value . " = :" . $value . ",";
        }
        $str = substr($str,0,-1);
        $sql = "UPDATE $this->table SET $str WHERE id = :id";
		$req = Database::getBdd()->prepare($sql);
		return $req->execute($data);
    }
    public function delete($model)
	{
        $data['id'] = $model->getId();
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($data);
	}
}