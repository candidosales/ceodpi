<div id="pdf" style="margin: 0 auto">
	<form action="/admin/cliente/export-pdf" method="post">
	<h2><img src="/img/icon/pdf.gif" style="padding-right:10px"></img>Como você quer o seu pdf?</h2>
	<p>
	<input type="radio" name="tipo_pdf" value="todos" checked/> Todos os inscritos
	</p><br />
	<p>
	<input type="radio" name="tipo_pdf" value="pagos" /> Somente os pagos
	</p><br />
	<p>
	<input type="radio" name="tipo_pdf" value="nao_pagos" /> Somente os não pagos
	</p><br />
	<p style="padding-top:10px;border-top:1px solid #ccc">
	<input type="submit" id="btn_modal" value="Criar"/>
	</p>
	<br/>
	</form>
</div>