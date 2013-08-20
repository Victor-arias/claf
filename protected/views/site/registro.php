<?php
Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/i18n/jquery.ui.datepicker-es.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');
Yii::app()->clientScript->registerScript('datepicker', 
	'$(".datepicker").datepicker({dateFormat: "yy-mm-dd", changeMonth: true, yearRange: "1900:2013", changeYear: true}, $.datepicker.regional[ "es" ]);', 
	CClientScript::POS_READY);
Yii::app()->clientScript->registerScript('terminos', 
	'$("#registrarse").click(function(e){
		e.preventDefault();
		if($("#aceptar").attr("checked")) {
			$("#registro-form").submit();
		}
		else{
			alert("Debes aceptar los Términos y Condiciones");
		}
	});', 
	CClientScript::POS_READY);
?>
<div class="form">
<?php 
$activeform = $this->beginWidget('CActiveForm', array(
	"htmlOptions"=>array("class"=>"form-horizontal"),		
	'id'=>'registro-form',
	'enableAjaxValidation'=>false,
	'focus'=>array($usuario,'correo'),
));
?>
<p>Para participar en el concurso Me visto de Antioquia, debes llenar todos los siguientes datos. Ten en cuenta que tu correo electrónico será tu usuario para ingresar y participar.</p>

<?php echo $activeform->errorSummary(array($usuario, $jugador), '', '', array('class' => 'flash-notice')); ?>
<fieldset>
	<legend>Datos de acceso</legend>
	<div class="form-group">
		<?php echo $activeform->labelEx($usuario,'correo', array('class'=>'control-label','for'=>'correo')); ?>
		<div class="controls">
			<?php echo $activeform->textField($usuario,'correo',array('size'=>60,'maxlength'=>100, 'placeholder' => 'Ingrese su correo electrónico')); ?>
			<p class="help-inline"><?php echo $activeform->error($usuario,'correo'); ?></p>
		</div>
	</div>
	<div class="form-group">
		<?php echo $activeform->labelEx($usuario,'password', array('class'=>'control-label','for'=>'password')); ?>
		<div class="controls">
			<?php echo $activeform->passwordField($usuario, "password", array('size'=>60,'maxlength'=>100, 'placeholder' => 'Ingrese una contraseña')) ?>
			<p class="help-inline"><?php echo $activeform->error($usuario,'password'); ?></p>
		</div>
	</div>	
</fieldset>
<fieldset>
	<legend>Datos personales</legend>
	<div class="form-group">
		<?php echo $activeform->labelEx($jugador,'nombre', array('class'=>'control-label','for'=>'nombre')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'nombre', array('size'=>60,'maxlength'=>100,'placeholder'=>'Ingrese sus nombres')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'nombre'); ?></p>
		</div>
	</div>
	<div class="form-group">
		<?php echo $activeform->labelEx($jugador,'apellido', array('class'=>'control-label','for'=>'apellido')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'apellido', array('size'=>60,'maxlength'=>100,'placeholder'=>'Ingrese sus apellidos')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'apellido'); ?></p>
		</div>
	</div>
	<div class="form-group">
		<?php echo $activeform->labelEx($jugador,'sexo', array('class'=>'control-label','for'=>'sexo')); ?>
		<div class="controls">
			<?php echo $activeform->radioButtonList($jugador,'sexo', array('F' => 'Femenino', 'M' => 'Masculino')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'sexo'); ?></p>
		</div>
	</div>
	<div class="form-group">
		<?php echo $activeform->labelEx($jugador,'tipo_documento', array('class'=>'control-label','for'=>'tipo_documento')); ?>
		<div class="controls">
			<?php echo $activeform->dropDownList($jugador,'tipo_documento',array('empty' => 'Seleccione uno', 1 => 'Tarjeta de identidad', 2 => 'Cédula de ciudadanía', 3 => 'Tarjeta extranjero')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'tipo_documento'); ?></p>
		</div>
	</div>
	<div class="form-group">
		<?php echo $activeform->labelEx($jugador,'documento', array('class'=>'control-label','for'=>'tipo_documento')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'documento',array('size'=>45,'maxlength'=>455,'placeholder'=>'Ingrese su documento')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'documento'); ?></p>
		</div>
	</div>	
	<div class="form-group">
		<?php echo $activeform->labelEx($jugador,'fecha_nacimiento', array('class'=>'control-label','for'=>'fecha_nacimiento')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'fecha_nacimiento', array('class' => 'datepicker', 'placeholder'=>'Seleccione su fecha de nacimiento')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'fecha_nacimiento'); ?></p>
		</div>
	</div>										
</fieldset>
<fieldset>
	<legend>Información de contacto</legend>
	<div class="form-group">
		<?php echo $activeform->labelEx($jugador,'telefono', array('class'=>'control-label','for'=>'telefono')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'telefono',array('size'=>45,'maxlength'=>45, 'placeholder' => 'Ingrese su teléfono')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'telefono'); ?></p>
		</div>
	</div>
	<div class="form-group">
		<?php echo $activeform->labelEx($jugador,'celular', array('class'=>'control-label','for'=>'celular')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'celular',array('size'=>45,'maxlength'=>45, 'placeholder' => 'Ingrese su celular')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'celular'); ?></p>
		</div>
	</div>	
	<div class="form-group">
		<?php echo $activeform->labelEx($jugador,'barrio_id', array('class'=>'control-label','for'=>'celular')); ?>
		<div class="controls">
			<?php echo $activeform->dropDownList($jugador,'barrio_id', CHtml::listData(Barrio::model()->findAll(), 'id', 'nombre') ); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'barrio_id'); ?></p>
		</div>
	</div>		
	<div class="form-group">
		<?php echo $activeform->labelEx($jugador,'otra_ciudad', array('class'=>'control-label','for'=>'otra_ciudad')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'otra_ciudad',array('size'=>45,'maxlength'=>45, 'placeholder' => 'Ingrese su ciudad')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'otra_ciudad'); ?></p>
		</div>
	</div>
	<div class="form-group">
		<?php echo $activeform->labelEx($jugador,'nivel_educacion', array('class'=>'control-label','for'=>'nivel_educacion')); ?>
		<div class="controls">
			<?php echo $activeform->dropDownList($jugador,'nivel_educacion',array('empty' => 'Seleccione uno...', 1 => 'Básica primaria', 2 => 'Bachiller', 3 => 'Profesional', 4 => 'Ninguno')); ?>			
			<p class="help-inline"><?php echo $activeform->error($jugador,'nivel_educacion'); ?></p>
		</div>
	</div>
	<div class="form-group">
		<?php echo $activeform->labelEx($jugador,'ocupacion_id', array('class'=>'control-label','for'=>'ocupacion')); ?>
		<div class="controls">
			<?php echo $activeform->dropDownList($jugador,'ocupacion_id',CHtml::listData(Ocupacion::model()->findAll(), 'id', 'nombre')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'ocupacion_id'); ?></p>
		</div>
	</div>
	<div class="form-group">
		<?php echo $activeform->labelEx($jugador,'otra_ocupacion', array('class'=>'control-label','for'=>'otra_ocupacion')); ?>
		<div class="controls">
			<?php echo $activeform->textField($jugador,'otra_ocupacion',array('size'=>45,'maxlength'=>45, 'placeholder' => '')); ?>
			<p class="help-inline"><?php echo $activeform->error($jugador,'otra_ocupacion'); ?></p>
		</div>
	</div>	
	<div class="form-group">
		<?php echo $activeform->checkBox($jugador,'suscripcion'); ?>
		<?php echo $activeform->labelEx($jugador,'suscripcion', array('class'=>'control-label','for'=>'suscripcion')); ?>
		<div class="controls">			
			<p class="help-inline"><?php echo $activeform->error($jugador,'suscripcion'); ?></p>
		</div>
	</div>
	<p><input type="checkbox" id="aceptar" value="0"/> Acepto los <?php echo CHTML::link( 'términos y condiciones de uso', array('/site/page', 'view' => 'terminos-y-condiciones'), array('class' => 'btn btn-link') ); ?></p>	
</fieldset>
<div class="row buttons submit">
	<a href="#" id="registrarse" class="btn">Registrarse</a>
</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
