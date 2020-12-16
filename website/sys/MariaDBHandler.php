<?php
namespace Nev;
class Database{
    private $pdoConnection;
    function __construct(){
		$this->pdoConnection = new \PDO("mysql:host=localhost;dbname=test", "root", "123");
		$this->pdoConnection->exec("set names utf8");
		$this->pdoConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
	
    public function getDBConnection(){
        return $this->pdoConnection;
    }
}
?>