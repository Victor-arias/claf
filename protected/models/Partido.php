<?php

/**
 * This is the model class for table "partido".
 *
 * The followings are the available columns in table 'partido':
 * @property string $id
 * @property string $nombre
 * @property string $fecha
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Pregunta[] $preguntas
 * @property Ronda[] $rondas
 */
class Partido extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Partido the static model class
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
		return 'partido';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, fecha, estado', 'required'),
			array('estado', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>100),
			array('fecha', 'length', 'max'=>19),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, fecha, estado', 'safe', 'on'=>'search'),
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
			'preguntas' => array(self::HAS_MANY, 'Pregunta', 'partido_id'),
			'rondas' => array(self::HAS_MANY, 'Ronda', 'partido_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function verificar_partido( $partido_id )
	{
		$partido = $this->findByPk($partido_id);
		if($partido)
			return $partido->partido_id;
		else
			return false;
	}
}