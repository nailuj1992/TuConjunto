<?php

/**
 * This is the model class for table "vehiculos".
 *
 * The followings are the available columns in table 'vehiculos':
 * @property integer $idVehiculo
 * @property string $marca
 * @property string $modelo
 * @property string $serie
 * @property string $color
 * @property string $placa
 * @property string $observacion
 * @property integer $idDueno
 *
 * The followings are the available model relations:
 * @property Parqueaderos[] $parqueaderoses
 * @property Contactos $idDueno0
 */
class Vehiculos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vehiculos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('marca, color, placa, idDueno', 'required'),
			array('idDueno', 'numerical', 'integerOnly'=>true),
			array('marca, modelo, serie, color, observacion', 'length', 'max'=>255),
			array('placa', 'length', 'max'=>6),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idVehiculo, marca, modelo, serie, color, placa, observacion, idDueno', 'safe', 'on'=>'search'),
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
			'parqueaderoses' => array(self::HAS_MANY, 'Parqueaderos', 'Vehiculos_idVehiculo'),
			'idDueno0' => array(self::BELONGS_TO, 'Contactos', 'idDueno'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idVehiculo' => 'Id Vehiculo',
			'marca' => 'Marca',
			'modelo' => 'Modelo',
			'serie' => 'Serie',
			'color' => 'Color',
			'placa' => 'Placa',
			'observacion' => 'Observacion',
			'idDueno' => 'Id Dueno',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idVehiculo',$this->idVehiculo);
		$criteria->compare('marca',$this->marca,true);
		$criteria->compare('modelo',$this->modelo,true);
		$criteria->compare('serie',$this->serie,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('placa',$this->placa,true);
		$criteria->compare('observacion',$this->observacion,true);
		$criteria->compare('idDueno',$this->idDueno);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vehiculos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public static function getVehiculo($idUser) {
            echo ("holi");
//        $contacto = Contactos::model()->find(array(
//            'condition' => "cruge_user_iduser = $idUser",
//        ));
//        if ($contacto != null) {
//            return self::model()->findByPk($contacto->Conjuntos_idConjunto);
//        } else {
//            return null;
//        }
    }
}
