<?php
      $servidor = "localhost";
      $usuario = "root";
      $senha = "";
      $dbname = "controle_cesta";

      $conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
      
      if(!$conn){
          die("<p style = 'color:red;'>Falha na conexão: </p>" . mysqli_connect_error());
      }else{
          //echo "<p style = 'color:green;'>Conexão realizada com Sucesso </p>";
      }

     