<div id="content">
	<div class="post">
		<div class="content">
			<?php
			$home = "/home/" . get_current_user() . "/";

			require_once($home . 'public_html/sifsc/user/classes/class.noticia.php');
			require_once($home . 'public_html/sifsc/user/classes/class.inscricao.php');
			require_once($home . 'public_html/sifsc/user/classes/class.evento.php');
			require_once($home . 'public_html/sifsc/user/classes/class.pessoa.php');


			$noticia = new Noticia();
			$evento = new Evento();
			$evento->find_evento_aberto();
			$p2 = $_GET["p2"];

			if(!isset($_GET["p2"])){

				include("noticias/listar.php");
			}
			else if($p2 == "incluir"){

				include("noticias/incluir.php");
			}
			else if($p2 == "alterar"){

				include("noticias/alterar.php");
			}
			else if($p2 == "excluir"){

				include("noticias/excluir.php");
			}

			?>
		</div>
	</div>
</div>
