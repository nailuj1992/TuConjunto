<?php

/**
 * This is the model class for table "encuestas".
 *
 * The followings are the available columns in table 'encuestas':
 * @property integer $idEncuesta
 * @property string $titulo
 * @property string $descripcion
 * @property string $fechaInicio
 * @property string $fechaFin
 * @property integer $Conjuntos_idConjunto
 *
 * The followings are the available model relations:
 * @property Conjuntos $conjuntosIdConjunto
 * @property Preguntas[] $preguntases
 */
class Encuestas extends CActiveRecord {

    public static $encuestasBefore = "Aún no es hora de responder a la encuesta.";
    public static $encuestasTimeout = "El tiempo de la encuesta ha caducado.";
    public static $encuestasTitular = "No eres el titular del inmueble. Por tanto, no puedes responder a la encuesta.";

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'encuestas';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('titulo, descripcion, fechaInicio, fechaFin, Conjuntos_idConjunto', 'required'),
            array('Conjuntos_idConjunto', 'numerical', 'integerOnly' => true),
            array('titulo, descripcion', 'length', 'max' => 255),
            array('fechaInicio', 'compare', 'compareValue' => date('Y-m-d'), 'operator' => '>=', 'allowEmpty' => false),
            array('fechaFin', 'compare', 'compareAttribute' => 'fechaInicio', 'operator' => '>=', 'allowEmpty' => false),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idEncuesta, titulo, descripcion, fechaInicio, fechaFin, Conjuntos_idConjunto', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'conjuntosIdConjunto' => array(self::BELONGS_TO, 'Conjuntos', 'Conjuntos_idConjunto'),
            'preguntases' => array(self::HAS_MANY, 'Preguntas', 'Encuestas_idEncuesta'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idEncuesta' => 'Id Encuesta',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'fechaInicio' => 'Fecha Inicio',
            'fechaFin' => 'Fecha Fin',
            'Conjuntos_idConjunto' => 'Conjuntos Id Conjunto',
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

        $criteria->compare('idEncuesta', $this->idEncuesta);
        $criteria->compare('titulo', $this->titulo, true);
        $criteria->compare('descripcion', $this->descripcion, true);
        $criteria->compare('fechaInicio', $this->fechaInicio, true);
        $criteria->compare('fechaFin', $this->fechaFin, true);
        $criteria->compare('Conjuntos_idConjunto', $this->Conjuntos_idConjunto);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function buscar() {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $criteria = new CDbCriteria;

        if ($conjunto != null) {
            $criteria->condition = "Conjuntos_idConjunto = '$conjunto->idConjunto'";
            $criteria->with = array('conjuntosIdConjunto' => array('joinType' => 'LEFT JOIN'));
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function buscarTimein() {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $criteria = new CDbCriteria;

        $today = date('Y-m-d');
        $criteria->condition = "'$today' <= fechaFin ";
        if ($conjunto != null) {
            $criteria->condition .= "AND Conjuntos_idConjunto = '$conjunto->idConjunto'";
            $criteria->with = array('conjuntosIdConjunto' => array('joinType' => 'LEFT JOIN'));
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Encuestas the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
