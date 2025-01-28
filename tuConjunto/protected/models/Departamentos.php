<?php

/**
 * This is the model class for table "departamentos".
 *
 * The followings are the available columns in table 'departamentos':
 * @property integer $idDepartamentos
 * @property string $nombre
 *
 * The followings are the available model relations:
 * @property Ciudades[] $ciudades
 */
class Departamentos extends CActiveRecord {

    public static $seleccioneDepartamento = "--Seleccione un departamento--";

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'departamentos';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombre', 'required'),
            array('nombre', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idDepartamentos, nombre', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'ciudades' => array(self::HAS_MANY, 'Ciudades', 'Departamentos_idDepartamentos'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idDepartamentos' => 'Id Departamentos',
            'nombre' => 'Nombre',
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

        $criteria->compare('idDepartamentos', $this->idDepartamentos);
        $criteria->compare('nombre', $this->nombre, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Departamentos the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getDepartamentos() {
//        Productos::model()->findAll(array("condition"=>"EmpresaIDFK =  $empresa->EmpresaID"),array(''=>'Seleccione')), 'ProductoID', 'NombreP'
        return self::model()->findAll();
    }

}
