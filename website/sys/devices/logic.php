<?php
namespace Nev;
class AuthLogic{
    function __construct(&$user){
        $this->user = $user;
        $this->MariaDB = $this->user->MariaDB;
        $this->turnStates = [
            "on" => ["ligar", "ligue"], 
            "off" => ["desligar", "desligue"]
        ];
    }

    public function addDevice($name, $type){
        if(is_numeric($type) == false || gettype($name) != "string"){
            return ["Nome ou tipo inválido. O tamanho máximo do nome é de 30 caracteres", false];
        }
        $sql = "INSERT INTO `smartdevices` (`ID`, `userID`, `nome`, `dados`, `type`) VALUES (NULL, :uID, :nm, '{\"state\":\"false\"}', :typ);";
        $dt = [
            "uID" => $this->user->udata->ID,
            "nm" => $name,
            "typ" => $type
        ];
        $qry = $this->MariaDB->prepare($sql);
        if($qry->execute($dt)){
            return ["Dispositivo adicionado com sucesso", true];
        }
        return ["Houve uma falha ao adicionar o dispositivo", false];
    }

    private function getAllDevices(){
        $q = $this->MariaDB->prepare("SELECT `ID`, `nome`, `dados`, `type` FROM `smartdevices`");
        $q->execute();
        return $q->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getDevices(){
        $q = $this->MariaDB->prepare("SELECT `ID`, `nome`, `dados`, `type` FROM `smartdevices` WHERE `userID` = :uID");
        $q->execute(['uID' => $this->user->udata->ID]);
		return $q->fetchAll(\PDO::FETCH_OBJ);
    }

    public function setDevice($deviceID, $state){
        $q = $this->MariaDB->prepare("UPDATE `smartdevices` SET `dados` = :dt WHERE `ID` = :device");
        $q->execute(['device' => $deviceID, 'dt' => json_encode(["state" => $state])]);
		return ["Sucesso", true];
    }

    private function utf8_strtr($str) {
        $from = "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ";
        $to = "aaaaeeiooouucAAAAEEIOOOUUC";
        $keys = array();
        $values = array();
        preg_match_all('/./u', $from, $keys);
        preg_match_all('/./u', $to, $values);
        $mapping = array_combine($keys[0], $values[0]);
        return strtr($str, $mapping);
    }
    
    public function communicate($phrase){
        $state = false;
        foreach($this->turnStates as $k => $v){
            foreach($v as $word){
                if(strpos($phrase, $word)){
                    $state = $k;
                }
            }
        }
        $state = ($state == "on") ? "true" : "false";

        $devices = $this->getAllDevices();
        #$devices = ["Lampada 02", "lampada 03", "lampada so"];
        $lastCount = 0;
        $devicesfound = [];
        foreach($devices as $v){
            $strp = explode(" ", $v->nome);
            $count = 0;
            foreach($strp as $w){
                $w = $this->utf8_strtr($w);
                $phrase = $this->utf8_strtr($phrase);
                if(strpos(strtolower($phrase), strtolower($w)) != false){
                    $count++;
                }
            }
            if($count > $lastCount){
                $devicesfound = [$v->nome];
                $lastCount = $count;
            } else if($count == $lastCount){
                $devicesfound[] = $v->nome;
            }
        }
        $list = implode(',', array_fill(0, count($devicesfound), '?'));
        $q = $this->MariaDB->prepare("UPDATE `smartdevices` SET `dados` = ? WHERE `nome` IN ($list)");
        if($q->execute([json_encode(["state" => $state]), ...$devicesfound])){
            return ["Tudo bem.", true];
        } else {
            return ["Este dispositivo não foi encontrado", false];
        }
    }
}
?>