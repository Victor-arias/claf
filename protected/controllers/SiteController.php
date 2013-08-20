<?php

class SiteController extends Controller
{
	public $user;
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index', 'error', 'login', 'registro', 'puntajes', 'recuperarcontrasena', 'validaridentidad','verificar', 'verificarcorreo'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('instrucciones', 'logout'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$idSesion = Yii::app()->user->id;		
		$objUsuario = new Usuario();
		$usuario = $objUsuario->findByPk($idSesion);
		$this->user = $usuario;		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		if(!is_null($usuario)){
			$this->redirect("site/instrucciones");
		}
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionInstrucciones()
	{
		$idSesion = Yii::app()->user->id;		
		$objUsuario = new Usuario();
		$usuario = $objUsuario->findByPk($idSesion);
		$objJugador = new Jugador();
		$jugador = $objJugador->find("usuario_id = $usuario->id");
		$this->user = $jugador;			
		if( isset($_GET['partido']) ) $partido_id = $_GET['partido'];
		else
		{
			$partido = Partido::model()->find( array('order' => 'fecha DESC') );
			$partido_id = $partido->id;
		}

		$jugador_id =  $jugador->id;
		
		//Verifico si ya jugó el partido solicitado
		$verificar = Ronda::model()->findByAttributes( array('jugador_id' => $jugador_id, 'partido_id' => $partido_id) );
		$puntos = ($verificar) ? $verificar->puntos : 0;

		$partidos = Partido::model()->findAll();
		
		$this->render('instrucciones', array(
				'partidos' 	=> $partidos,
				'partido_id'=> $partido_id,
				'puntos'	=> $puntos,
			)
		);
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model = new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		Yii::app()->session->clear();
		Yii::app()->session->destroy();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionRegistro()
	{
		$usuario = new Usuario;
		$jugador = new Jugador;
		//var_dump($_POST['Jugador']); die();
		if(isset($_POST['Usuario']) AND isset($_POST['Jugador']))
		{
			//$transaction = $usuario->dbConnection->beginTransaction();
			$usuario->attributes = $_POST['Usuario'];
			
        	$jugador->attributes = $_POST['Jugador'];        	

			$usuario->llave_activacion = md5(time());
			$usuario->estado = 1;
			$usuario->es_admin = 0;	        	
			$usuario->password = md5($usuario->password);
			$jugador->usuario_id = 0;
			if($usuario->validate() && $jugador->validate()){
				if($usuario->save()){
					$jugador->usuario_id = $usuario->id;	            
		            
		            if($jugador->save()){
			            $datos = array(	'nombre' 			=> $jugador->nombre,
			            				'correo' 			=> $usuario->correo,
			            				'llave_activacion' 	=> $usuario->llave_activacion
			            				);

			            $this->verificarCorreo($datos);	 
		        		Yii::app()->end();
		            }  
				}
	       	      
			}  
		}

		$this->render('registro', array(
				'usuario' => $usuario,
				'jugador' => $jugador,
			)
		);
	}

	public function actionPuntajes()
	{
		$ranking = Jugador::model()->getRanking();
		$this->render('ranking', array('ranking' => $ranking));
	}//Ranking

	public function actionVerificar($llave_activacion)
	{
		$verificar = Usuario::model()->verificarLlave($llave_activacion);
		if($verificar)
		{
			$mensaje = 'correcto';
			//FALTA ENVIAR CORREO
		}else{
			$mensaje = 'fallido';
			//FALTA MENSAJE DE FALLA
		}
			
		$this->render('verificar', array('mensaje' => $mensaje));
	}

	public function actionRecuperarContrasena()
	{
		$model = new RecuperarForm;

		if(isset($_POST['RecuperarForm']))
		{
			$model->attributes = $_POST['RecuperarForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->generarToken())
				$this->render('recuperar-mensaje', array('mensaje' => 'Por favor revisa tu correo electrónico'));
			else
				$this->render('recuperar',array('model'=>$model));
		}else{
			$this->render('recuperar',array('model'=>$model));
		}
		
	}

	public function actionValidarIdentidad($llave_activacion)
	{
		
		
		$recuperar = Usuario::model()->validarToken($llave_activacion);
		if($recuperar)
		{
			$model = new Usuario;
			if(isset($_POST['Usuario']))
			{
				$model->attributes = $_POST['Usuario'];
				$model->actualizarClave($recuperar->id);
				$this->render('recuperar-mensaje', array('mensaje' => 'Tu nueva contraseña se ha guardado'));
			}
			else
			{
				$this->render('form-recuperar', array('model' => $model));
			}
		}
		else
		{
			$this->render('recuperar-mensaje', array('mensaje' => 'Ooops!'));
		}
		
		
	}

	private function verificarCorreo($datos)
    {   
		$mnino             = new YiiMailer();
        $mnino->setView('verificar-correo');
        $mnino->setData( array('datos' => $datos) );
        $mnino->render();
		$mnino->Subject    = 'Registro ';
        $mnino->AddAddress($datos['correo']);
        $mnino->From = 'comunicaciones@telemedellin.tv';
        $mnino->FromName = 'Concurso Me visto de Antioquia';  
        $mnino->Send();
        
        $this->render('verificar_correo', array('datos' => $datos) );
               
    }
}