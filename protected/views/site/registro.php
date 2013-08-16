<?php
Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/i18n/jquery.ui.datepicker-es.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
Yii::app()->clientScript->registerScript('datepicker', 
	'$(".datepicker").datepicker({dateFormat: "yy-mm-dd", changeMonth: true, yearRange: "1900:2013", changeYear: true}, $.datepicker.regional[ "es" ]);', 
	CClientScript::POS_READY);
?>
<div class="form">
<?php 
$activeform = $this->beginWidget('CActiveForm', array(
	"htmlOptions"=>array("class"=>"form-horizontal"),		
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
	<div class="control-group">
		<?php echo $activeform->labelEx($jugador,'nombre', array('class'=>'control-label','for'=>'nombre')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'nombre', array('size'=>60,'maxlength'=>100,'placeholder'=>'Ingrese sus nombres')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'nombre'); ?></p>
		</div>
	</div>
	<div class="control-group">
		<?php echo $activeform->labelEx($jugador,'apellido', array('class'=>'control-label','for'=>'apellido')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'apellido', array('size'=>60,'maxlength'=>100,'placeholder'=>'Ingrese sus apellidos')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'apellido'); ?></p>
		</div>
	</div>
	<div class="control-group">
		<?php echo $activeform->labelEx($jugador,'sexo', array('class'=>'control-label','for'=>'sexo')); ?>
		<div class="controls">
			<?php echo $activeform->radioButtonList($jugador,'sexo', array('F' => 'Femenino', 'M' => 'Masculino')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'sexo'); ?></p>
		</div>
	</div>
	<div class="control-group">
		<?php echo $activeform->labelEx($jugador,'tipo_documento', array('class'=>'control-label','for'=>'tipo_documento')); ?>
		<div class="controls">
			<?php echo $activeform->dropDownList($jugador,'tipo_documento',array('empty' => 'Seleccione uno', 1 => 'Tarjeta de identidad', 2 => 'Cédula de ciudadanía', 3 => 'Tarjeta extranjero')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'tipo_documento'); ?></p>
		</div>
	</div>
	<div class="control-group">
		<?php echo $activeform->labelEx($jugador,'documento', array('class'=>'control-label','for'=>'tipo_documento')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'documento',array('size'=>45,'maxlength'=>455,'placeholder'=>'Ingrese su documento')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'documento'); ?></p>
		</div>
	</div>	
	<div class="control-group">
		<?php echo $activeform->labelEx($jugador,'fecha_nacimiento', array('class'=>'control-label','for'=>'fecha_nacimiento')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'fecha_nacimiento', array('class' => 'datepicker', 'placeholder'=>'Seleccione su fecha de nacimiento')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'fecha_nacimiento'); ?></p>
		</div>
	</div>										
</fieldset>
<fieldset>
	<legend>Información de contacto</legend>
	<div class="control-group">
		<?php echo $activeform->labelEx($usuario,'correo', array('class'=>'control-label','for'=>'correo')); ?>
		<div class="controls">
			<?php echo $activeform->textField($usuario,'correo',array('size'=>60,'maxlength'=>100, 'placeholder' => 'Ingrese su correo electrónico')); ?>
			<p class="help-inline"><?php echo $activeform->error($usuario,'correo'); ?></p>
		</div>
	</div>
	<div class="control-group">
		<?php echo $activeform->labelEx($jugador,'telefono', array('class'=>'control-label','for'=>'telefono')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'telefono',array('size'=>45,'maxlength'=>45, 'placeholder' => 'Ingrese su teléfono')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'telefono'); ?></p>
		</div>
	</div>
	<div class="control-group">
		<?php echo $activeform->labelEx($jugador,'celular', array('class'=>'control-label','for'=>'celular')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'celular',array('size'=>45,'maxlength'=>45, 'placeholder' => 'Ingrese su celular')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'celular'); ?></p>
		</div>
	</div>	
	<div class="control-group">
		<?php echo $activeform->labelEx($jugador,'barrio', array('class'=>'control-label','for'=>'celular')); ?>
		<div class="controls">
			<?php echo $activeform->dropDownList($jugador,'barrio', CHtml::listData(Barrio::model()->findAll(), 'id', 'nombre') ); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'barrio'); ?></p>
		</div>
	</div>		
	<div class="control-group">
		<?php echo $activeform->labelEx($jugador,'otra_ciudad', array('class'=>'control-label','for'=>'otra_ciudad')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'otra_ciudad',array('size'=>45,'maxlength'=>45, 'placeholder' => 'Ingrese su ciudad')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'otra_ciudad'); ?></p>
		</div>
	</div>
	<div class="control-group">
		<?php echo $activeform->labelEx($jugador,'nivel_educacion', array('class'=>'control-label','for'=>'nivel_educacion')); ?>
		<div class="controls">
			<?php echo $activeform->dropDownList($jugador,'nivel_educacion',array('empty' => 'Seleccione uno...', 1 => 'Básica primaria', 2 => 'Bachiller', 3 => 'Profesional', 4 => 'Ninguno')); ?>			
			<p class="help-inline"><?php echo $activeform->error($jugador,'nivel_educacion'); ?></p>
		</div>
	</div>
	<div class="control-group">
		<?php echo $activeform->labelEx($jugador,'ocupacion', array('class'=>'control-label','for'=>'ocupacion')); ?>
		<div class="controls">
			<?php echo $activeform->dropDownList($jugador,'ocupacion',CHtml::listData(Ocupacion::model()->findAll(), 'id', 'nombre')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'ocupacion'); ?></p>
		</div>
	</div>
	<div class="control-group">
		<?php echo $activeform->labelEx($jugador,'otra_ocupacion', array('class'=>'control-label','for'=>'otra_ocupacion')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'otra_ocupacion',array('size'=>45,'maxlength'=>45, 'placeholder' => '')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'otra_ocupacion'); ?></p>
		</div>
	</div>	
</fieldset>
<fieldset>
	<div class="control-group">
		<?php echo $activeform->checkBox($jugador,'suscripcion'); ?>
		<?php echo $activeform->labelEx($jugador,'suscripcion', array('class'=>'control-label','for'=>'suscripcion')); ?>
		<div class="controls">			
			<p class="help-inline"><?php echo $activeform->error($jugador,'suscripcion'); ?></p>
		</div>
	</div>	
</fieldset>
<div class="row buttons submit">
	<?php echo CHtml::submitButton('Registro', array('class'=>'btn')); ?>
</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
