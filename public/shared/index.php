<!DOCTYPE html>
<html dir="ltr" xml:lang="pt-br" lang="pt-br" xmlns="http://www.w3.org/1999/xhtml" manifest="/cache.manifest">
<head>
	
	<title>Curso de Marketing Político | Piauí</title>
	<?php include('shared/head.php');?>
		


</head>
<body>
	<?php include('shared/header.php');?>
	<section id="content">
		<div id="content-center" class="center">
			<div id="col-1" class="left">
				<header class="titulo">
					<h1>O Curso</h1>
				</header>
				<article>
					<p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, 
					e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos 
					e os embaralhou para fazer um livro de modelos de tipos.</p>
				</article>
				
				<header class="titulo">
					<h2>Local</h2>
				</header>
				<article>
					<img class="left" height="109" width="165"></img>
					<p>Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, 
					e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos 
					e os embaralhou para fazer um livro de modelos de tipos.</p>
				</article>
			</div>
			<?php include('shared/aside.php');?>
		</div>
	</section>
	<?php include('shared/footer.php');?>
	<script src="js/jquery-1.6.2.min.js" ></script>
	<script src="js/jquery.nivo.slider.pack.js" ></script>
	<script type="text/javascript">
		$(window).load(function() {
			$('#slider').nivoSlider({
				controlNav: false,
				effect:'boxRainGrow', // Specify sets like: 'fold,fade,sliceDown'       
				boxCols: 8, // For box animations
				boxRows: 7, // For box animations
				animSpeed:900, // Slide transition speed
				pauseTime:3000, // How long each slide will show
			});
		});
    </script>
</body>
</html>