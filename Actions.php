<?php

include "LivroController.php";

$data=$_POST;

$livroController = new LivroController();

if($data["Metodo"]=="Cadastrar")
    $livroController->Cadastrar($data);

else if($data["Metodo"]=="Consultar")
    $livroController->Consultar($data);

else if($data["Metodo"]=="Editar")
    $livroController->Editar($data);

else if($data["Metodo"]=="Deletar")
    $livroController->Deletar($data);

else echo 0;