<?php

/**
 * This is the model class for table "reserva".
 *
 * The followings are the available columns in table 'reserva':
 * @property integer $idReserva
 * @property string $fecha
 * @property string $horaInicio
 * @property string $horaFin
 * @property integer $AreaSocial_idAreaSocial
 * @property integer $Inmuebles_idInmueble
 *
 * The followings are the available model relations:
 * @property Areasocial $areaSocialIdAreaSocial
 * @property Inmuebles $inmueblesIdInmueble
 */
class Reserva extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reserva';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha, horaInicio, horaFin, AreaSocial_idAreaSocial, Inmuebles_idInmueble', 'required'),
			array('AreaSocial_idAreaSocial, Inmuebles_idInmueble', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idReserva, fecha, horaInicio, horaFin, AreaSocial_idAreaSocial, Inmuebles_idInmueble', 'safe', 'on'=>'search'),
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
			'areaSocialIdAreaSocial' => array(self::BELONGS_TO, 'Areasocial', 'AreaSocial_idAreaSocial'),
			'inmueblesIdInmueble' => array(self::BELONGS_TO, 'Inmuebles', 'Inmuebles_idInmueble'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idReserva' => 'Id Reserva',
			'fecha' => 'Fecha del evento',
			'horaInicio' => 'Hora de inicio',
			'horaFin' => 'Hora de finalización',
			'AreaSocial_idAreaSocial' => 'Área Social',
			'Inmuebles_idInmueble' => 'Inmuebles Id Inmueble',
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

		$criteria->compare('idReserva',$this->idReserva);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('horaInicio',$this->horaInicio,true);
		$criteria->compare('horaFin',$this->horaFin,true);
		$criteria->compare('AreaSocial_idAreaSocial',$this->AreaSocial_idAreaSocial);
		$criteria->compare('Inmuebles_idInmueble',$this->Inmuebles_idInmueble);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Reserva the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public static function getEstado($e){
            if ($e=='A'){
                return "<font color='grass'>Aprobada";
            }
            elseif($e=='R'){
                return "<font color='red'>No aprobada";                
            }
            else{
                return "<font color='orange'>Pendiente";
            }
            
        }
}
