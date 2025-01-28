<?php

/**
 * This is the model class for table "question".
 *
 * The followings are the available columns in table 'question':
 * @property integer $idQuestion
 * @property string $pregunta
 * @property string $tipo
 * @property integer $Encuestas_idEncuesta
 *
 * The followings are the available model relations:
 * @property Answer[] $answers
 * @property Encuestas $encuestasIdEncuesta
 */
class Question extends CActiveRecord {

    public static $SiNo = "SN";
    public static $SelMul = "SM";

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'question';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pregunta, tipo, Encuestas_idEncuesta', 'required'),
            array('Encuestas_idEncuesta', 'numerical', 'integerOnly' => true),
            array('pregunta', 'length', 'max' => 255),
            array('tipo', 'length', 'max' => 2),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idQuestion, pregunta, tipo, Encuestas_idEncuesta', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'answers' => array(self::HAS_MANY, 'Answer', 'Question_idQuestion'),
            'encuestasIdEncuesta' => array(self::BELONGS_TO, 'Encuestas', 'Encuestas_idEncuesta'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idQuestion' => 'Id Question',
            'pregunta' => 'Pregunta',
            'tipo' => 'Tipo',
            'Encuestas_idEncuesta' => 'Encuesta',
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

        $criteria->compare('idQuestion', $this->idQuestion);
        $criteria->compare('pregunta', $this->pregunta, true);
        $criteria->compare('tipo', $this->tipo, true);
        $criteria->compare('Encuestas_idEncuesta', $this->Encuestas_idEncuesta);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function buscar($idEncuesta) {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $criteria = new CDbCriteria;

        if ($conjunto != null) {
            $criteria->join = "LEFT JOIN encuestas e ON e.idEncuesta = Encuestas_idEncuesta ";
            $criteria->join .= "LEFT JOIN conjuntos c ON e.Conjuntos_idConjunto = c.idConjunto ";
            $criteria->condition = "c.idConjunto = '$conjunto->idConjunto' ";
            $criteria->condition .= "AND e.idEncuesta = '$idEncuesta' ";
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function buscarRespondidas($idEncuesta) {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $criteria = new CDbCriteria;

        if ($conjunto != null) {
            $criteria->distinct = true;
            $criteria->join = "LEFT JOIN encuestas e ON e.idEncuesta = Encuestas_idEncuesta ";
            $criteria->join .= "LEFT JOIN conjuntos c ON e.Conjuntos_idConjunto = c.idConjunto ";
            $criteria->join .= "LEFT JOIN answer a ON a.Question_idQuestion = idQuestion ";
            $criteria->join .= "LEFT JOIN inmuebleanswer ia ON ia.Answer_idAnswer = a.idAnswer ";
            $criteria->condition = "c.idConjunto = '$conjunto->idConjunto' ";
            $criteria->condition .= "AND e.idEncuesta = '$idEncuesta' ";
            $criteria->condition .= "AND ia.Answer_idAnswer IS NOT NULL ";
        }

        return $criteria;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Question the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getTipos() {
        return array(
            '' => '',
            self::$SiNo => 'Sí/No',
            self::$SelMul => 'Selección Múltiple',
        );
    }

    public static function getTipo($inicial) {
        $tipos = self::getTipos();
        return $tipos[$inicial];
    }

}
