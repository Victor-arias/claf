<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>
<div id="content">
	<?php echo CHtml::link('Registrate', array('/registro'), array('class' => 'btn btn-success btn-lg btn-block') ) )?>
	<?php echo CHtml::link('Inicia sesión', array('/iniciar-sesion'), array('class' => 'btn btn-primary btn-lg btn-block'))?>
</div>