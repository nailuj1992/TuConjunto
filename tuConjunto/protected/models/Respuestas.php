<?php

/**
 * This is the model class for table "respuestas".
 *
 * The followings are the available columns in table 'respuestas':
 * @property integer $idRespuestas
 * @property integer $Preguntas_idPregunta
 * @property integer $Inmuebles_idInmueble
 * @property string $respuesta
 * @property string $fecha
 *
 * The followings are the available model relations:
 * @property Inmuebles $inmueblesIdInmueble
 * @property Preguntas $preguntasIdPregunta
 */
class Respuestas extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'respuestas';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Preguntas_idPregunta, Inmuebles_idInmueble, respuesta, fecha', 'required'),
            array('Preguntas_idPregunta, Inmuebles_idInmueble', 'numerical', 'integerOnly' => true),
            array('respuesta', 'length', 'max' => 1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idRespuestas, Preguntas_idPregunta, Inmuebles_idInmueble, respuesta, fecha', 'safe', 'on' => 'search'),
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
            'preguntasIdPregunta' => array(self::BELONGS_TO, 'Preguntas', 'Preguntas_idPregunta'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idRespuestas' => 'Id Respuestas',
            'Preguntas_idPregunta' => 'Preguntas Id Pregunta',
            'Inmuebles_idInmueble' => 'Inmuebles Id Inmueble',
            'respuesta' => 'Respuesta',
            'fecha' => 'Fecha',
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

        $criteria->compare('idRespuestas', $this->idRespuestas);
        $criteria->compare('Preguntas_idPregunta', $this->Preguntas_idPregunta);
        $criteria->compare('Inmuebles_idInmueble', $this->Inmuebles_idInmueble);
        $criteria->compare('respuesta', $this->respuesta, true);
        $criteria->compare('fecha', $this->fecha, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Respuestas the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
