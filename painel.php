<div class="grid no-margin">
    <div class="row cells4 no-margin no-padding">
        <div class="cell menu bg-dark">
        </div>
    </div>
    <div class="row cells4">
        <div class="cell bg-dark fg-white">
            <div class="padding10">
                <h4 class="no-margin-bottom">Procurar</h4>
                <div class="input-control text full" data-role="input">
                    <input type="text" class="pesquisa" placeholder="Procure membros" data-role="hint"
                        data-hint-background="bg-green"
                        data-hint-color="fg-white"
                        data-hint-mode="1"
                        data-hint="Pesquisa|Encontre membros.">
                    <button class="button"><span class="mif-search"></span></button>
                    <div class="display-pesquisa"></div>
                </div>
            </div>
            <ul class="v-menu subdown full bg-dark">
                <li><a href="#"><span class="mif-home icon"></span> Painel Geral</a></li>
                <!--<li><a href="?p=form"><span class="mif-files-empty icon"></span> Formulário</a></li>-->
                <li><a href="?p=alunos"><span class="mif-user icon"></span> Alunos</a></li>
                <li><a href="?p=dissertacoes"><span class="mif-files-empty icon"></span> Dissertações</a></li>
                <li><a href="?p=instituicoes"><span class="mif-home icon"></span> Instituições/Universidades</a></li>
                <li><a href="?p=membros"><span class="mif-user icon"></span> Membros da banca</a></li>
                <li><a href="?p=editmembros"><span class="mif-user icon"></span> Editar Membros</a></li>
                <li><a href="?p=calendario"><span class="mif-calendar icon"></span> Calendario</a></li>
                <li>
                    <a href="#" class="dropdown-toggle"><span class="mif-chart-pie icon"></span> Gráficos</a>
                    <ul class="d-menu full bg-dark" data-role="dropdown">
                        <li><a href="#">Membros/Alunos</a></li>
                    </ul>
                </li>
                <li><a href="?p=registros"><span class="mif-user icon"></span> Registros</a></li>
                <li class="menu-title bg-grayDarker">Opções da conta</li>
                <li><a href="#"><span class="mif-key icon"></span> Mudar senha</a></li>
                <li><a href="?p=sair"><span class="mif-exit icon"></span> Sair</a></li>
            </ul>

        </div>
        <div class="cell colspan3 no-margin">
            <!--<ul class="breadcrumbs2">
                <li><a>&nbsp; <span class="icon mif-home"></span></a></li>
                <li><a href="#">Painel Geral</a></li>
            </ul>-->
            <?php
                if(isset($_GET['p'])){
                    include "page/".$_GET['p'].".php";
                }
            ?>
        </div>
    </div>
</div>


<script src="js/jquery.js"></script>
<script src="js/metro.js"></script>
<script src='js/moment.min.js'></script>
<script src='js/fullcalendar.min.js'></script>
<script src='js/lang-all.js'></script>