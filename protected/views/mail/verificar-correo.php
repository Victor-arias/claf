<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="language" content="es" />
</head>
<body bgcolor="#eee" style="background-color: #eee;">
	<center>
	<table  bgcolor="#fff" style="display: inline-table; margin:0 auto" border="0" cellpadding="0" cellspacing="0" width="605">
		<tr>
			<td>
				<img src="http://concursomedellin2018.com/images/mail/header-mail.jpg" width="605" height="154" />
			</td>
		</tr>
		<tr>
			<td>
				<center>
				<table style="display: inline-table; margin:0 auto" border="0" cellpadding="0" cellspacing="0" width="500">
					<h3>Hola <?php echo $datos['nombre']; ?>, </h3>
					<p>Este correo se genera automáticamente para confirmar tu inscripción al concurso “Me visto de Antioquia” de Telemedellín.</p>
					<p>Ya podés comenzar a participar en <?php echo CHtml::link('www.telemedellin.tv', CHtml::normalizeUrl('http://www.telemedellin.tv') ); ?></p>
				</table>
				</center>
			</td>
		</tr>
		<tr>
			<td>
				<img src="http://concursomedellin2018.com/images/mail/footer-mail.jpg" width="605" height="113" />
			</td>
		</tr>
	</table>
	</center>
</body>
</html>