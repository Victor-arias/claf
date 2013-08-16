<?php

/**
 * This is the model class for table "pregunta".
 *
 * The followings are the available columns in table 'pregunta':
 * @property string $id
 * @property string $nivel_id
 * @property string $partido_id
 * @property string $pregunta
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Nivel $nivel
 * @property Partido $partido
 * @property PreguntaXRonda[] $preguntaXRondas
 * @property Respuesta[] $respuestas
 */
class Pregunta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pregunta the static model class
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
		return 'pregunta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nivel_id, partido_id, pregunta, estado', 'required'),
			array('estado', 'numerical', 'integerOnly'=>true),
			array('nivel_id, partido_id', 'length', 'max'=>10),
			array('pregunta', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nivel_id, partido_id, pregunta, estado', 'safe', 'on'=>'search'),
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
			'nivel' => array(self::BELONGS_TO, 'Nivel', 'nivel_id'),
			'partido' => array(self::BELONGS_TO, 'Partido', 'partido_id'),
			'preguntaXRondas' => array(self::HAS_MANY, 'PreguntaXRonda', 'pregunta_id'),
			'respuestas' => array(self::HAS_MANY, 'Respuesta', 'pregunta_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nivel_id' => 'Nivel',
			'partido_id' => 'Partido',
			'pregunta' => 'Pregunta',
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
		$criteria->compare('nivel_id',$this->nivel_id,true);
		$criteria->compare('partido_id',$this->partido_id,true);
		$criteria->compare('pregunta',$this->pregunta,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function obtener_pregunta($partido_id, $nivel = 1, $pregunta_id = 0)
	{
		
		if($pregunta_id)
		{
			$pregunta = $this->findByPk($pregunta_id);			
		}
		else
		{
			$pregunta = $this->pregunta_siguiente($partido_id, $nivel);
		}

		$rcriteria 				= new CDbCriteria;
		$rcriteria->select 		= array('id', 'respuesta');
		$rcriteria->condition 	= 'pregunta_id=:pregunta_id';
		$rcriteria->params 		= array(':pregunta_id' => $pregunta->id);


		$respuestas = Respuesta::model()->findAll($rcriteria);

		$result = array('pregunta' => $pregunta,
						'respuestas' => $respuestas);

		return $result;

	}

	protected function pregunta_siguiente($partido_id, $nivel)
	{

		$pcriteria 				= new CDbCriteria;
		$pcriteria->addCondition('nivel_id='.$nivel);
		$pcriteria->addCondition('partido_id='.$partido_id);
		$pcriteria->limit 		= 1;
	
		$pregunta = $this->findAll($pcriteria);
		if(isset($pregunta[0]))
			 $pregunta = $pregunta[0];
		else
		{
			$pregunta = $this->pregunta_siguiente($partido_id, $nivel);
		}

		return $pregunta;
	}

}