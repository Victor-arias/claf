<div class="row">
	<div class="col-md-8"> 
		<h2>Instrucciones</h2>
		<p>Entre el 20 y el 26 de agosto la selección Antioquia de fútbol disputará el Campeonato Nacional Prejuvenil de Fútbol en la ciudad de Pereira, en el que Telemedellin, Canal oficial de la Selección, acompañará al equipo con la transmisión en directo de los 4 partidos.</p>
		<p>El concurso consta de 4 rondas, y los ganadores serán las 10 personas que más puntaje acumulen en todas las etapas.</p>
		<p>Cada una de las 4 rondas se activará después de cada partido y quedarán disponibles para participar hasta el 26 de agosto a las 23:59, así:</p>
		<ul>
			<li>Antioquia Vs Sucre 20 de agosto 1:30 p.m. – Ronda 1</li>
			<li>Antioquia Vs Norte de Santander 21 de agosto 10:30 a.m. – Ronda 2</li>
			<li>Antioquia Vs San Andrés 23 de agosto 1:30 p.m.  – Ronda 3</li>
			<li>Antioquia Vs Risaralda 26 de agosto 3:30 p.m. – Ronda 4</li>
		</ul>
		<p>Cada ronda contiene 3 preguntas de diferente nivel de complejidad sobre la Selección Antioquia y los partidos que transmitirá Telemedellín y otorgan el siguiente puntaje:</p>
		<ul>
			<li>Fácil: 10 puntos</li>
			<li>Intermedio: 20 puntos</li>
			<li>Difícil: 30 puntos</li>
		</ul>
		<p>Además, en cada ronda se contará con una cuarta pregunta de bonificación que sólo estará activa después de cada partido y hasta las 23:59 del día de emisión del partido en cuestión. Esta pregunta otorga: 15 puntos</p>
		<p>El plazo máximo para responder las preguntas publicadas es el martes 26 de agosto de 2013 a las 23:59.</p>
	</div>
	<div class="col-md-4">
		<p class="partido">Partido <?php echo $partido_id;?> 
		<?php if( $puntos != 0): ?>
			<span class="badge"><?php echo $puntos ?> puntos</span></p>
		<?php else: ?>
			</p><p><?php echo CHtml::link('Jugar', array('/jugar?partido=' . $partido_id), array('class' => 'btn btn-primary btn-lg') )?></p>
		<?php endif; ?>
		<div>
			<ul class="list-group">
			<?php foreach($partidos as $partido): ?>
				<li class="list-group-item"><?php echo CHtml::link($partido->nombre, array('instrucciones?partido=' . $partido_id), array('class' => 'btn btn-link') )?></li>
			<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>