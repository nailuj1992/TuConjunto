<?php

/**
 * This is the model class for table "asambleas".
 *
 * The followings are the available columns in table 'asambleas':
 * @property integer $idAsamblea
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
class Asambleas extends CActiveRecord {

    public static $asambleasBefore = "Aún no es hora de responder a la asamblea.";
    public static $asambleasTimeout = "El tiempo de la asamblea ha caducado.";
    public static $asambleasTitular = "No eres el titular del inmueble. Por tanto, no puedes responder a la asamblea.";

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'asambleas';
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
            array('idAsamblea, titulo, descripcion, fechaInicio, fechaFin, Conjuntos_idConjunto', 'safe', 'on' => 'search'),
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
            'preguntases' => array(self::HAS_MANY, 'Preguntas', 'Asambleas_idAsamblea'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idAsamblea' => 'Id Asamblea',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripcion',
            'fechaInicio' => 'Fecha Inicio',
            'fechaFin' => 'Fecha Fin',
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

        $criteria->compare('idAsamblea', $this->idAsamblea);
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
        return new CActiveDataProvider($this, array(
            'criteria' => $this->buscarTimeinCriteria(),
        ));
    }

    public function buscarTimeinCriteria() {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $criteria = new CDbCriteria;

        $today = date('Y-m-d');
        $criteria->condition = "'$today' <= fechaFin "; //fechaInicio <= '$today' AND 
        if ($conjunto != null) {
            $criteria->condition .= "AND Conjuntos_idConjunto = '$conjunto->idConjunto'";
            $criteria->with = array('conjuntosIdConjunto' => array('joinType' => 'LEFT JOIN'));
        }

        return $criteria;
    }

    public function buscarTimeoutCriteria() {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $criteria = new CDbCriteria;

        $today = date('Y-m-d');
        $criteria->condition = "fechaInicio <= '$today' AND '$today' <= fechaFin ";
        if ($conjunto != null) {
            $criteria->condition .= "AND Conjuntos_idConjunto = '$conjunto->idConjunto'";
            $criteria->with = array('conjuntosIdConjunto' => array('joinType' => 'LEFT JOIN'));
        }

        return $criteria;
    }

    public function buscarNoRespondidasTimeout() {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $criteria = new CDbCriteria;

        if ($conjunto != null) {
            $today = date('Y-m-d');
            $criteria->join = "LEFT JOIN conjuntos c ON Conjuntos_idConjunto = c.idConjunto ";
            $criteria->join .= "LEFT JOIN preguntas p ON p.Asambleas_idAsamblea = idAsamblea ";
            $criteria->join .= "LEFT JOIN respuestas r ON r.Preguntas_idPregunta = p.idPregunta ";
            $criteria->condition = "c.idConjunto = '$conjunto->idConjunto' ";
            $criteria->condition .= "AND r.Preguntas_idPregunta IS NULL ";
            $criteria->condition .= " AND fechaInicio <= '$today' AND '$today' <= fechaFin ";
        }

        return $criteria;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Asambleas the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
