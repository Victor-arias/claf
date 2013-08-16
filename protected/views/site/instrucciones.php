<div class="row">
	<div class="col-md-8"> 
		<h2>Instrucciones</h2>
		<p>Aqui van las instrucciones</p>
	</div>
	<div class="col-md-4">
		<p class="partido">Partido <?php echo $partido_id;?></p>
		<p><?php echo CHtml::link('Jugar', array('/jugar?partido=' . $partido_id) )?></p>
		<div>
			<ul>
			<?php foreach($partidos as $partido): ?>
				<li><?php echo CHtml::link($partido->nombre, array('instrucciones?partido=' . $partido_id) )?></li>
			<?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>