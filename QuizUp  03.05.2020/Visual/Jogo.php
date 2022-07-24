<?php

session_start();

if(!isset($_SESSION['IdUser'])){
    header("Location: Login.php");
}

$id = $_SESSION['IdUser'];

$idUser = (int)$id["idUser"];

require_once("../Controle/Controle.php");
$control = new ControleUsuario();

$pg = $_GET['area'];

$_SESSION['area'] = $pg;

$hist = $control->historico($idUser, $pg);

$perg = $control->perguntas($pg);

$cnt = $hist;
require_once("menu.php");

if(isset($perg[$cnt]['id'])){

    $_SESSION['resposta'] = $perg[$cnt]['resp'];
    $_SESSION['idArea'] = $perg[$cnt]['id'];

    $aaa = ['A', 'B', 'C', 'D', 'E'];

    echo "
    <div class='col p-4 text-center'>
        
            <div class='card-body'>
                
    
            <ul class='nav nav-tabs card-header-tabs'>
                <li class='nav-item'>
                    <a class='nav-link active' href='#'>Active</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' href='#'>Link</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' href='#'>Link</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' href='#'>Link</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' href='#'>Link</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' href='#'>Link</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' href='#'>Link</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' href='#'>Link</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' href='#'>Link</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link active' href='#'>Link</a>
                </li>
                
            
            </ul>
            
        </div>
        <div class='card-body'>
            <h4 class='card-title'>{$perg[$cnt]['area']}</h4>
        ";

        if(isset($perg[$cnt]['enunc1'])){
        echo "<h5 class='card-title'>{$perg[$cnt]['enunc1']}</h5>";
        }
        if(isset($perg[$cnt]['img'])){
            echo "<h5 class='card-title'>{$perg[$cnt]['enunc1']}</h5>";
        }
        if(isset($perg[$cnt]['enunc2'])){
            echo "<h5 class='card-title'>{$perg[$cnt]['enunc2']}</h5>";
        }
        for($i=1; $i<=5; $i++){
            if(isset($perg[$cnt]['alt'.$i])){
            echo "<a href='../Controle/resp.php?res={$aaa[$i-1]}' class='btn btn-primary'>{$perg[$cnt]['alt'.$i]}</a><br />";
            }
        }

        echo "
        </div>
    </div>
    </div>
    </body>
    </html>";
}else{
    $pt = $control->selecionarPid($idUser);
    $pt = $pt['pontuacao'];

    echo "
        <h4>Acabou. Essa é sua pontuação atual: {$pt}</h4>
    ";
}
?>
