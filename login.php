<?php
require_once "class/usuario.siud.php";

$usuarioSIUD = UsuarioSIUD::getInstance();
if(isset($_POST['email']) && isset($_POST['senha'])){
    if($usuario = $usuarioSIUD->SelectLogin(new Usuario($_POST['email'],$_POST['senha']))){
        $_SESSION['usr_id'] = $usuario['id'];
        $_SESSION['usr_email'] = $usuario['email'];
        $_SESSION['usr_permissao'] = $usuario['permissao'];
        $_SESSION['usr_datetime'] = date("YmdHis");
        GerarLog::getInstance()->logGerais($_SESSION['usr_id'], 1, "");
        header("Location: index.php");
    }else{
        echo "<script>
            $.Notify({
                caption: 'Login invalido',
                content: 'E-mail ou Senha incorreto, tente novamente.',
                type: 'warning'
            });
        </script>";
    }
}
?>
&nbsp;
<div class="grid">
    <div class="row">
        <div class="cell">
            <div class="painel block-shadow padding20 bg-darkCobalt fg-white">
                <div class="container-login">
                    <form method="post">
                        <div class="row">
                            <div class="cell">
                                <h2>Entrar na conta da Pós de Geografia (IG-Unicamp)</h2>
                                Entre com seu e-mail e senha do sistema da Pós de Geografia para acessar o painel e relatórios.
                            </div>
                        </div>
                        <div class="row no-margin">
                            <div class="cell">
                                <div class="input-control modern text iconic">
                                    <input type="text" class="input-login" name="email" placeholder="Entre com seu e-mail">
                                    <span class="label">E-mail</span>
                                    <span class="informer">Por favor, escreva seu e-mail</span>
                                    <span class="icon mif-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="cell">
                                <div class="input-control modern password iconic" data-role="input">
                                    <input type="password" class="input-login" name="senha" placeholder="Entre com sua senha">
                                    <span class="label">Senha</span>
                                    <span class="informer">Por favor, escreva sua senha</span>
                                    <span class="icon mif-lock"></span>
                                    <button class="button helper-button reveal input-login-r  bg-darkCobalt fg-white" data-role="hint"
                                        data-hint-background="bg-red"
                                        data-hint-color="fg-white"
                                        data-hint-mode="2"
                                        data-hint="Visualizar Senha|Aperte e segure para aparecer a senha digitada, para verificação.">
                                        <span class="mif-looks"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="cell">
                                Sou novo, solicitar acesso<br/>
                                Não consigo acessar minha conta<br/>
                                Ler os termos de privacidade e acesso<br/>
                            </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="cell">
                            <label>
                                <button class="button primary place-right">Entrar no sistema</button>
                            </label>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>