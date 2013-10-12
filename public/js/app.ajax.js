var arrayMapa = null;

//Ajax
ajax = {

			totalClientePorEstado:function(){
				$.get("/admin/cliente/ajax-total-cliente-categoria-estado", function(data){

					//alert(data);
					//$('#debug').css('display','block').html(data);
					data = JSON.parse(data);
					
					arrayMapa = data;
				});
		   },
				
		   relatorioGrafico:function(){
				$.get("/admin/cliente/ajax-datas-relatorio?data=12", function(data){

					//alert(data);
					//$('#debug').css('display','block').html(data);
				
					data = JSON.parse(data);
					Object.size = function(obj) {
					    var size = 0, key;
					    for (key in obj) {
					        if (obj.hasOwnProperty(key)) size++;
					    }
					    return size;
					}
					
					var chart;
					chart = new Highcharts.Chart({
						chart: {
							renderTo: 'relatorio',
							type: 'line'
						},
						title: {
							text: 'N° de inscritos/pagos por dia'
						},
						subtitle: {
							text: ''
						},
						xAxis: {
							categories: [data.inscrito[0].data_inscricao, data.inscrito[1].data_inscricao, data.inscrito[2].data_inscricao,
							             data.inscrito[3].data_inscricao, data.inscrito[4].data_inscricao, data.inscrito[5].data_inscricao,
							             data.inscrito[6].data_inscricao, data.inscrito[7].data_inscricao, data.inscrito[8].data_inscricao,
							             data.inscrito[9].data_inscricao, data.inscrito[10].data_inscricao, data.inscrito[11].data_inscricao]
						},
						yAxis: {
							title: {
								text: 'Quantidade de Inscritos/Pagos'
							}
						},
						tooltip: {
							enabled: false,
							formatter: function() {
								return '<b>'+ this.series.name +'</b><br/>'+
									this.x +': '+ this.y ;
							}
						},
						plotOptions: {
							line: {
								dataLabels: {
									enabled: true
								},
								enableMouseTracking: false
							}
						},
						legend: {
								layout: 'vertical',
								align: 'right',
								verticalAlign: 'top',
								x: -100,
								y: 100,
								floating: true,
								borderWidth: 1,
								backgroundColor: '#FFFFFF',
								shadow: true
							},
						series: [{
							name: 'Inscritos',
							data: [data.inscrito[0].qtd_clientes_inscritos, data.inscrito[1].qtd_clientes_inscritos, data.inscrito[2].qtd_clientes_inscritos,
							       data.inscrito[3].qtd_clientes_inscritos, data.inscrito[4].qtd_clientes_inscritos, data.inscrito[5].qtd_clientes_inscritos,
							       data.inscrito[6].qtd_clientes_inscritos, data.inscrito[7].qtd_clientes_inscritos, data.inscrito[8].qtd_clientes_inscritos,
							       data.inscrito[9].qtd_clientes_inscritos, data.inscrito[10].qtd_clientes_inscritos, data.inscrito[11].qtd_clientes_inscritos]
						},{
							name: 'Pagos',
							data: [data.pago[0].qtd_clientes_pagos, data.pago[1].qtd_clientes_pagos, data.pago[2].qtd_clientes_pagos,
							       data.pago[3].qtd_clientes_pagos, data.pago[4].qtd_clientes_pagos, data.pago[5].qtd_clientes_pagos,
							       data.pago[6].qtd_clientes_pagos, data.pago[7].qtd_clientes_pagos, data.pago[8].qtd_clientes_pagos,
							       data.pago[9].qtd_clientes_pagos, data.pago[10].qtd_clientes_pagos, data.pago[11].qtd_clientes_pagos,]
						},]
					});

					var chart2;
					chart2 = new Highcharts.Chart({
						chart: {
							renderTo: 'relatorio2',
							type: 'column'
						},
						title: {
							text: 'Total de inscritos/pagos'
						},
						xAxis: {
							categories: ['Total']
						},
						yAxis: {
							title: {
								text: 'Total de Inscritos/Pagos'
							}
						},
						tooltip: {
							formatter: function() {
								return ''+
									 this.series.name +': '+ this.y +'';
							}
						},
						legend: {
							layout: 'vertical',
							align: 'right',
							verticalAlign: 'top',
							x: -100,
							y: 100,
							floating: true,
							borderWidth: 1,
							backgroundColor: '#FFFFFF',
							shadow: true
						},
						plotOptions: {
								 column: {
									dataLabels: {
										enabled: true,
										style: {
											fontWeight: 'bold'
										},
										formatter: function() {
											return this.y ;
										}
									}
								}
							},
						credits: {
							enabled: false
						},
						series: [{
							name: 'Inscritos',
							data: [data.inscritos]
						}, {
							name: 'Pagos',
							data: [data.pagos]
						}, {
							name: 'Não pagos',
							data: [data.nao_pagos]
						}, {
							name: 'Apoio',
							data: [data.apoio]
						}, {
							name: 'Convite',
							data: [data.convite]
						}, {
							name: 'Imprensa',
							data: [data.imprensa]
						}]
					});


					});
			   },

		listaClientes: function(){
				   },

		confirmaPagamento: function(dados){
		       $.ajax({
	               url:'/admin/cliente/ajax-confirma-pagamento',
	               dataType:'html',
	               data: {id:dados},
	               type:'POST',
	               beforeSend: function() {	
	            	   $('#loading_clientes').css('display','block').html('<p>Aguarde. Confirmando pagamento...</p><img style="margin:0 auto" src="/img/ajax-loader.gif"/>');
					},
	               success: function(data,textStatus){

	            	   data = JSON.parse(data); 	
						
					   if(data.valor=='1'){
						//confirmado com sucesso
						   alert('Confirmado o pagamento de '+data.nome+' com sucesso!');
						   $('.message').css('display','block').html('<div class="alert_success"><p><img src="/img/icon_accept.png" alt="success" class="mid_align"/>Confirmado pagamento com sucesso!</p></div>');
						   $('.conf-'+dados).html('<img title="Pagamento confirmado de '+data.nome+' " src="/img/icon/success2.png"/>');
						   $('tr.id-'+dados).css('background','#97E08B');

						   ajax.relatorioGrafico();
						}else if(data.valor=='0'){
						   $('.message').css('display','block').html('<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Lamento, ocorreu um erro na conexÃ£o com o banco de dados. Tente novamente.</p></div>'); 
				        }else if(data.valor=='2'){
						   $('.message').css('display','block').html('<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Por favor, selecione um cliente vÃ¡lido.</p></div>'); 
				        }	 
	               },
	               error: function(XMLHttpRequest, textStatus, errorThrown){
	            	   $('.message').html('<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Lamento, ocorreu um erro na conexÃ£o com o banco de dados. Tente novamente.</p></div>'); 
	            	   alert('loading, ocorreu um erro na conexÃ£o com o banco de dados.');
					},
	               complete: function(){
	            	   		$('#loading_clientes').css('display','none');                 
		               }
	       });
			}
	}

		//Ajax
	ajaxSMS = {

			adicionarCliente:function(dados){
			       $.ajax({
		               url:'/admin/cliente/ajax-adicionar-cliente',
		               dataType:'json',
		               data: dados,
		               type:'POST',
		               beforeSend: function() {	
						   $('#loading_cliente').css('display','block').html('<p>Aguarde. Salvando cliente...</p><img style="margin:0 auto" src="/img/ajax-loader.gif"/>');
						},
		               success: function(data,textStatus){	

							//$('#debug').css('display','block').html(data);
			               		               
		            	   if(data.valor=='1'){
		            		   $('.message').css('display','block').html('<div class="alert_success"><p><img src="/img/icon_accept.png" alt="success" class="mid_align"/>Cliente adicionado com sucesso!</p></div>');
		            		   ajaxSMS.arvoreClientesGrupo();
				           }else if(data.valor=='0'){
			            	   $('.message').css('display','block').html('<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Ocorreu um erro no momento de salvar. Tente novamente ou contate o suporte.</p></div>'); 
						   } 		 
		               },
		               error: function(XMLHttpRequest, textStatus, errorThrown){
		            	   $('.message').html('<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Lamento, ocorreu um erro na conexão com o banco de dados.</p></div>'); 
		            	   alert('loading_cliente, ocorreu um erro na conexão com o banco de dados.'+textStatus+' '+errorThrown);
						},
		               complete: function(){
			            	   $('#loading_cliente').css('display','none');               
			               }
		       });
			},

			adicionarGrupo:function(dados){
					$.ajax({
			               url:'/admin/sms/ajax-adicionar-grupo',
			               dataType:'json',
			               data: dados,
			               type:'POST',
			               beforeSend: function() {	
							   $.fancybox.close();
							   $('#loading_cliente').css('display','block').html('<p>Aguarde. Salvando grupo...</p><img style="margin:0 auto" src="/img/ajax-loader.gif"/>');
			            	   $('#select_grupo').css('display','none');
							},
			               success: function(data,textStatus){			               
			            	   if(data.valor=='1'){
			            		   $('.message').css('display','block').html('<div class="alert_success"><p><img src="/img/icon_accept.png" alt="success" class="mid_align"/>Grupo adicionado com sucesso!</p></div>'); 
								   ajaxSMS.selectGrupo();
				               }else if(data.valor=='0'){
				            	   $('.message').css('display','block').html('<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Ocorreu um erro no momento de salvar. Tente novamente ou contate o suporte.</p></div>'); 
					           } 
			               },
			               error: function(XMLHttpRequest, textStatus, errorThrown){
			            	   $('.message').css('display','block').html('<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Lamento, ocorreu um erro na conexão com o banco de dados.</p></div>'); 
			            	   alert('Lamento, ocorreu um erro na conexão com o banco de dados.');
							},
			               complete: function(){
								   $.fancybox.close();
				            	   $('#loading_cliente').css('display','none');               
				               }
			       });
				},

			selectGrupo:function(){
					$.ajax({
						url:'/admin/sms/ajax-select-grupo',
			        	dataType:'html',
			        	data:({id:1}),
			        	type:'POST',
			            beforeSend: function() {
						   $('#loading_cliente').css('display','block').html('<p>Aguarde. Carregando grupos...</p><img style="margin:0 auto" src="/img/ajax-loader.gif"/>');
						   $('#select_grupo').css('display','none');
						},
			           success: function(data,textStatus){	               
			        	   $('#select_grupo').css('display','').html(data);          	              
			           },
			           error: function(XMLHttpRequest, textStatus, errorThrown){ 
			        	   $('.message').html('<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Lamento, ocorreu um erro na conexão com o banco de dados.</p></div>'); 
			        	   alert('Lamento, ocorreu um erro na conexão com o banco de dados.');
						},
			           complete: function(){
			            	   $('#loading_cliente').css('display','none');               
			               }
					});
				},

				enviarMensagem:function(clientes,mensagem,assinatura){
					       $.ajax({
				               url:'/admin/sms/ajax-enviar-mensagem',
				               dataType:'html',
				               data: ({clientes:clientes, mensagem:mensagem, assinatura:assinatura}),
				               type:'POST',
				               beforeSend: function() {		
								   $('#loading_clientes_grupo').css('display','block').html('<p>Aguarde. Enviando mensagem(ns)...</p><img style="margin:0 auto" src="/img/ajax-loader.gif"/>');
								   $('#clientes_grupo').css('display','none');
								},
				               success: function(data,textStatus){	
						           $('#debug').html(data);
						           $('.message').css('display','block').html(human.getStatusCode(data));
						           ajaxSMS.arvoreClientesGrupo();
						           ajaxSMS.relatorioGrafico();		 
				               },
				               error: function(XMLHttpRequest, textStatus, errorThrown){
				            	   $('.message').html('<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Lamento, ocorreu um erro na conexão com o banco de dados.</p></div>'); 
				            	   alert('loading_cliente, ocorreu um erro na conexão com o banco de dados.');
								},
				               complete: function(){
					            	   $('#loading_clientes_grupo').css('display','none');               
					               }
				       });
					},

				arvoreClientesGrupo:function(){
					       $.ajax({
				               url:'/admin/sms/ajax-clientes-por-grupo',
				               dataType:'html',
				               data: ({id:1}),
				               type:'POST',
				               beforeSend: function() {	
								   $('#loading_clientes_grupo').css('display','block').html('<p>Aguarde. Carregando clientes...</p><img style="margin:0 auto" src="/img/ajax-loader.gif"/>');
								   $('#clientes_grupo').css('display','none');
								},
				               success: function(data,textStatus){			               
				            	   $('#clientes_grupo').css('display','').html(data); 
	
				            	   $("#browser").treeview({
										toggle: function() {
											console.log("%s was toggled.", $(this).find(">span").text());
										}
									});
	
				            		$('input[name=grupo]').click(function (){
				            			var checked_status = this.checked; //Captura seu estado, se está marcado ou não
				            			var id = $(this).attr('id');
				            			$("input[name=cliente_"+id+"]").each(function(){ this.checked = checked_status; });	
				            		}); 		 
				               },
				               error: function(XMLHttpRequest, textStatus, errorThrown){
				            	   $('.message').css('display','block').html('<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Lamento, ocorreu um erro na conexão com o banco de dados.</p></div>'); 
				            	   alert('loading_cliente, ocorreu um erro na conexão com o banco de dados.');
								},
				               complete: function(){
					            	   $('#loading_clientes_grupo').css('display','none');               
					               }
				       });
					},
					
			   relatorioGrafico:function(){
					$.get("/admin/sms/ajax-datas-relatorio", function(data){
						data = JSON.parse(data);
						Object.size = function(obj) {
						    var size = 0, key;
						    for (key in obj) {
						        if (obj.hasOwnProperty(key)) size++;
						    }
						    return size;
						}
						
						var chart;
						chart = new Highcharts.Chart({
							chart: {
								renderTo: 'relatorio',
								defaultSeriesType: 'line'
							},
							title: {
								text: 'N° de SMS enviados por dia'
							},
							subtitle: {
								text: ''
							},
							xAxis: {
								categories: [data.sms[0].data_envio, data.sms[1].data_envio, data.sms[2].data_envio,
								             data.sms[3].data_envio, data.sms[4].data_envio, data.sms[5].data_envio,
								             data.sms[6].data_envio, data.sms[7].data_envio, data.sms[8].data_envio,
								             data.sms[9].data_envio, data.sms[10].data_envio, data.sms[11].data_envio]
							},
							yAxis: {
								title: {
									text: 'Quantidade SMS'
								}
							},
							tooltip: {
								enabled: false,
								formatter: function() {
									return '<b>'+ this.series.name +'</b><br/>'+
										this.x +': '+ this.y ;
								}
							},
							plotOptions: {
								line: {
									dataLabels: {
										enabled: true
									},
									enableMouseTracking: false
								}
							},
							series: [{
								name: 'SMS',
								data: [data.sms[0].qtd_sms_enviado, data.sms[1].qtd_sms_enviado, data.sms[2].qtd_sms_enviado,
								       data.sms[3].qtd_sms_enviado, data.sms[4].qtd_sms_enviado, data.sms[5].qtd_sms_enviado,
								       data.sms[6].qtd_sms_enviado, data.sms[7].qtd_sms_enviado, data.sms[8].qtd_sms_enviado,
								       data.sms[9].qtd_sms_enviado, data.sms[10].qtd_sms_enviado, data.sms[11].qtd_sms_enviado]
							}]
						});


						});
				   }
		}



	 /**/
	
	//Carrega o select do grupo
	ajaxSMS.selectGrupo();
	//Carrega os checkbos dos clientes por grupo
	ajaxSMS.arvoreClientesGrupo();
	//Carrega o relatorio dos SMS
	ajaxSMS.relatorioGrafico();	