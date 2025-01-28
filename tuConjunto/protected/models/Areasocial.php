<?php

/**
 * This is the model class for table "areasocial".
 *
 * The followings are the available columns in table 'areasocial':
 * @property integer $idAreaSocial
 * @property string $nombre
 * @property integer $precio
 * @property string $descripcion
 * @property integer $Conjuntos_idConjunto
 * @property string $tarifa
 *
 * The followings are the available model relations:
 * @property Conjuntos $conjuntosIdConjunto
 * @property Reserva[] $reservas
 */
class Areasocial extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'areasocial';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, precio, Conjuntos_idConjunto, tarifa', 'required'),
			array('precio, Conjuntos_idConjunto', 'numerical', 'integerOnly'=>true),
			array('nombre', 'length', 'max'=>45),
			array('descripcion', 'length', 'max'=>255),
			array('tarifa', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idAreaSocial, nombre, precio, descripcion, Conjuntos_idConjunto, tarifa', 'safe', 'on'=>'search'),
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
			'conjuntosIdConjunto' => array(self::BELONGS_TO, 'Conjuntos', 'Conjuntos_idConjunto'),
                        'reservas' => array(self::HAS_MANY, 'Reserva', 'AreaSocial_idAreaSocial'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idAreaSocial' => 'Id Area Social',
			'nombre' => 'Nombre',
			'precio' => 'Precio',
			'descripcion' => 'Descripción',
			'Conjuntos_idConjunto' => 'Conjuntos Id Conjunto',
			'tarifa' => 'Tarifa',
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

		$criteria->compare('idAreaSocial',$this->idAreaSocial);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('precio',$this->precio);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('Conjuntos_idConjunto',$this->Conjuntos_idConjunto);
		$criteria->compare('tarifa',$this->tarifa,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Areasocial the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public static function getTarifa($id){
         $area= Areasocial::model()->findbypk($id);
         if($area->tarifa == 'F'){
             return $area->precio." por jornada";
         }
         else{
            return $area->precio." por hora";
         }
            
        }
}
