<?php

/**
 * This is the model class for table "ronda".
 *
 * The followings are the available columns in table 'ronda':
 * @property string $id
 * @property string $jugador_id
 * @property string $partido_id
 * @property integer $preguntas
 * @property string $puntos
 * @property string $fecha
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property PreguntaXRonda[] $preguntaXRondas
 * @property Jugador $jugador
 * @property Partido $partido
 */
class Ronda extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ronda the static model class
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
		return 'ronda';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('jugador_id, partido_id, preguntas, puntos, fecha, estado', 'required'),
			array('preguntas, estado', 'numerical', 'integerOnly'=>true),
			array('jugador_id, partido_id, puntos', 'length', 'max'=>10),
			array('fecha', 'length', 'max'=>19),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, jugador_id, partido_id, preguntas, puntos, fecha, estado', 'safe', 'on'=>'search'),
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
			'preguntaXRondas' => array(self::HAS_MANY, 'PreguntaXRonda', 'ronda_id'),
			'jugador' => array(self::BELONGS_TO, 'Jugador', 'jugador_id'),
			'partido' => array(self::BELONGS_TO, 'Partido', 'partido_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'jugador_id' => 'Jugador',
			'partido_id' => 'Partido',
			'preguntas' => 'Preguntas',
			'puntos' => 'Puntos',
			'fecha' => 'Fecha',
			'estado' => 'Estado',
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
		$criteria->compare('jugador_id',$this->jugador_id,true);
		$criteria->compare('partido_id',$this->partido_id,true);
		$criteria->compare('preguntas',$this->preguntas);
		$criteria->compare('puntos',$this->puntos,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function iniciarRonda($jugador_id, $partido_id)
	{
		$existe = $this->findByAttributes( array('jugador_id' => $jugador_id, 'partido_id' => $partido_id) );
		if($existe) return false;

		$this->jugador_id = $jugador_id;
		$this->partido_id = $partido_id;
		$this->preguntas = 0;
		$this->puntos = 0;
		$this->fecha = time();
		$this->estado = 1;

		$this->save();

		return $this->getPrimaryKey();
	}

	public function getRondasDia($jugador_id)
	{
		$a = new CDbCriteria;

		$a->addCondition('jugador_id = '. $jugador_id);
		$a->addCondition('DATE(fecha)=DATE(NOW())');
		
		return $this->findAll($a);

	}

	public function obtener_estadisticas($jugador_id = 0)
	{
		//Número total de rondas
		$numero_rondas = $this->obtener_numero_rondas($jugador_id);
		
		//Tiempo total
		$tiempo_total = gmdate( 'H:i:s', $this->obtener_total($jugador_id, 'tiempo') );
		
		//Total preguntas
		$preguntas_total = $this->obtener_total($jugador_id, 'preguntas');

		//Puntos ultima ronda
		$puntos_ultima = $this->obtener_ultima($jugador_id, 'puntos');

		//Preguntas última ronda
		$preguntas_ultima = $this->obtener_ultima($jugador_id, 'preguntas');

		//Fecha última ronda
		$fecha_ultima = date( 'd-m-Y', strtotime( $this->obtener_ultima($jugador_id, 'fecha') ) );

		$estadisticas = array(	'rondas' 			=> $numero_rondas,
								'preguntas' 		=> $preguntas_total,
								'puntos_ultima' 	=> $puntos_ultima,
								'preguntas_ultima' 	=> $preguntas_ultima,
								'fecha_ultima' 		=> $fecha_ultima,
							);

		return $estadisticas;
	}//obtener_estadisticas

	protected function obtener_numero_rondas($jugador_id)
	{
		$rondas = $this->findAll('jugador_id = ' . $jugador_id);
		return count($rondas);
	}

	protected function obtener_total($jugador_id, $campo)
	{
		$c = new CDbCriteria;
		$c->select = 'Sum('.$campo.') AS '.$campo.', jugador_id';
		$c->group 	= 'jugador_id';
		$c->addCondition('jugador_id = ' . $jugador_id);
		$total = $this->find($c);
		return $total->$campo;
	}
	protected function obtener_ultima($jugador_id, $campo = null)
	{
		$c = new CDbCriteria;
		if($campo != null)
			$c->select = $campo.', jugador_id';
		$c->addCondition('jugador_id = ' . $jugador_id);
		$c->order = 'id DESC';
		$c->limit = 1;
		$ultima = $this->find($c);
		if($campo != null)
			return $ultima->$campo;
		else
			return $ultima;
	}
}