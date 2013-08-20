<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle= 'Iniciar sesión - ' .Yii::app()->name;
?>

<div class="form login">
	<h1>Iniciar sesión</h1>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->errorSummary($model, '', '', array('class' => 'flash-notice') ); ?>


	<div class="row form-group">
		<?php echo $form->label($model,'correo'); ?>
		<?php echo $form->emailField($model,'correo', array('class' => 'form-control')); ?>
	</div>

	<div class="row form-group">
		<?php echo $form->label($model,'password'); ?>
		<?php echo $form->passwordField($model,'password', array('class' => 'form-control')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Iniciar sesión', array('class' =>'btn')); ?>
	</div>

	<div class="row">
		<?php echo CHtml::link('¿Olvidaste tu contraseña?', array('/recuperar-contrasena'), array('class' => 'recuperar btn btn-link' )); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<div id="right-content">
	<?php echo CHtml::link('<span class="resaltado">Regístrate</span> y empieza a jugar', array('registro'), array('class' => 'registrate') )?>
</div>