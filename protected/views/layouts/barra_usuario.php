<?php 
$idSesion = Yii::app()->user->id;		
if(!is_null($idSesion)):
	$objUsuario = new Usuario();
	$usuario = $objUsuario->findByPk($idSesion);
	$objJugador = new Jugador();
	$usuario = $objJugador->find("usuario_id = $usuario->id");
	$usuarioConectado = $usuario;	
?>
<div class="row">	
	<div class="span12 well">
		<strong>Jugador:</strong> <?php echo $usuarioConectado->nombre . " " . $usuarioConectado->apellido ?>
		<span class="pull-right">Puntaje Total: <?php echo $usuarioConectado->puntaje . ' | ' . CHtml::link('Cerrar Sesión', 'logout')?></span>
	</div>
</div>
<?php endif; ?>