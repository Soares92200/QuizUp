<?php

session_start();

if(!isset($_SESSION['IdUser'])){
    header("Location: Login.php");
}

require_once("menu.php");
?>


 
<div class="col text-center">
        <h1 class="display-4">Tutorial</h1>
        
        <h5 class="card-title">Sejam bem vindos ao quizUp, antes de começar leia o breve tutorial abaixo e se divirta!</h5>
        <div class="card-body">
        </div>
        <p class="card-text-center">
            - Cada pergunta equivale a 10 pontos;
        </p>
        <p class="card-text-center">
            - Cada acerto é um ganho de +10 pontos;
        </p>
        <p class="card-text-center">
            - Cada erro uma perca de -10 pontos;
        </p>
        <p class="card-text-center">
            - Os pontos são acumulativos;
        </p>
        <p class="card-text-center">
            - Só é possível jogar em uma área por vez;
        </p>
                  
            </div>
        </div>
    </div><!-- Main Col END -->
</div><!-- body-row END -->
</body>
</html>

                    
                    
                 