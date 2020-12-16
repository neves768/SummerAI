<?php
namespace Nev;
require_once("logic.php");
class Auth extends SummerAPI{
    private $mainLogic;
	private $profgetters;
	function __construct(){
		$this->init();
        $this->logic = new AuthLogic($this->user);
		$this->declares();
		$this->makeCall();
	}
	
	private function declares(){
		$this->fn["act/register"] = ["fn" => function(){
            [$res, $bool] = $this->logic->register($_POST);
			die(json_encode(["response" => $res, "success" => $bool]));
        }, "methods" => ["POST" => true], "params" => [], "norequired" => true];
        
        $this->fn["act/login"] = ["fn" => function(){
            [$res, $bool] = $this->logic->login($_POST);
			die(json_encode(["response" => $res, "success" => $bool]));
        }, "methods" => ["POST" => true], "params" => ["email" => true, "senha" => true], "norequired" => true];
    }
}
$a = new Auth();
?>