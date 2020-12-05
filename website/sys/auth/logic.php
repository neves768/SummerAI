<?php
namespace Nev;
class AuthLogic{
    function __construct(&$user){
        $this->user = $user;
    }
    

    private function validateData($data){
        $required = ["nome", "sobrenome", "email", "senha"];
        foreach($required as $req){
            if(!isset($data[$req])){
                return ["Preencha todos os campos".$req, false];
            } else {
                if(strlen($data[$req]) < 4){
                    return ["O tamanho mínimo de ".$req." é de 4 caracteres", false];
                }
            }
        }
        return ["Sucesso ao cadastrar.", true];
    }

    public function login($data){
        $bool = $this->user->logIn($data["email"], $data["senha"]);
        if($bool){
            return ["Logado com sucesso", true];
        } else {
            return ["Suas credenciais estão incorretas", false];
        }

    }

    public function register($data){
        [$res, $bool] = $this->validateData($data);
        if($bool){
            if($this->user->userExists($data)){
                return ["Não foi possível realizar o cadastro. O usuário informado já existe.", false];
            }
            if(!$this->user->register($data)){
                return ["Houve uma falha ao cadastrar", false];
            }
        }
        return [$res, $bool];
    }

    // TO DO: MOVER PARA MÓDULO PRÓPRIO
    public function getDevices(){
        return $this->user->getDevices();
    }
    public function setDevice($deviceID, $state){
        return $this->user->setDevice($deviceID, $state);
    }
}
?>