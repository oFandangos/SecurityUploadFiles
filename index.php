<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM UPLOAD IMAGE</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body id="body">
    <form class="formulario" action="index.php" enctype="multipart/form-data" method="post" name="formImage">
        <label class="label" for="nome">Nome</label>
        <input class="input" type="text" name="nome" placeholder="Insira seu nome">
        <label class="label" for="email">E-mail</label>
        <input class="input" type="text" name="email" placeholder="Insira seu email">
        <input id="foto1" class="foto" type="file" name="foto">
        <input id="foto2" class="foto" type="file" name="foto2">
        <input class="botao" type="submit" value="ENVIAR">
    </form>
</body>
</html>
<?php
include_once 'msg.php';
if(isset($_POST["nome"])){
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    if(isset($_FILES["foto"]) || isset($_FILES["foto2"])){
        $foto = $_FILES["foto"];
        $foto2 = $_FILES["foto2"];
        // echo "<pre style='color:white;'>";
        // var_dump($foto);
        // echo '<br>';
        // var_dump($foto2);
        // echo "</pre>";
        if($foto['size'] > 5200000 || $foto2['size'] > 5200000){
            echo '<div class="alert alert-warning">A imagem é muito pesado para ser salva (5mb)</div>';
        }else{

        
        if($foto['type'] == "image/jpeg" 
        || $foto['type'] == "image/png" 
        || $foto['type'] == "image/webp" 
        || $foto['type'] == "image/gif"
        and $foto2['type'] == "image/jpeg"
        || $foto2['type'] == "image/png" 
        || $foto2['type'] == "image/webp" 
        || $foto2['type'] == "image/gif"){
            
            echo '<div class="alert alert-success">'.$MSG['OP50'].'</div>';

            $extensao = explode(".", $foto["name"]); //estourar no "ponto" do nome do arquivo, pega a extensao da foto por transformando-a em um array
            $new_extensao = explode(".", $foto2["name"]);
            $foto["name"] = md5(uniqid(time(), true)) . "." . $extensao[1]; //dando nome único para a foto não se repetir 
            $foto2["name"] = md5(uniqid(time(), true)) . "." . $new_extensao[1];
            move_uploaded_file($foto["tmp_name"], "images/" . $foto['name']);
            move_uploaded_file($foto2["tmp_name"], "images/" . $foto2['name']);
            // imagem.nome.png
            // var[0] = "imagem";
            // var[1] = "nome";
            // var[2] = "jpg";

        }else{
            echo '<div class="alert alert-danger">'.$MSG['FR19'].' ou '. $MSG['FR01'] .'</div>';
        }
    }
}
}else{
}
?>