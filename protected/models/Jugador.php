<?php

/**
 * This is the model class for table "jugador".
 *
 * The followings are the available columns in table 'jugador':
 * @property string $id
 * @property string $usuario_id
 * @property string $nombre
 * @property string $apellido
 * @property string $sexo
 * @property integer $tipo_documento
 * @property string $documento
 * @property string $fecha_nacimiento
 * @property string $telefono
 * @property string $celular
 * @property string $barrio_id
 * @property string $otra_ciudad
 * @property integer $nivel_educacion
 * @property string $ocupacion_id
 * @property string $otra_ocupacion
 * @property string $fecha_registro
 * @property string $puntaje
 * @property integer $suscripcion
 *
 * The followings are the available model relations:
 * @property Usuario $usuario
 * @property Barrio $barrio
 * @property Ocupacion $ocupacion
 */
class Jugador extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Jugador the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jugador';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usuario_id, nombre, apellido, sexo, tipo_documento, documento, fecha_nacimiento, telefono, celular, barrio_id, nivel_educacion, ocupacion_id, fecha_registro, puntaje, suscripcion', 'required'),
			array('tipo_documento, nivel_educacion, suscripcion', 'numerical', 'integerOnly'=>true),
			array('usuario_id, barrio_id, ocupacion_id, puntaje', 'length', 'max'=>10),
			array('nombre, apellido', 'length', 'max'=>100),
			array('sexo', 'length', 'max'=>1),
			array('documento', 'length', 'max'=>50),
			array('telefono, celular, otra_ciudad, otra_ocupacion', 'length', 'max'=>45),
			array('fecha_registro', 'length', 'max'=>19),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, usuario_id, nombre, apellido, sexo, tipo_documento, documento, fecha_nacimiento, telefono, celular, barrio_id, otra_ciudad, nivel_educacion, ocupacion_id, otra_ocupacion, fecha_registro, puntaje, suscripcion', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_id'),
			'barrio' => array(self::BELONGS_TO, 'Barrio', 'barrio_id'),
			'ocupacion' => array(self::BELONGS_TO, 'Ocupacion', 'ocupacion_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'usuario_id' => 'Usuario',
			'nombre' => 'Nombres',
			'apellido' => 'Apellidos',
			'sexo' => 'Sexo',
			'tipo_documento' => 'Tipo Documento',
			'documento' => 'Documento',
			'fecha_nacimiento' => 'Fecha Nacimiento',
			'telefono' => 'Telefono',
			'celular' => 'Celular',
			'barrio_id' => 'Barrio',
			'otra_ciudad' => 'Otra Ciudad',
			'nivel_educacion' => 'Nivel Educacion',
			'ocupacion_id' => 'Ocupacion',
			'otra_ocupacion' => 'Otra Ocupacion',
			'fecha_registro' => 'Fecha Registro',
			'puntaje' => 'Puntaje',
			'suscripcion' => 'He leido y acepto los términos y condiciones.',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('usuario_id',$this->usuario_id,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('sexo',$this->sexo,true);
		$criteria->compare('tipo_documento',$this->tipo_documento);
		$criteria->compare('documento',$this->documento,true);
		$criteria->compare('fecha_nacimiento',$this->fecha_nacimiento,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('celular',$this->celular,true);
		$criteria->compare('barrio_id',$this->barrio_id,true);
		$criteria->compare('otra_ciudad',$this->otra_ciudad,true);
		$criteria->compare('nivel_educacion',$this->nivel_educacion);
		$criteria->compare('ocupacion_id',$this->ocupacion_id,true);
		$criteria->compare('otra_ocupacion',$this->otra_ocupacion,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('puntaje',$this->puntaje,true);
		$criteria->compare('suscripcion',$this->suscripcion);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getEdad()
	{
		 $date = new DateTime($this->fecha_nacimiento);
		 $now = new DateTime();
		 $interval = $now->diff($date);
		 return $interval->y;
	}
	
	public function getPuntos($jugador_id = 0)
	{
		 if($jugador_id == 0) $jugador_id = Yii::app()->user->id;
		 $jugador = $this->findByPk($jugador_id, array('select' => 'puntaje'));
		 return $jugador->puntaje;
	}

	public function setPuntos($puntaje, $jugador_id = 0)
	{
		if($jugador_id == 0) $jugador_id = Yii::app()->user->id;
		$jugador = $this->findByPk($jugador_id);
		$a = array('puntaje' => ($jugador->puntaje + $puntaje) );
		if( $jugador->updateByPk($jugador->id, $a) )
			return $this->getPuntos($jugador_id);
		else
			return false;
	}

	public function getRanking()
	{
		 
		 $c = new CDbCriteria;
		 $c->addCondition('puntaje > 0');
		 $c->limit = 10;
		 $c->order = 'puntaje DESC';
		 $ninos = $this->findAllByAttributes(array('sexo' => 'M'), $c);
		 $ninas = $this->findAllByAttributes(array('sexo' => 'F'), $c);
		 $resultado = array('ninos' => $ninos, 'ninas' => $ninas);
		 return $resultado;
	}

	protected function beforeSave()
	{
		        
        if($this->isNewRecord)
        {
        	$this->fecha_registro = date('Y-m-d H:i:s');
        	$this->puntaje = 0;	
        }else
        {
        	$this->fecha_actualizacion = date('Y-m-d H:i:s');
        }
        
    	return true;
	}
}