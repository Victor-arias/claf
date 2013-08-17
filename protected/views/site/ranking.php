<?php
/* @var $this SiteController */
$this->pageTitle = 'Ranking - '.Yii::app()->name;
?>
<div id="content-ranking">
	<h1>Puntajes</h1>
	<?php if( Yii::app()->user->hasFlash('error') ):?>
		<div class="flash-notice"><?php echo Yii::app()->user->getFlash('error'); ?></div>
	<?php endif;?>
	<div>
		<p>Puesto</p>
		<p>Nombre</p>
		<p class="puntaje">Puntaje</p>
		<ul>
		<?php $i = 1; foreach($ranking as $puntos): ?>
			<li><span class="lugar"><?php echo $i; $i++?></span> <?php echo $puntos->nombre ?> <span class="total"><?php echo $puntos->puntaje ?></span></li>
		<?php endforeach; ?>
		</ul>
	</div>
</div>