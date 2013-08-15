<?php
Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/i18n/jquery.ui.datepicker-es.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
Yii::app()->clientScript->registerScript('datepicker', 
	'$(".datepicker").datepicker({dateFormat: "yy-mm-dd", yearRange: "1998:2003", minDate: new Date(1998, 5, 1), maxDate: new Date(2003, 5, 31), changeMonth: true, changeYear: true}, $.datepicker.regional[ "es" ]);', 
	CClientScript::POS_READY);
?>
<div class="form">
<?php 
$activeform = $this->beginWidget('CActiveForm', array(
	'id'=>'registro-form',
	'enableAjaxValidation'=>true,
	'focus'=>array($usuario,'correo'),
));
?>

<?php echo $activeform->errorSummary(array($usuario, $jugador), '', '', array('class' => 'flash-notice')); ?>

<div id="subtitulo">
	<h2>Datos de acceso</h2>
	<p>Recuerda muy bien estos datos, porque los necesitarás para poder comenzar a jugar</p>
</div>

<p>Datos de acceso</p>
<p>Recuerda muy bien estos datos, porque los necesitarás para poder comenzar a jugar</p>
<fieldset>
	<legend>Datos personales</fieldset>
	<div class="row">
		<?php echo $activeform->labelEx($jugador,'nombre'); ?>
		<?php echo $activeform->textField($jugador,'nombre', array('size'=>60,'maxlength'=>100)); ?> 
		<?php echo $activeform->labelEx($jugador,'apellido'); ?>
		<?php echo $activeform->textField($jugador,'apellido', array('size'=>60,'maxlength'=>100)); ?> 
	</div>
	<div class="row">
		<?php echo $activeform->labelEx($jugador,'sexo'); ?>
		<?php echo $activeform->radioButtonList($jugador,'sexo', array('F' => 'Femenino', 'M' => 'Masculino')); ?>
		<?php echo $activeform->error($jugador,'sexo'); ?>
	</div>
	<div class="row">
		<?php echo $activeform->labelEx($jugador,'tipo_documento'); ?>
		<?php echo $activeform->dropDownList($jugador,'tipo_documento',array('empty' => 'Seleccione uno', 'Tarjeta de identidad' => 1, 'Cédula de ciudadanía' => 2, 'Tarjeta extranjero' => 3)); ?>
		<?php echo $activeform->error($jugador,'tipo_documento'); ?>
	</div>
	<div class="row">
		<?php echo $activeform->labelEx($jugador,'documento'); ?>
		<?php echo $activeform->textField($jugador,'documento',array('size'=>45,'maxlength'=>455)); ?>
		<?php echo $activeform->error($jugador,'documento'); ?>
	</div>
	<div class="row">
		<?php echo $activeform->labelEx($jugador,'fecha_nacimiento'); ?>
		<?php echo $activeform->textField($jugador,'fecha_nacimiento', array('class' => 'datepicker')); ?>
		<?php echo $activeform->error($jugador,'fecha_nacimiento'); ?>
	</div>
</fieldset>
<fieldset>
	<legend>Información de contacto</legend>
	<div class="row">
		<?php echo $activeform->labelEx($usuario,'correo'); ?>
		<?php echo $activeform->textField($usuario,'correo',array('size'=>60,'maxlength'=>100)); ?> 
	</div>
	<div class="row">
		<?php echo $activeform->labelEx($jugador,'telefono'); ?>
		<?php echo $activeform->textField($jugador,'telefono',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $activeform->error($jugador,'telefono'); ?>
	</div>
	<div class="row">
		<?php echo $activeform->labelEx($jugador,'celular'); ?>
		<?php echo $activeform->textField($jugador,'celular',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $activeform->error($jugador,'celular'); ?>
	</div>
	<div class="row">
		<?php echo $activeform->labelEx($jugador,'barrio'); ?>
		<?php echo $activeform->dropDownList($jugador,'barrio', CHtml::listData(Barrio::model()->findAll(), 'id', 'nombre') ); ?>
		<?php echo $activeform->error($jugador,'barrio'); ?>
	</div>
	<div class="row">
		<?php echo $activeform->labelEx($jugador,'otra_ciudad'); ?>
		<?php echo $activeform->textField($jugador,'otra_ciudad',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $activeform->error($jugador,'otra_ciudad'); ?>
	</div>
	<div class="row">
		<?php echo $activeform->labelEx($jugador,'nivel_educacion'); ?>
		<?php echo $activeform->dropDownList($jugador,'nivel_educacion',array('empty' => 'Seleccione uno', 'Básica primaria' => 1, 'Bachiller' => 2, 'Profesional' => 3, 'Ninguno' => 4)); ?>
		<?php echo $activeform->error($jugador,'nivel_educacion'); ?>
	</div>
	<div class="row">
		<?php echo $activeform->labelEx($jugador,'ocupacion'); ?>
		<?php echo $activeform->dropDownList($jugador,'ocupacion',CHtml::listData(Ocupacion::model()->findAll(), 'id', 'nombre')); ?>
		<?php echo $activeform->error($jugador,'ocupacion'); ?>
	</div>
	<div class="row">
		<?php echo $activeform->labelEx($jugador,'otra_ocupacion'); ?>
		<?php echo $activeform->textField($jugador,'otra_ocupacion',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $activeform->error($jugador,'otra_ocupacion'); ?>
	</div>
</fieldset>
<fieldset>
	<legend>Comentarios u observaciones</legend>
	<div class="row">
		<?php echo $activeform->labelEx($jugador,'suscripcion'); ?>
		<?php echo $activeform->checkBox($jugador,'suscripcion'); ?>
		<?php echo $activeform->error($jugador,'suscripcion'); ?>
	</div>
</fieldset>
<div class="row buttons submit">
	<?php echo CHtml::submitButton('Registro', array('class'=>'btn')); ?>
</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
