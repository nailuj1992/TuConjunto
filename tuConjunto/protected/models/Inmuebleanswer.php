<?php

/**
 * This is the model class for table "inmuebleanswer".
 *
 * The followings are the available columns in table 'inmuebleanswer':
 * @property integer $idInmuebleAnswer
 * @property integer $Answer_idAnswer
 * @property integer $Inmuebles_idInmueble
 * @property string $fecha
 *
 * The followings are the available model relations:
 * @property Answer $answerIdAnswer
 * @property Inmuebles $inmueblesIdInmueble
 */
class Inmuebleanswer extends CActiveRecord {

    public static $siRespondido = "Si";
    public static $noRespondido = "No";

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'inmuebleanswer';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Answer_idAnswer, Inmuebles_idInmueble, fecha', 'required'),
            array('Answer_idAnswer, Inmuebles_idInmueble', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idInmuebleAnswer, Answer_idAnswer, Inmuebles_idInmueble, fecha', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'answerIdAnswer' => array(self::BELONGS_TO, 'Answer', 'Answer_idAnswer'),
            'inmueblesIdInmueble' => array(self::BELONGS_TO, 'Inmuebles', 'Inmuebles_idInmueble'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idInmuebleAnswer' => 'Id Inmueble Answer',
            'Answer_idAnswer' => 'Answer Id Answer',
            'Inmuebles_idInmueble' => 'Inmuebles Id Inmueble',
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

        $criteria->compare('idInmuebleAnswer', $this->idInmuebleAnswer);
        $criteria->compare('Answer_idAnswer', $this->Answer_idAnswer);
        $criteria->compare('Inmuebles_idInmueble', $this->Inmuebles_idInmueble);
        $criteria->compare('fecha', $this->fecha, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Inmuebleanswer the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
