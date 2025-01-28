<?php

/**
 * This is the model class for table "archivosexcel".
 *
 * The followings are the available columns in table 'archivosexcel':
 * @property integer $idArchivosExcel
 * @property string $nombre
 * @property integer $Conjuntos_idConjunto
 *
 * The followings are the available model relations:
 * @property Conjuntos $conjuntosIdConjunto
 */
class Archivosexcel extends CActiveRecord {
    
    public static $hojaFormato = 0;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'archivosexcel';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombre, Conjuntos_idConjunto', 'required'),
            array('Conjuntos_idConjunto', 'numerical', 'integerOnly' => true),
            array('nombre', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idArchivosExcel, nombre, Conjuntos_idConjunto', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'conjunto' => array(self::BELONGS_TO, 'Conjuntos', 'Conjuntos_idConjunto'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idArchivosExcel' => 'Id Archivo Excel',
            'nombre' => 'Archivo (Formato .xlsx)',
            'Conjuntos_idConjunto' => 'Conjunto',
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

        $criteria->compare('idArchivosExcel', $this->idArchivosExcel);
        $criteria->compare('nombre', $this->nombre, true);
        $criteria->compare('Conjuntos_idConjunto', $this->Conjuntos_idConjunto);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Archivosexcel the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
