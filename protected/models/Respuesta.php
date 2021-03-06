<?php

/**
 * This is the model class for table "respuesta".
 *
 * The followings are the available columns in table 'respuesta':
 * @property string $id
 * @property string $pregunta_id
 * @property string $respuesta
 * @property integer $es_correcto
 *
 * The followings are the available model relations:
 * @property Pregunta $pregunta
 */
class Respuesta extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Respuesta the static model class
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
		return 'respuesta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pregunta_id, respuesta, es_correcto', 'required'),
			array('es_correcto', 'numerical', 'integerOnly'=>true),
			array('pregunta_id', 'length', 'max'=>10),
			array('respuesta', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pregunta_id, respuesta, es_correcto', 'safe', 'on'=>'search'),
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
			'pregunta_id' => 'Pregunta',
			'respuesta' => 'Respuesta',
			'es_correcto' => 'Es Correcto',
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
		$criteria->compare('pregunta_id',$this->pregunta_id,true);
		$criteria->compare('respuesta',$this->respuesta,true);
		$criteria->compare('es_correcto',$this->es_correcto);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}