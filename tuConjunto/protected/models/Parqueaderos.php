<?php

/**
 * This is the model class for table "parqueaderos".
 *
 * The followings are the available columns in table 'parqueaderos':
 * @property integer $idParqueadero
 * @property integer $numero
 * @property string $ubicacion
 * @property integer $Inmuebles_idInmueble
 * @property integer $Vehiculos_idVehiculo
 *
 * The followings are the available model relations:
 * @property Inmuebles $inmueblesIdInmueble
 * @property Vehiculos $vehiculosIdVehiculo
 */
class Parqueaderos extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'parqueaderos';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('numero, ubicacion, Inmuebles_idInmueble', 'required'),
            array('numero, Inmuebles_idInmueble, Vehiculos_idVehiculo', 'numerical', 'integerOnly' => true),
            array('ubicacion', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idParqueadero, numero, ubicacion, Inmuebles_idInmueble, Vehiculos_idVehiculo', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'inmueblesIdInmueble' => array(self::BELONGS_TO, 'Inmuebles', 'Inmuebles_idInmueble'),
            'vehiculosIdVehiculo' => array(self::BELONGS_TO, 'Vehiculos', 'Vehiculos_idVehiculo'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idParqueadero' => 'Id Parqueadero',
            'numero' => 'Número',
            'ubicacion' => 'Ubicación',
            'Inmuebles_idInmueble' => 'Inmuebles Id Inmueble',
            'Vehiculos_idVehiculo' => 'Vehiculos Id Vehiculo',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('idParqueadero', $this->idParqueadero);
        $criteria->compare('numero', $this->numero);
        $criteria->compare('ubicacion', $this->ubicacion, true);
        $criteria->compare('Inmuebles_idInmueble', $this->Inmuebles_idInmueble);
        $criteria->compare('Vehiculos_idVehiculo', $this->Vehiculos_idVehiculo);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getVehiculo($id) {
        $parqueadero= Parqueaderos::model()->findByPk($id);
        if(is_null($parqueadero->Vehiculos_idVehiculo)) {
            return "Desocupado";         
        }
        
        else {
            $carro=Vehiculos::model()->findByPk($parqueadero->Vehiculos_idVehiculo);

            return $carro->placa;
                    
        }
        
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Parqueaderos the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
