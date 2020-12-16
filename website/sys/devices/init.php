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
        $this->fn["list"] = ["fn" => function(){
            $res = $this->logic->getDevices();
			die(json_encode(["response" => $res, "success" => true]));
        }, "methods" => ["GET" => true], "params" => []];

        $this->fn["update"] = ["fn" => function(){
            [$res, $bool] = $this->logic->setDevice($_POST["ID"], $_POST['state']);
			die(json_encode(["response" => $res, "success" => $bool]));
        }, "methods" => ["POST" => true], "params" => ["ID" => true, "state" => true]];

        $this->fn["add/device"] = ["fn" => function(){
            [$res, $bool] = $this->logic->addDevice($_POST["nome"], $_POST['type']);
			die(json_encode(["response" => $res, "success" => $bool]));
        }, "methods" => ["POST" => true], "params" => ["nome" => true, "type" => true]];

        $this->fn["communicate"] = ["fn" => function(){
            [$res, $bool] = $this->logic->communicate($_GET["phrase"]);
			die(json_encode(["response" => $res, "success" => $bool]));
        }, "methods" => ["GET" => true], "params" => ["phrase" => true], "norequired" => true];
    }
}
$a = new Auth();
?>