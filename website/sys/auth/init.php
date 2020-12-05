<?php
namespace Nev;
require_once("logic.php");
class Auth extends SummerAPI{
    private $mainLogic;
	private $profgetters;
	function __construct(){
		$this->init();
        $this->user = new User();
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
        
        // TO DO: MOVER PARA MÓDULO PRÓPRIO
        $this->fn["list/devices"] = ["fn" => function(){
            if(!$this->user->isLoggedIn){
                exit(json_encode(["response" => "Not authorized"]));
            }
            $res = $this->logic->getDevices();
			die(json_encode(["response" => $res, "success" => true]));
        }, "methods" => ["GET" => true], "params" => []];

        $this->fn["set/device"] = ["fn" => function(){
            if(!$this->user->isLoggedIn){
                exit(json_encode(["response" => "Not authorized"]));
            }
            [$res, $bool] = $this->logic->setDevice($_POST["ID"], $_POST['state']);
			die(json_encode(["response" => $res, "success" => $bool]));
        }, "methods" => ["POST" => true], "params" => ["ID" => true, "state" => true]];
    }
}
$a = new Auth();
?>