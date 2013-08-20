<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
	<meta name="description" content="">
	<meta name="author" content="telemedellin.tv">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div class="container">
	<?php echo $this->renderPartial('//layouts/barra_usuario') ?>
	<?php echo $content; ?>
	<div class="clear"></div>
	<footer>
		<?php echo CHTML::link( 'Términos y condiciones', array('/site/page', 'view' => 'terminos-y-condiciones') ); ?>
		<?php echo CHTML::link( 'Puntajes', array('/site/page', 'view' => 'puntajes') ); ?>
	</footer>
</div><!-- page -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
</body>
</html>
