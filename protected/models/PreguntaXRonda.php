<?php

/**
 * This is the model class for table "pregunta_x_ronda".
 *
 * The followings are the available columns in table 'pregunta_x_ronda':
 * @property string $id
 * @property string $ronda_id
 * @property string $pregunta_id
 * @property string $fecha
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Ronda $ronda
 * @property Pregunta $pregunta
 */
class PreguntaXRonda extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PreguntaXRonda the static model class
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
		return 'pregunta_x_ronda';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ronda_id, pregunta_id, fecha, estado', 'required'),
			array('estado', 'numerical', 'integerOnly'=>true),
			array('ronda_id, pregunta_id', 'length', 'max'=>10),
			array('fecha', 'length', 'max'=>19),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ronda_id, pregunta_id, fecha, estado', 'safe', 'on'=>'search'),
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
			'ronda' => array(self::BELONGS_TO, 'Ronda', 'ronda_id'),
			'pregunta' => array(self::BELONGS_TO, 'Pregunta', 'pregunta_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ronda_id' => 'Ronda',
			'pregunta_id' => 'Pregunta',
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
		$criteria->compare('ronda_id',$this->ronda_id,true);
		$criteria->compare('pregunta_id',$this->pregunta_id,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}