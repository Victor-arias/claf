<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>
<div id="content">
	<?php echo CHtml::link('Registrate', array('/registro'), array('class' => 'btn btn-success btn-lg') )?>
	<?php echo CHtml::link('Inicia sesión', array('/iniciar-sesion'), array('class' => 'btn btn-primary btn-lg') )?>
</div>