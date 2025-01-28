<?php

/**
 * This is the model class for table "mascotas".
 *
 * The followings are the available columns in table 'mascotas':
 * @property integer $idMascota
 * @property string $raza
 * @property string $nombre
 * @property string $descripcion
 * @property string $color
 * @property string $animal
 * @property integer $Inmuebles_idInmueble
 * @property string $foto
 *
 * The followings are the available model relations:
 * @property Inmuebles $inmueblesIdInmueble
 */
class Mascotas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mascotas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('raza, nombre, color, animal, Inmuebles_idInmueble', 'required'),
			array('Inmuebles_idInmueble', 'numerical', 'integerOnly'=>true),
			array('raza, nombre, descripcion, color, animal, foto', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idMascota, raza, nombre, descripcion, color, animal, Inmuebles_idInmueble, foto', 'safe', 'on'=>'search'),
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
			'inmueblesIdInmueble' => array(self::BELONGS_TO, 'Inmuebles', 'Inmuebles_idInmueble'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idMascota' => 'Id Mascota',
			'raza' => 'Raza',
			'nombre' => 'Nombre',
			'descripcion' => 'Descripcion',
			'color' => 'Color',
			'animal' => 'Animal',
			'Inmuebles_idInmueble' => 'Inmuebles Id Inmueble',
			'foto' => 'Foto',
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

		$criteria->compare('idMascota',$this->idMascota);
		$criteria->compare('raza',$this->raza,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('animal',$this->animal,true);
		$criteria->compare('Inmuebles_idInmueble',$this->Inmuebles_idInmueble);
		$criteria->compare('foto',$this->foto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mascotas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
