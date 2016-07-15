$( "#form-cadastro-cliente" ).submit(function( event ) {
	var dados = $(this).serialize();
	jQuery.ajax({
		type: "POST",
		url: "cadastrar_cliente.php",
		data: dados,
		success: function(data){
			if(data == 'true'){
				$('.bs-modal-cadastro-cliente').modal('hide');
				$('.alert-success').html('Cliente cadastrado!');
				$('.alert-success').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-success').addClass('hidden'); 
					$('.alert-success').html('');
					location.reload(); 
				}, 2000);
			}else if(data == 'false'){
				$('.bs-modal-cadastro-cliente').modal('hide');
				$('.alert-danger').html('Este cliente já está cadastrado!');
				$('.alert-danger').removeClass('hidden');
				$("#clienteCadastrarNome").val('');
				setTimeout(function(){ 
					$('.alert-danger').addClass('hidden'); 
					$('.alert-danger').html('');
					$('.bs-modal-cadastro-cliente').modal('show');
					$("#clienteCadastrarNome").focus();
				}, 2000);
			}else{
				$('.bs-modal-cadastro-cliente').modal('hide');
				$('.alert-danger').html('Ocorreu um erro no servidor, tente novamente!');
				$('.alert-danger').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-danger').addClass('hidden'); 
					$('.alert-danger').html('');
					$('.bs-modal-cadastro-cliente').modal('show');
				}, 2000);
			}
		}
	});
	return false;
});

$( "#form-alterar-cliente" ).submit(function( event ) {
	var dados = $(this).serialize();
	jQuery.ajax({
		type: "POST",
		url: "alterar_cliente.php",
		data: dados,
		success: function(data){
			if(data == 'true'){
				$('.bs-modal-alterar-cliente').modal('hide');
				$('.alert-success').html('Cliente alterado!');
				$('.alert-success').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-success').addClass('hidden'); 
					$('.alert-success').html('');
					location.reload(); 
				}, 2000);
			}else{
				$('.bs-modal-alterar-cliente').modal('hide');
				$('.alert-danger').html('Ocorreu um erro no servidor, tente novamente!');
				$('.alert-danger').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-danger').addClass('hidden'); 
					$('.alert-danger').html('');
					$('.bs-modal-alterar-cliente').modal('show');
				}, 2000);
			}
		}
	});
	return false;
});

$('.btn-modal-excluir-cliente').click(function(){
	jQuery.ajax({
		type: "POST",
		url: "excluir_cliente.php",
		data: {"id":id_cliente_exclusao},
		success: function(data){
			if(data == 'true'){
				$('.bs-modal-excluir-cliente').modal('hide');
				$('.alert-success').html('Cliente excluido!');
				$('.alert-success').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-success').addClass('hidden'); 
					$('.alert-success').html('');
					location.reload(); 
				}, 2000);
			}else{
				$('.bs-modal-excluir-cliente').modal('hide');
				$('.alert-danger').html('Ocorreu um erro no servidor, tente novamente!');
				$('.alert-danger').removeClass('hidden');
				setTimeout(function(){ 
					$('.alert-danger').addClass('hidden'); 
					$('.alert-danger').html('');
					$('.bs-modal-excluir-cliente').modal('show');
				}, 2000);
			}
		}
	});
});

$('.btn-alterar-cliente').click(function(){
	$('#clienteAlterarId').val($(this).data('id'));
	$('#clienteAlterarNome').val($(this).data('nome'));
	$('#clienteAlterarEmail').val($(this).data('email'));
	$('#clienteAlterarTelefone').val($(this).data('telefone'));
	$('.bs-modal-alterar-cliente').modal('show');
});

$('.btn-excluir-cliente').click(function(){
	id_cliente_exclusao = $(this).data('id');
	$('.bs-modal-excluir-cliente').modal('show');
});

jQuery("#clienteCadastrarTelefone").mask("(99) 9999-9999?9").focusout(function (event) {  
	var target, phone, element;  
	target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
	phone = target.value.replace(/\D/g, '');
	element = $(target);  
	element.unmask();  
	if(phone.length > 10) {  
		element.mask("(99) 99999-999?9");  
	} else {  
		element.mask("(99) 9999-9999?9");  
	}  
});