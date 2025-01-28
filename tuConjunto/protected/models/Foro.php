<?php

/**
 * This is the model class for table "foro".
 *
 * The followings are the available columns in table 'foro':
 * @property integer $idForo
 * @property integer $Conjuntos_idConjunto
 * @property string $tema
 * @property string $mensaje
 * @property integer $idAutor
 * @property string $fechaPub
 * @property integer $respondeA
 */
class Foro extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'foro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Conjuntos_idConjunto, tema, mensaje, idAutor, fechaPub', 'required'),
			array('Conjuntos_idConjunto, idAutor, respondeA', 'numerical', 'integerOnly'=>true),
			array('tema', 'length', 'max'=>100),
			array('mensaje', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idForo, Conjuntos_idConjunto, tema, mensaje, idAutor, fechaPub, respondeA', 'safe', 'on'=>'search'),
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
			'idForo' => 'Id Foro',
			'Conjuntos_idConjunto' => 'Conjuntos Id Conjunto',
			'tema' => 'Tema',
			'mensaje' => 'Mensaje',
			'idAutor' => 'Id Autor',
			'fechaPub' => 'Fecha Pub',
			'respondeA' => 'Responde A',
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

		$criteria->compare('idForo',$this->idForo);
		$criteria->compare('Conjuntos_idConjunto',$this->Conjuntos_idConjunto);
		$criteria->compare('tema',$this->tema,true);
		$criteria->compare('mensaje',$this->mensaje,true);
		$criteria->compare('idAutor',$this->idAutor);
		$criteria->compare('fechaPub',$this->fechaPub,true);
		$criteria->compare('respondeA',$this->respondeA);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Foro the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
