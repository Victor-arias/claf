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
	<div class="span12 well well-sm">
		<?php echo CHtml::link('<span class="glyphicon glyphicon-home"></span> Inicio', Yii::app()->request->baseUrl, array('class' => 'btn btn-link')) ?>
		<span class="pull-right">
			<strong>Jugador:</strong> <?php echo $usuarioConectado->nombre . " " . $usuarioConectado->apellido ?> 
			<span class="badge"><?php echo $usuarioConectado->puntaje ?> puntos</span> 
			<?php echo ' | ' . CHtml::link('Cerrar Sesión', array('site/logout'), array('class' => 'btn btn-danger btn-xs'))?>
		</span>
	</div>
</div>
<?php else: ?>
<div class="row">	
	<div class="span12 well well-sm">
		<?php echo CHtml::link('<span class="glyphicon glyphicon-home"></span> Inicio', Yii::app()->request->baseUrl, array('class' => 'btn btn-link')) ?>
	</div>
</div>	
<?php endif; ?>