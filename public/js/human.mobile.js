/*!
 * Human Mobile v1
 *
 * Copyright 2011, Cândido Sales Gomes
 *
 */
human = {
	getStatusCode:function(status_code){
		switch(status_code){
		case '000':
	        return '<div class="alert_success"><p><img src="/img/icon_accept.png" alt="success" class="mid_align"/>Mensagem enviada com sucesso</p></div>';
	        break;
	    //problemas.
	    	//Criei
		case '002':
			return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="delete" class="mid_align"/>Você selecionou nenhum cliente. Por favor, selecione algum antes de enviar a mensagem.</p></div>';
			break;
	    case '010':
	        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Mensagem vazia</p></div>';
	        break;
	    case '011':
	        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Corpo da mensagem inválido</p></div>';
	        break;
	    case '012':
	        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Corpo da mensagem excedeu o limite. Os campos "from" e "body" devem ter juntos no máximo 150 caracteres.</p></div>';
	        break;
	    case '013':
	        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Número do destinatário está incompleto ou inválido.</p></div>';
	        break;
	    case '014':
	        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Número do destinatário está vazio.</p></div>';
	        break;
	    case '015':
	        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>A data de agendamento está mal formatada. O formato correto deve ser: "dd/MM/aaaa hh:mm:ss".</p></div>';
	        break;
	    case '016':
	        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>O id informado ultrapassou o limite de 20 caracteres.</p></div>';
	        break;
	    case '080':
	        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Já foi enviado uma mensagem de sua conta com o mesmo identificador.</p></div>';
	        break;
		
	    //enviado multiplos
	    case '200':
	    	return '<div class="alert_success"><p><img src="/img/icon_accept.png" alt="success" class="mid_align"/>Requisição aceita pela Human Gateway.</p></div>';
	    	break;
	    //cuidado
	    case '210':
	    	return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Durante o envio sua conta chegou ao limite de segurança estabelecido, algumas mensagens já foram salvas e outras não foram. Contate nosso suporte para liberação do limite.</p></div>';
	    	break;
	    //erros no arquivo
	    case '240':
	    	return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Arquivo vazio ou não enviado.</p></div>';
	    	break;
	    case '241':
	    	return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Arquivo muito grande (mais de 1Mbyte).</p></div>';
	    	break;
	    case '242':
	    	return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Arquivo corrompido ou mal formatado.</p></div>';
	    	break;
	    //enviado multiplos
	    	
		//erros.
	    case '900':
	        return '<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Erro de autenticação em "account" e/ou "code".</p></div>';
	        break;
	    case '990':
	        return '<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Seu limite de segurança foi atingido. Contate nosso suporte para verificação/liberação.</p></div>';
	        break;
	    case '998':
	        return '<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Foi invocada uma operação inexistente.</p></div>';
	        break;
	    case '999':
	        return '<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Erro desconhecido. Contate nosso suporte.</p></div>';
	        break;
		}
	}
}