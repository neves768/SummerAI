<?php
/**************************************************
===================================================
					Summer AI API
		NEVESY GAME STUDIO. All Rights reserved
===================================================
***************************************************/
namespace Nev;
require_once("MariaDBHandler.php");
require_once("user.php");
class SummerAPI {
	private $folders = [
		"AUT" => "auth",
		"DEV" => "devices",
	];

	protected $fn = [];
	protected $user;
	protected $method;
	protected $path;
	protected $MariaDB;
	function __construct($folderPath){
        header("Content-Type: application/json;charset=utf-8");
        $this->declareFns($folderPath);
	}
	
	protected function init(){
		$this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = $_GET['path'];
        $this->MariaDB = (new Database())->getDBConnection();
        $this->user = new User($this->MariaDB, true);
	}
	
	protected function makeCall(){
		if(isset($this->fn[$this->path])){
			if(!isset($this->fn[$this->path]["norequired"])){
				if(!$this->user->isLoggedIn){
                    exit(json_encode(["response" => "Not authorized"]));
                }
			}
			if(isset($this->fn[$this->path]["methods"][$this->method])){
				if(isset($this->fn[$this->path]["params"])){
					foreach($this->fn[$this->path]["params"] as $param => $bool){
						if($this->method == "POST"){
							if(!isset($_POST[$param])){
								die(json_encode(["response" => "MISSING PARAMETERS", "success" => false]));
								return false;
							}
						} else {
							if(!isset($_GET[$param])){
								die(json_encode(["response" => "MISSING PARAMETERS", "success" => false]));
								return false;
							}
						}
					}
				}
				$this->fn[$this->path]["fn"]();
			} else {
				die(json_encode(["response" => "INVALID REQUEST TYPE", "success" => false]));
			}
		} else {
			die(json_encode(["response" => "METHOD NOT FOUND", "success" => false]));
		}
	}
	
	private function declareFns($folderPath){
		$path = $this->folders[$folderPath] ?? false;
		if($path){
			require_once($path."/init.php");
		} else {
			die(json_encode(["response" => "INCORRECT PATH", "success" => false]));
		}
	}
}
$init = new \Nev\SummerAPI($_GET['branch'] ?? false);
?>