<?php
try{
    session_start();
    setlocale( LC_ALL, 'pt_BR.utf-8', 'pt_BR', 'Portuguese_Brazil');
    date_default_timezone_set('America/Sao_Paulo');
    mb_internal_encoding('UTF8'); 
    mb_regex_encoding('UTF8');

    require_once "class/conexao.class.php";
    require_once "class/log.class.php";

    $objConn = Conexao::getInstance();
}catch(Exception $e){
    echo "<script>
        $.Notify({
            caption: 'ERRO PRIMÁRIO ".$e->getCode()."',
            content: 'Ocorreu um erro primário no servidor, contate o administrador.',
            type: 'alert',
            keepOpen: true
        });
    </script>";
    GerarLog::getInstance()->inserirLog("Erro: Código: " . 
        $e->getCode() . " Mensagem: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">

    <link href="css/metro.css" rel="stylesheet">
    <link href="css/metro-icons.css" rel="stylesheet">
    <link href="css/ig.css" rel="stylesheet">
    <!-- FullColendar -->
    <link href='css/fullcalendar.css' rel='stylesheet' />
    <link href='css/fullcalendar.print.css' rel='stylesheet' media='print' />
    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
            padding-top: 30px;
        }
        .fc-day-grid-event .fc-content {
            white-space: normal !important;
        }
    </style>

    <script src="js/jquery.js"></script>
    <script src="js/metro.js"></script>
    <script src="js/pesquisa.js"></script>
    <title>Pós Geografia</title>
</head>
<body>
<div class="corpo">
    <?php 
    try{
        if(isset($_SESSION['usr_id'])){
            if($_SESSION['usr_datetime']+10000 < date("YmdHis")){
                session_destroy();
                header("Location: index.php");
            }else{
                include "painel.php";
            }
        }else{
            include "login.php";
        }
        
    }catch (Exception $e) {
        echo "<script>
            $.Notify({
                caption: 'ERRO ".$e->getCode()."',
                content: 'Ocorreu um erro no servidor, contate o administrador.',
                type: 'alert',
                keepOpen: true
            });
        </script>";
        GerarLog::getInstance()->inserirLog("Erro: " . 
            $e->getCode() . " Mensagem: " . $e->getMessage());
    }
    ?>
</div>
<div class="mensagem block-shadow align-center padding30"><h3>O Painel IG não oferece suporte para este dispositivo</h3>Tente em um computador com resolução superior a 640px de largura.</div>
</body>
</html>