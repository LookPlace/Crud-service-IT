$( "#form-cadastro-produto" ).submit(function( event ) {
	var dados = $(this).serialize();
	jQuery.ajax({
		type: "POST",
		url: "cadastrar_produto.php",
		data: dados,
		success: function(data){
			if(data == 'true'){
				$('.bs-modal-cadastro-produto').modal('hide');
				$('.alert-success').html('Produto cadastrado!');
				$('.alert-success').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-success').addClass('hidden'); 
					$('.alert-success').html('');
					location.reload(); 
				}, 2000);
			}else if(data == 'false'){
				$('.bs-modal-cadastro-produto').modal('hide');
				$('.alert-danger').html('Este produto já está cadastrado!');
				$('.alert-danger').removeClass('hidden');
				$("#produtoCadastrarNome").val('');
				setTimeout(function(){ 
					$('.alert-danger').addClass('hidden'); 
					$('.alert-danger').html('');
					$('.bs-modal-cadastro-produto').modal('show');
					$("#produtoCadastrarNome").focus();
				}, 2000);
			}else{
				$('.bs-modal-cadastro-produto').modal('hide');
				$('.alert-danger').html('Ocorreu um erro no servidor, tente novamente!');
				$('.alert-danger').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-danger').addClass('hidden'); 
					$('.alert-danger').html('');
					$('.bs-modal-cadastro-produto').modal('show');
				}, 2000);
			}
		}
	});
	return false;
});

$( "#form-alterar-produto" ).submit(function( event ) {
	var dados = $(this).serialize();
	jQuery.ajax({
		type: "POST",
		url: "alterar_produto.php",
		data: dados,
		success: function(data){
			if(data == 'true'){
				$('.bs-modal-alterar-produto').modal('hide');
				$('.alert-success').html('Produto alterado!');
				$('.alert-success').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-success').addClass('hidden'); 
					$('.alert-success').html('');
					location.reload(); 
				}, 2000);
			}else{
				$('.bs-modal-alterar-produto').modal('hide');
				$('.alert-danger').html('Ocorreu um erro no servidor, tente novamente!');
				$('.alert-danger').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-danger').addClass('hidden'); 
					$('.alert-danger').html('');
					$('.bs-modal-alterar-produto').modal('show');
				}, 2000);
			}
		}
	});
	return false;
});

$('.btn-modal-excluir-produto').click(function(){
	jQuery.ajax({
		type: "POST",
		url: "excluir_produto.php",
		data: {"id":id_produto_exclusao},
		success: function(data){
			if(data == 'true'){
				$('.bs-modal-excluir-produto').modal('hide');
				$('.alert-success').html('Produto excluido!');
				$('.alert-success').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-success').addClass('hidden'); 
					$('.alert-success').html('');
					location.reload(); 
				}, 2000);
			}else{
				$('.bs-modal-excluir-produto').modal('hide');
				$('.alert-danger').html('Ocorreu um erro no servidor, tente novamente!');
				$('.alert-danger').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-danger').addClass('hidden'); 
					$('.alert-danger').html('');
					$('.bs-modal-excluir-produto').modal('show');
				}, 2000);
			}
		}
	});
});

$('.btn-alterar-produto').click(function(){
	$('#produtoAlterarId').val($(this).data('id'));
	$('#produtoAlterarNome').val($(this).data('nome'));
	$('#produtoAlterarDescricao').val($(this).data('descricao'));
	$('#produtoAlterarPreco').val($(this).data('preco'));
	$('.bs-modal-alterar-produto').modal('show');
});

$('.btn-excluir-produto').click(function(){
	id_produto_exclusao = $(this).data('id');
	$('.bs-modal-excluir-produto').modal('show');
});