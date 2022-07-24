<?php
    require_once("Conect.php");
    //require_once("../Modelo/Usuario.php");
    class ControleUsuario{

        //Seleciona toda tabela    ****************

        function selecionarTodos(){
            try{
                $con = new Conexao();
                $cmd = $con->getConexao()->prepare("SELECT * FROM usuario;");
                $cmd->execute();
                $resultado = $cmd->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }catch(PDOException $e){
                echo "Erro no banco (selecionarTodos): {$e->getMessage()}";
            }catch(Exception $e){
                echo "Erro geral (selecionarTodos): {$e->getMessage()}";
            }
        }

        //Selecionar Perguntas

        function perguntas($a){
            try{
                $con = new Conexao();
                $cmd = $con->getConexao()->prepare("SELECT * FROM perguntas WHERE area=:a;");
                $cmd->bindParam(":a", $a);
                $cmd->execute();
                $resultado = $cmd->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }catch(PDOException $e){
                echo "Erro no banco (perguntas): {$e->getMessage()}";
            }catch(Exception $e){
                echo "Erro geral (perguntas): {$e->getMessage()}";
            }
        }

        //Seleciona uma pessoa específica   ********************

        function selecionarPid($id){
            try{
                $conexao = new Conexao();   
                $cmd = $conexao->getConexao()->prepare("SELECT * FROM usuario WHERE idUser=:id;");
                $cmd->bindParam("id", $id);
                $cmd->execute();
                $resultado = $cmd->fetch(PDO::FETCH_ASSOC);
                return $resultado;
            }catch(PDOException $e){
                echo "Erro no banco (selecionarPid): {$e->getMessage()}";
            }catch(Exception $e){
                echo "Erro geral (selecionarPid): {$e->getMessage()}";
            }
        }

        //Atualiza a tabela

        function atualizar($usuario){
            try{
                $conexao = new Conexao();
                $user = $usuario->getUsuario();
                $email = $usuario->getEmail();
                $img = $usuario->getImg();
                $senha = md5($usuario->getSenha());
                $id = $usuario->getId();

                $cmd = $conexao->getConexao()->prepare("SELECT * FROM  usuario WHERE user = :u;");
                $cmd->bindParam(":u",$user);
                $cmd->execute();
                if($cmd->rowCount() >0 ){
                    $cmd = $conexao->getConexao()->prepare("UPDATE usuario SET email = :e, senha = :s, img = :i WHERE idUser=:id;");
                }else{
                    $cmd = $conexao->getConexao()->prepare("UPDATE usuario SET user = :u, email = :e, senha = :s, img = :i WHERE idUser=:id;");
                    $cmd->bindParam("u", $user);
                }

                $cmd->bindParam("id", $id);
                $cmd->bindParam("e", $email);
                $cmd->bindParam("i", $img);
                $cmd->bindParam("s", $senha); 

                if($cmd->execute()){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                echo "Erro no banco (atualizar): {$e->getMessage()}";
            }catch(Exception $e){
                echo "Erro geral (atualizar): {$e->getMessage()}";
            }
        }

        //Retorna a tabela em array   **************

        function buscarDados($usuario) {
            try{
                $conexao = new Conexao();
                $u = $usuario->getUsuario();
                $cmd = $conexao->getConexao()->prepare("SELECT idUser FROM usuario WHERE user=:u;");
                $cmd->bindParam(":u",$u);
                $cmd->execute();
                $res = $cmd->fetch(PDO::FETCH_ASSOC);
                return $res;
                $conexao->fecharConexao();
            }catch(PDOException $e){
                echo "ERRO do (buscarDados do) banco:{$e->getMessage()}";
            }catch(Exception $e){
                echo "ERRO (buscarDados) geral:{$e->getMessage()}";
            }
        }

        //Verifica se existe na tabela   ***************

        function verificar($usuario){
            try{
                $conexao = new Conexao();
                $u = $usuario->getUsuario();
                $s =  md5($usuario->getSenha());      
                $cmd = $conexao->getConexao()->prepare("SELECT * FROM usuario WHERE user = :u && senha = :s;");
                $cmd->bindParam(":u",$u);
                $cmd->bindParam(":s",$s);
                $cmd->execute();
                if($cmd->rowCount() == 1){
                    $conexao->fecharConexao();
                    return true;
                }else{
                    $conexao->fecharConexao();
                    return false;
                }
            }catch(PDOException $e){
                echo "ERRO do (verificar do) banco:{$e->getMessage()}";
            }catch(Exception $e){
                echo "ERRO (verificar) geral:{$e->getMessage()}";
            }
        }

        //Cadastra pessoas       **************

        function cadastrarPessoa($usuario){
            try{
                $conexao = new Conexao();
                $cmd = $conexao->getConexao()->prepare("SELECT * FROM  usuario WHERE user = :usuario;");
                $cmd->bindParam(":usuario",$usuario->getUsuario());
                $cmd->execute();
                if($cmd->rowCount() >0 ){
                    $conexao->fecharConexao();
                    return false;
                }else{
                    $cmd = $conexao->getConexao()->prepare("INSERT INTO usuario (user,email,senha) VALUES(:u,:e,:s);");
                    $cmd->bindParam("u",$usuario->getUsuario());
                    $cmd->bindParam("e",$usuario->getEmail());
                    $cmd->bindParam("s",md5($usuario->getSenha()));
                    if($cmd->execute()){
                            $conexao->fecharConexao();
                            return true;
                    }else{
                            $conexao->fecharConexao();
                            return false;
                    }
                }
            }catch(PDOException $e){
                echo "ERRO do (cadastrarPessoa do) banco:{$e->getMessage()}";
            }catch(Exception $e){
                echo "ERRO (cadastrarPessoa) geral:{$e->getMessage()}";
            }
        }


        function pontuacao($p){//**********************
            try{
                $conexao = new Conexao();
                $pont = $p->getPonto();
                $id = $p->getIdUsuario();
                $cmd = $conexao->getConexao()->prepare("UPDATE usuario SET pontuacao=:p WHERE idUser=:id;");
                $cmd->bindParam(":p", $pont);
                $cmd->bindParam(":id", $id);
                
                if($cmd->execute()){
                 
                    $ia = $p->getArPerg();
                    $iu = $p->getIdUsuario();
                    $cmd = $conexao->getConexao()->prepare("INSERT INTO historico (arPerg, idUsuario) VALUES (:ap, :iu);");
                    $cmd->bindParam(":ap", $ia);
                    $cmd->bindParam(":iu", $iu);

                    if($cmd->execute()){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }

            }catch(PDOException $e){
                echo "Erro no banco (pontuacao): {$e->getMessage()}";
            }catch(Exception $e){
                echo "Erro geral (pontuacao): {$e->getMessage()}";
            }
        }

        function historico($id, $pg){ 
            try{
                $conexao = new Conexao();   
                $cmd = $conexao->getConexao()->prepare("SELECT * FROM historico WHERE idUsuario=:id && arPerg=:a;");
                $cmd->bindParam("id", $id);
                $cmd->bindParam(":a", $pg);
                $cmd->execute();
                //$resultado = $cmd->fetch(PDO::FETCH_ASSOC);
                return $cmd->rowCount();
                $conexao->fecharConexao();
            }catch(PDOException $e){
                echo "Erro no banco (historico): {$e->getMessage()}";
            }catch(Exception $e){
                echo "Erro geral (historico): {$e->getMessage()}";
            }
        }

        //Login off          ****************

        function sair(){
            try{
                session_destroy();
                header("Location: ../Visual/Login.php");
            }catch(PDOException $e){
                echo "ERRO do (sair do) banco:{$e->getMessage()}";
            }catch(Exception $e){
                echo "ERRO (sair) geral:{$e->getMessage()}";
            }
        }

    }
?>
