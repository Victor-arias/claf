<?php
/* @var $this JuugarController */
Yii::app()->clientScript->registerCoreScript('jquery'); 
Yii::app()->clientScript->registerScriptFile(Yii::app()->getBaseUrl().'/js/juego.js', CClientScript::POS_HEAD);
?>
<p id="estado">
	<span class="pregunta">Pregunta <span id="numero_pregunta"></span></span> <span id="puntos"></span> <span class="puntos">puntos</span>
</p>
<p class="puntaje-general">Puntaje general </br><span id="total_puntos"></span></p>
<div id="juego-content">
	<div id="mensaje">
		<div></div>
		<a href="#"></a>
	</div>
	<div id="pregunta" class="panel panel-info">
		<p id="p" class="pregunta panel-heading">Cargando ...</p>
		<div class="panel-body">
			<a href="#" id="ra"></a>
			<a href="#" id="rb"></a>
			<a href="#" id="rc"></a>
			<a href="#" id="rd"></a>
		</div>
	</div>
</div>