<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>
<div id="content">
	<?php echo CHtml::link('Regístrate', array('registro'), array('class' => 'registrate') )?>
	<?php echo CHtml::link('Iniciar sesión', array('/jugar'), array('class' => 'juega'))?>
</div>