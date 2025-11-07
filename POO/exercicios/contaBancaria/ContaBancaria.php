<?php

session_start();


class contaBancaria{

    private $saldo;

    public function __construct() {
        $this -> saldo = isset($_SESSION['saldo']) ? $_SESSION['saldo'] : 0;

    }
    public function setSaldo($valor){
        $this -> saldo = $valor;
        $_SESSION['saldo'] = $this -> saldo;
        
    }
    public function getSaldo(){
        return $this -> saldo;

    }

        public function depositar($valor){
        if($valor > 0){
            $this -> saldo += $valor;
            $_SESSION['saldo'] = $this -> saldo;
            return true;
        }else{
            return false;
        }
    }
    public function sacar($valor){
        if($valor > 0 && $valor <= $this -> saldo){
            $this -> saldo -= $valor;
            $_SESSION['saldo'] = $this -> saldo;
            return true;
        }else{
            return false;
            // "Saldo insuficiente ou valor inválido.";
        }
    }







}

