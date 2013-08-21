<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>
<div class="row">
	<div class="span12">
		<p class="text-center"><?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/banner-concurso-micro.jpg"); ?></p>
	</div>
</div>
<div class="container">
	<p class="lead">Registrate, demuestra tus conocimientos sobre la selección Antioquia, acumula puntos y podrás ganar alguno de los siguientes premios:</p>
		<p><strong>PRIMER PUESTO:</strong> Camiseta  de Selección Antioquia + Camiseta de Celtic + Balón de Celtic + Cámara Digital</p>
		<p><strong>SEGUNDO PUESTO:</strong> Camiseta  de Selección Antioquia + Camiseta de Celtic + Balón de Celtic</p>
		<p><strong>TERCER PUESTO:</strong> Camiseta  de Selección Antioquia + Camiseta de Celtic + Balón de La Liga Antioqueña de Fútbol</p>
		<p><strong>CUARTO PUESTO:</strong> Camiseta  de Selección Antioquia + Balón de La Liga Antioqueña de Fútbol</p>
		<p><strong>QUINTO PUESTO:</strong> Balón de La Liga Antioqueña de Fútbol + Gorra de Liga Antioqueña de Fútbol</p>
		<p><strong>SEXTO AL DÉCIMO PUESTO:</strong> Balón de Alianza Liga Antioqueña de Fútbol y Telemedellín + Souvenir Telemedellín </p>
	<p class="col-sm-6 col-md-6 col-sm-offset-3 col-md-offset-3">
		<?php echo CHtml::link('Registrate', array('/registro'), array('class' => 'btn btn-success btn-lg') )?>
		<?php echo CHtml::link('Inicia sesión', array('/iniciar-sesion'), array('class' => 'btn btn-primary btn-lg') )?>
	</p>
</div>