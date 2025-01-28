<?php

/**
 * This is the model class for table "answer".
 *
 * The followings are the available columns in table 'answer':
 * @property integer $idAnswer
 * @property string $contenido
 * @property integer $Question_idQuestion
 *
 * The followings are the available model relations:
 * @property Question $questionIdQuestion
 * @property Inmuebleanswer[] $inmuebleanswers
 */
class Answer extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'answer';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('contenido, Question_idQuestion', 'required'),
            array('Question_idQuestion', 'numerical', 'integerOnly' => true),
            array('contenido', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idAnswer, contenido, Question_idQuestion', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'questionIdQuestion' => array(self::BELONGS_TO, 'Question', 'Question_idQuestion'),
            'inmuebleanswers' => array(self::HAS_MANY, 'Inmuebleanswer', 'Answer_idAnswer'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idAnswer' => 'Id Answer',
            'contenido' => 'Contenido',
            'Question_idQuestion' => 'Question Id Question',
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

        $criteria->compare('idAnswer', $this->idAnswer);
        $criteria->compare('contenido', $this->contenido, true);
        $criteria->compare('Question_idQuestion', $this->Question_idQuestion);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function buscar($idEncuesta, $idQuestion) {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $criteria = new CDbCriteria;

        if ($conjunto != null) {
            $criteria->join = "LEFT JOIN question q ON Question_idQuestion = q.idQuestion ";
            $criteria->join .= "LEFT JOIN encuestas e ON e.idEncuesta = q.Encuestas_idEncuesta ";
            $criteria->join .= "LEFT JOIN conjuntos c ON e.Conjuntos_idConjunto = c.idConjunto ";
            $criteria->condition = "c.idConjunto = '$conjunto->idConjunto' ";
            $criteria->condition .= "AND e.idEncuesta = '$idEncuesta' ";
            $criteria->condition .= "AND q.idQuestion = '$idQuestion' ";
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Answer the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
