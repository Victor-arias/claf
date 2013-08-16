<div class="row">
	<div class="col-md-8"> 
		<h2>Instrucciones</h2>
		<p>Aqui van las instrucciones</p>
	</div>
	<div class="col-md-4">
		<p>Partido <span class="partido_numero">#</span></p>
		<p><a href="jugar">Jugar</a>
		<div>
			<ul>
			<?php foreach($partidos as $partido): ?>
				<li><?php echo CHtml::link($partido->nombre, array('jugar?partido=' . $partido->id) )?></li>
			<?php endif; ?>
			</ul>
		</div>
	</div>
</div>