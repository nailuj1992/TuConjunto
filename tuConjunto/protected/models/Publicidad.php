<?php

/**
 * This is the model class for table "publicidad".
 *
 * The followings are the available columns in table 'publicidad':
 * @property integer $idPublicidad
 * @property integer $idContacto
 * @property integer $idConjunto
 * @property string $nombre
 * @property string $imagen
 * @property string $descripcion
 */
class Publicidad extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'publicidad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idContacto, idConjunto, nombre, imagen, descripcion', 'required'),
			array('idContacto, idConjunto', 'numerical', 'integerOnly'=>true),
			array('nombre, imagen, descripcion', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idPublicidad, idContacto, idConjunto, nombre, imagen, descripcion', 'safe', 'on'=>'search'),
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
			'idPublicidad' => 'Id Publicidad',
			'idContacto' => 'Id Contacto',
			'idConjunto' => 'Id Conjunto',
			'nombre' => 'Nombre',
			'imagen' => 'Imagen',
			'descripcion' => 'Descripcion',
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

		$criteria->compare('idPublicidad',$this->idPublicidad);
		$criteria->compare('idContacto',$this->idContacto);
		$criteria->compare('idConjunto',$this->idConjunto);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('imagen',$this->imagen,true);
		$criteria->compare('descripcion',$this->descripcion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Publicidad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
