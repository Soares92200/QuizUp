<?php
session_start();

$resp = $_SESSION['resposta'];
unset($_SESSION['resposta']);

$ap = $_SESSION['area'];
unset($_SESSION['area']);

$id = $_SESSION['IdUser'];

$idUser = (int)$id["idUser"];

require_once("Controle.php");
require_once("../Modelo/Pont.php");

try{
    $control = new ControleUsuario();

    $p = new Pont();

    $pont = $control->selecionarPid($idUser);

    $p->setIdUsuario($idUser);
    $p->setArPerg($ap);

    if($_GET['res'] == $resp){
        $pont = (int)$pont['pontuacao']+10;
        $pont = "$pont";
        $p->setPonto($pont);
    }else{
        if($pont =='0'){
            header("Location: ../Visual/Principal.php");
        }else{
            $pont = (int)$pont['pontuacao']-10;
            $pont = "$pont";
            $p->setPonto($pont);
        }
    }
    $control->pontuacao($p);


    //var_dump($ap);

    header("Location: ../Visual/Jogo.php?area={$ap}");
}catch(Exception $e){
    echo "Erro: $e->getMessage()";
}

?>
