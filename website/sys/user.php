<?php
namespace Nev;
require_once("MariaDBHandler.php");
class User{
    private $publicPages = ["", "cadastro"];
    function __construct(&$db = false, $fromAPI=false) {
        $this->path = "/iotsummer/";
        $this->MariaDB = $db;
        if(!$this->MariaDB) $this->MariaDB = (new Database())->getDBConnection();
        $this->isLoggedIn = $this->verifyHash($_COOKIE["sessID"] ?? false);
        if($this->isLoggedIn){
            $this->udata = $this->getUserData($_COOKIE["sessID"]);
        }
        if(!$fromAPI) $this->protectPage();
    }

    private function hashIt($ps){
        return password_hash($ps, PASSWORD_BCRYPT, ['cost' => 10]);
    }

    public function protectPage(){
        $req = $_SERVER["REQUEST_URI"] ?? false;
        $req = str_replace($this->path, "", $req);
        if(in_array($req, $this->publicPages)) return true;
        if(!$this->isLoggedIn){
            $this->logOut();
        }
    }

    public function logIn($u, $p){
        if($this->checkCredentials($u, $p)){
            return $this->generateSession($u);
        } else {
            return false;
        }
    }

	public function logOut(){
        $qry = $this->MariaDB->prepare("UPDATE `users` SET `sessao` = '' LIMIT 1;");
        $qry->execute();
        
        $_COOKIE["sessID"] = "";
		setcookie("sessID", $_COOKIE["sessID"], [
			'expires' => time() - 1000,
			'path' => '/',
            'domain' => $_SERVER['HTTP_HOST'],
			'secure' => (strstr($_SERVER['HTTP_HOST'], "localhost") == false) ? true : false,
			'httponly' => true,
			'samesite' => 'Lax',
		]);
		unset($_COOKIE["sessID"]);
		header("Location: ".$this->path);
    }

    public function userExists($data){
        $q = $this->MariaDB->prepare("SELECT `nome` FROM `users` WHERE `email` = :e");
        $q->execute(['e' => $data["email"]]);
		if($q->rowCount() == 1){
            return true;
        }
        return false;
    }

    public function register($data){
        $qry = $this->MariaDB->prepare("INSERT INTO `users` (`nome`, `sobrenome`, `email`, `senha`) VALUES (:nome, :snome, :email, :pass);");
        $dt = [
            "nome" => $data["nome"],
            "snome" => $data["sobrenome"],
            "email" => $data["email"],
            "pass" => $this->hashIt($data["senha"])
        ];
        $qry->execute($dt);
        if($qry->rowCount() > 0){
            $sql = "INSERT INTO `smartdevices` (`ID`, `userID`, `nome`, `dados`, `type`) VALUES (NULL, :uID, 'Lâmpada da Cozinha', '{\"state\":\"true\"}', '1'), (NULL, :uID, \"Lâmpada 02\", '{\"state\":\"true\"}', '1'), (NULL, :uID, 'Lâmpada 03', '{\"state\":\"true\"}', '1'), (NULL, :uID, 'Lâmpada da Sala', '{\"state\":\"true\"}', '1');";
            $dt = [
                "uID" => $this->MariaDB->lastInsertId()
            ];
            $qry = $this->MariaDB->prepare($sql);
            $qry->execute($dt);
            return true;
        }
        return false;
    }

    private function getUserData($hash){
        $qry = $this->MariaDB->prepare("SELECT `ID`, `nome`, `email` FROM `users` WHERE `sessao` = :h LIMIT 1;");
		$qry->execute(['h' => $hash]);
		return $qry->fetch(\PDO::FETCH_OBJ);
    }

    private function checkCredentials($user, $pass){
        $qry = $this->MariaDB->prepare("SELECT `senha` FROM `users` WHERE `nome` = :user OR `email` = :user LIMIT 1;");
		$qry->execute(['user' => $user]);
        $user = $qry->fetch(\PDO::FETCH_OBJ);
		if(!isset($user->senha)) return false;
		return password_verify($pass, $user->senha);
    }
    
    private function verifyHash($hash){
		if(!$hash) return false;
		$q = $this->MariaDB->prepare("SELECT `nome` FROM `users` WHERE `sessao` = :hash");
        $q->execute(['hash' => $hash]);
		if($q->rowCount() == 1){
            return true;
        }
        return false;
    }

    private function generateSession($user){
        $hashT = sha1("sessionkey".microtime());
        $qry = $this->MariaDB->prepare("UPDATE `users` SET `sessao` = :hash WHERE `email` = :user");
        $qry->execute(['user' => $user, 'hash' => $hashT]);
        if($qry->rowCount() > 0){
            setcookie("sessID", $hashT, [
                'expires' => time() + 3600*2,
                'path' => '/',
                'domain' => $_SERVER['HTTP_HOST'],
                'secure' => (strstr($_SERVER['HTTP_HOST'], "localhost") == false) ? true : false,
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
            return true;
        } else {
            return false;
        }
    }
}