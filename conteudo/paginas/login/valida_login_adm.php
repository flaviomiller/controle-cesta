<?php

session_start();
include_once("../../src/conexoes/conexao.php");

$btnLogin = filter_input(INPUT_POST, 'btnLoginAdm', FILTER_SANITIZE_STRING);
//echo $btnLogin;
if($btnLogin){
    $usuarioAdm = filter_input(INPUT_POST, 'usuario_adm', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
    //$password = md5($password);
    //echo "$user - $password";
    if((!empty($usuarioAdm)) AND (!empty($password))){    
        $result_usuarioAdm = "SELECT usuario_id, usuario, senha FROM usuario WHERE usuario='$usuarioAdm' LIMIT 1";
		$resultado_usuarioAdm = mysqli_query($conn, $result_usuarioAdm);
		if($resultado_usuarioAdm){
            $row_usuarioAdm = mysqli_fetch_assoc($resultado_usuarioAdm);
            if(password_verify($password, $row_usuarioAdm['senha'])){
                $_SESSION['usuario_id'] = $row_usuarioAdm['usuario_id'];
		        header("Location: ../admin/administracao");
            } else {
                $_SESSION['msg'] = "Incorrect password";
                header("Location: acesso-adm");
            }    
        }
    } else {    
        $_SESSION['msg'] = "Incorrect password";
        header("Location: acesso-adm");
    }
}else{
    $_SESSION['msg'] = "Page not found";
    header("Location: acesso-adm");
}