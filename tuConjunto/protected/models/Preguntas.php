<?php

/**
 * This is the model class for table "preguntas".
 *
 * The followings are the available columns in table 'preguntas':
 * @property integer $idPregunta
 * @property string $pregunta
 * @property string $tipo
 * @property integer $Asambleas_idAsamblea
 *
 * The followings are the available model relations:
 * @property Asambleas $asambleasIdAsamblea
 * @property Respuestas[] $respuestases
 */
class Preguntas extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'preguntas';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pregunta, tipo, Asambleas_idAsamblea', 'required'),
            array('Asambleas_idAsamblea', 'numerical', 'integerOnly' => true),
            array('pregunta, tipo', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idPregunta, pregunta, tipo, Asambleas_idAsamblea', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'asambleasIdAsamblea' => array(self::BELONGS_TO, 'Asambleas', 'Asambleas_idAsamblea'),
            'respuestases' => array(self::HAS_MANY, 'Respuestas', 'Preguntas_idPregunta'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idPregunta' => 'Id Pregunta',
            'pregunta' => 'Pregunta',
            'tipo' => 'Tipo',
            'Asambleas_idAsamblea' => 'Asamblea',
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

        $criteria->compare('idPregunta', $this->idPregunta);
        $criteria->compare('pregunta', $this->pregunta, true);
        $criteria->compare('tipo', $this->tipo, true);
        $criteria->compare('Asambleas_idAsamblea', $this->Asambleas_idAsamblea);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function buscar($idAsamblea) {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $criteria = new CDbCriteria;

        if ($conjunto != null) {
            $criteria->join = "LEFT JOIN asambleas a ON a.idAsamblea = Asambleas_idAsamblea ";
            $criteria->join .= "LEFT JOIN conjuntos c ON a.Conjuntos_idConjunto = c.idConjunto ";
            $criteria->condition = "c.idConjunto = '$conjunto->idConjunto' ";
            $criteria->condition .= "AND a.idAsamblea = '$idAsamblea' ";
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function buscarNoRespondidas($idAsamblea) {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $criteria = new CDbCriteria;

        if ($conjunto != null) {
            $criteria->join = "LEFT JOIN asambleas a ON a.idAsamblea = Asambleas_idAsamblea ";
            $criteria->join .= "LEFT JOIN conjuntos c ON a.Conjuntos_idConjunto = c.idConjunto ";
            $criteria->join .= "LEFT JOIN respuestas r ON r.Preguntas_idPregunta = idPregunta ";
            $criteria->condition = "c.idConjunto = '$conjunto->idConjunto' ";
            $criteria->condition .= "AND a.idAsamblea = '$idAsamblea' ";
            $criteria->condition .= "AND r.Preguntas_idPregunta IS NULL ";
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Preguntas the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
