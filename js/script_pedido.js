$('.search').click(function(){
	$('.form-search').prop("disabled", true);
	$(this).parents('.input-group').find('.form-search').prop("disabled", false);
});

$( "#form-cadastro-pedido" ).submit(function( event ) {
	var dados = $(this).serialize();
	jQuery.ajax({
		type: "POST",
		url: "cadastrar_pedido.php",
		data: dados,
		success: function(data){
			if(data == 'true'){
				$('.bs-modal-cadastro-pedido').modal('hide');
				$('.alert-success').html('Pedido cadastrado!');
				$('.alert-success').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-success').addClass('hidden'); 
					$('.alert-success').html('');
					location.reload(); 
				}, 2000);
			}else{
				$('.bs-modal-cadastro-pedido').modal('hide');
				$('.alert-danger').html('Ocorreu um erro no servidor, tente novamente!');
				$('.alert-danger').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-danger').addClass('hidden'); 
					$('.alert-danger').html('');
					$('.bs-modal-cadastro-pedido').modal('show');
				}, 2000);
			}
		}
	});
	return false;
});

$( "#form-alterar-pedido" ).submit(function( event ) {
	var dados = $(this).serialize();
	jQuery.ajax({
		type: "POST",
		url: "alterar_pedido.php",
		data: dados,
		success: function(data){
			if(data == 'true'){
				$('.bs-modal-alterar-pedido').modal('hide');
				$('.alert-success').html('Pedido alterado!');
				$('.alert-success').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-success').addClass('hidden'); 
					$('.alert-success').html('');
					location.reload(); 
				}, 2000);
			}else{
				$('.bs-modal-alterar-pedido').modal('hide');
				$('.alert-danger').html('Ocorreu um erro no servidor, tente novamente!');
				$('.alert-danger').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-danger').addClass('hidden'); 
					$('.alert-danger').html('');
					$('.bs-modal-alterar-pedido').modal('show');
				}, 2000);
			}
		}
	});
	return false;
});

$('.btn-modal-excluir-pedido').click(function(){
	jQuery.ajax({
		type: "POST",
		url: "excluir_pedido.php",
		data: {"id":id_pedido_exclusao},
		success: function(data){
			if(data == 'true'){
				$('.bs-modal-excluir-pedido').modal('hide');
				$('.alert-success').html('Pedido excluido!');
				$('.alert-success').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-success').addClass('hidden'); 
					$('.alert-success').html('');
					location.reload(); 
				}, 2000);
			}else{
				$('.bs-modal-excluir-pedido').modal('hide');
				$('.alert-danger').html('Ocorreu um erro no servidor, tente novamente!');
				$('.alert-danger').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-danger').addClass('hidden'); 
					$('.alert-danger').html('');
					$('.bs-modal-excluir-pedido').modal('show');
				}, 2000);
			}
		}
	});
});

$('.form-search.cliente').change(function(){
	var id_cliente = $(this).val();
	jQuery.ajax({
		type: "POST",
		url: "lista_pedidos_cliente.php",
		data: {"id_cliente":id_cliente},
		success: function(data){
			if(data != ''){
				$('#accordion_pedido').html(data);
			}else{
				$('.alert-danger').html('Ocorreu um erro no servidor, tente novamente!');
				$('.alert-danger').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-danger').addClass('hidden'); 
					$('.alert-danger').html('');
				}, 2000);
			}
		}
	});
});

$('.form-search.produto').change(function(){
	var id_produto = $(this).val();
	jQuery.ajax({
		type: "POST",
		url: "lista_pedidos_produto.php",
		data: {"id_produto":id_produto},
		success: function(data){
			if(data != ''){
				$('#accordion_pedido').html(data);
			}else{
				$('.alert-danger').html('Ocorreu um erro no servidor, tente novamente!');
				$('.alert-danger').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-danger').addClass('hidden'); 
					$('.alert-danger').html('');
				}, 2000);
			}
		}
	});
});

$('.btn-alterar-pedido').click(function(){
	var id = $(this).data('id');
	var id_cliente = $(this).data('id-cliente');
	var id_produto = $(this).data('id-produto');
	$('.bs-modal-alterar-pedido select.cliente option').each(function(index){
		if($(this).val() == id_cliente){
			$(this).prop("selected", true);
		}
	});
	$('.bs-modal-alterar-pedido select.produto option').each(function(index){
		if($(this).val() == id_produto){
			$(this).prop("selected", true);
		}
	});
	$('#pedidoAlterarId').val($(this).data('id'));
	$('.bs-modal-alterar-pedido').modal('show');
});

$('.btn-excluir-pedido').click(function(){
	id_pedido_exclusao = $(this).data('id');
	$('.bs-modal-excluir-pedido').modal('show');
});