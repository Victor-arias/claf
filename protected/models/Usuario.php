<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property string $id
 * @property string $correo
 * @property string $password
 * @property string $llave_activacion
 * @property integer $estado
 * @property integer $es_admin
 */
class Usuario extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuario the static model class
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
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('correo, password, llave_activacion, estado, es_admin', 'required'),
			array('correo', 'email', 'message'=>"El {attribute} No tiene un formato válido"),			// 
			array('correo', 'unique', 'message'=>"El {attribute} {value} Ya se encuentra registrado"),
			array('estado, es_admin', 'numerical', 'integerOnly'=>true),
			array('correo', 'length', 'max'=>100),
			array('password, llave_activacion', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, correo, password, llave_activacion, estado, es_admin', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'correo' => 'Correo',
			'password' => 'Contraseña',
			'llave_activacion' => 'Llave Activacion',
			'estado' => 'Estado',
			'es_admin' => 'Es Admin',
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
		$criteria->compare('correo',$this->correo,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('llave_activacion',$this->llave_activacion,true);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('es_admin',$this->es_admin);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeSave()
	{
		        
        if($this->isNewRecord)
        {
        	$usuario->password = md5($usuario->password);
        }
        else
        {
        	$usuario->password = md5($usuario->password);
        }
        
    	return true;
	}	
				
}