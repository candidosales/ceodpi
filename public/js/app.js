
	$(".cpf").mask("999.999.999-99");

	//Carrega o relatorio dos SMS
	ajax.relatorioGrafico();
	
	$('.confPgto').click(function(){
			//var id = $(this).attr('id');
			ajax.confirmaPagamento($(this).attr('id'));

			//alert(" "+id);
		});


	$("#btn-buscar, #btn-pdf").fancybox({
		'titlePosition'		: 'inside',
		'transitionIn'		: 'elastic',
		'transitionOut'		: 'elastic'
	});

$('#clientes tr:even').css('background','#FFF');
$('#clientes tr:odd').css('background','#F2F2F2');
$('#clientes tr.conf-green:even').css('background','#C8FFBF');
$('#clientes tr.conf-green:odd').css('background','#97E08B');

	$(".celular").mask("(99) 9999-9999");
	$("#cep").mask("99.999-999");
	$("#cpf").mask("999.999.999-99");   
	$("#celular").mask("(99) 9999-9999");
	$("#data_nasc").mask("99/99/9999"); 

	   function muda(x){
			if(x == '2'){
				$('dt#empresa-label,dd#empresa-element').css('display','block');
				$('dt#instituicao-label,dd#instituicao-element').css('display','none').val(' ');
			}else if(x == '1'){
				$('dt#empresa-label,dd#empresa-element').css('display','none').val(' ');
				$('dt#instituicao-label,dd#instituicao-element').css('display','block');
			}
	 }


		 var value = $("select[id$='tipo']").val();
			muda(value);

		 
		$("select[id$='tipo']").change(function() {
				var val = $(this).val();
				muda(val);
			}); 

$("#form_adicionar_cliente").validate({
		rules: {
			nome: {
				required: true,
				minlength: 4
			},
			email: {
				required: true,
				minlength: 10,
				email: true
				
			},
			cel: {
				required: true,
				minlength: 10
			},		
		},
		messages: {
			nome: {
				required: "Por favor, o nome",
				minlength: "No mínimo 4 caracteres"
			},
			email: {
				required: "Por favor, o e-mail",
				minlength: "No mínimo 10 caracteres",
				email: "Por favor, coloque um e-mail válido."
			},
			cel: {
				required: "Por favor, o celular",
				minlength: "No mínimo 10 caracteres"
			},
		}	
	});


	$("#form_adicionar_cliente_sms").validate({
		rules: {
			nome: {
				required: true,
				minlength: 4
			},
			email: {
				required: true,
				minlength: 10,
				email: true
				
			},
			cel: {
				required: true,
				minlength: 10
			},		
		},
		messages: {
			nome: {
				required: "Por favor, o nome",
				minlength: "No mínimo 4 caracteres"
			},
			email: {
				required: "Por favor, o e-mail",
				minlength: "No mínimo 10 caracteres",
				email: "Por favor, coloque um e-mail válido."
			},
			cel: {
				required: "Por favor, o celular",
				minlength: "No mínimo 10 caracteres"
			},
		},
		submitHandler: function(form) {
			ajaxSMS.adicionarCliente($("#form_adicionar_cliente_sms").serialize());
         } 	
	});

	$('#novo_grupo').fancybox({
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'elastic',
		'href':"#grupo",
	});

	$('#salvar_grupo').click(function(){
			ajaxSMS.adicionarGrupo($('#form_adicionar_grupo').serialize());
		});	

	$('.enviar_mensagem').click(function (){
			var clientes = '';
				$(".clientes_grupo:checked").each(function(){
					clientes = clientes + this.value + ',';
			});
			var mensagem = $('#mensagem').val();
			var assinatura = $('#from').val();
				ajaxSMS.enviarMensagem(clientes,mensagem,assinatura);
		});

	$('#main-nav li:eq(12) a').addClass('current');
	$('#main-nav li:eq(12) a ~ ul').css('display','block');

	//limite de caracteres
	$('#from').limit('18','#char');
	$('#mensagem').limit('103','#char2');