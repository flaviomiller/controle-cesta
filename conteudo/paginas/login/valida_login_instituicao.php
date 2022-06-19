<?php

session_start();
include_once("../../src/conexoes/conexao.php");

$btnLogin = filter_input(INPUT_POST, 'btnLogin', FILTER_SANITIZE_STRING);
//echo $btnLogin;
if($btnLogin){
    $instituicao = filter_input(INPUT_POST, 'instituicao', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    //$password = md5($password);
    //echo "$user - $password";
    if((!empty($instituicao)) AND (!empty($password))){    
        $result_instituicao = "SELECT instituicao_id, nome_instituicao, senha FROM instituicao WHERE instituicao_id='$instituicao' LIMIT 1";
		$resultado_instituicao = mysqli_query($conn, $result_instituicao);
		if($resultado_instituicao){
            $row_instituicao = mysqli_fetch_assoc($resultado_instituicao);
            if(password_verify($password, $row_instituicao['senha'])){
                $_SESSION['instituicao_id'] = $row_instituicao['instituicao_id'];
		        $_SESSION['instituicao'] = $row_instituicao['nome_instituicao'];
		        header("Location: ../admin/cad_presenca.php");
            } else {
                $_SESSION['msg'] = "Incorrect password";
                header("Location: login.php");
            }    
        }
    } else {    
        $_SESSION['msg'] = "Incorrect password";
        header("Location: login.php");
    }
}else{
    $_SESSION['msg'] = "Page not found";
    header("Location: login.php");
}