<?php
/* @var $this SiteController */
$this->pageTitle = 'Ranking - '.Yii::app()->name;
?>
<div id="content-ranking">
	<h1>Puntajes</h1>
	<?php if( Yii::app()->user->hasFlash('error') ):?>
		<div class="flash-notice"><?php echo Yii::app()->user->getFlash('error'); ?></div>
	<?php endif;?>
	<div class="table-responsive">
	<table class="table table-striped table-hover table-condensed">
		<tr>
			<th>Puesto</th>
			<th>Nombre</th>
			<th class="puntaje">Puntaje</th>
		</tr>
		<?php $i = 1; foreach($ranking as $puntos): ?>
		<tr>
			<td class="lugar"><?php echo $i; $i++?></td> 
			<td><?php echo $puntos->nombre ?></td>
			<td class="total"><?php echo $puntos->puntaje ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	</div>
</div>