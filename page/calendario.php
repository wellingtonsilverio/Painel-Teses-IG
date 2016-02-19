<div id='calendar'></div>
<script>
    $(document).ready(function() {

        $('#calendar').fullCalendar({
        	lang: 'pt-br',
        	height: 600,
            events: [
                {title: 'Inauguração do Sistema POS-IG Web', start: '2016-01-01'}
                <?php
                $selectEventos = $objConn->prepare("SELECT * FROM `defesa` ORDER BY `id` ASC");
				$selectEventos->execute();
				while($Eventos = $selectEventos->fetchObject()){
					echo ",{ title: '".$Eventos->titulo." (".$Eventos->nivel.")', start:'".$Eventos->data."' }";
				}
                ?>
            ]
        });
        
    });
</script>