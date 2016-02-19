$('document').ready(function(){
	$('.pesquisa').keyup(function(){
		var $this = $(this);
		var pesquisa = $this.val();
		if(pesquisa != ""){
			$.ajax({
				url: "class/busca.php",
				type: "POST",
				data: {pesquisa: pesquisa},
				cache: false,
				success: function(res){
					$('.display-pesquisa').html(res);
				}
			});
		}else{
			$('.display-pesquisa').html("");
		}
	});
	$('.nomeMembro').keyup(function(){
		var $this = $(this);
		var pesquisa = $this.val();
		if(pesquisa != ""){
			$.ajax({
				url: "class/buscaM.php",
				type: "POST",
				data: {pesquisa: pesquisa},
				cache: false,
				success: function(res){
					$('.display-membro').html(res);
				}
			});
		}else{
			$('.display-membro').html("");
		}
	});
	$('body, html').click(function(){
		$('.display-pesquisa').html("");
		$('.display-membro').html("");
		$('.pesquisa').val("");
	});
});