<?php

/**
 * This is the model class for table "inmuebles".
 *
 * The followings are the available columns in table 'inmuebles':
 * @property integer $idInmueble
 * @property string $zona
 * @property string $numZona
 * @property string $nombre
 * @property string $tipo
 * @property string $coeficienteCopropiedad
 * @property string $matriculaInmobiliaria
 * @property string $areaConstruida
 * @property string $estrato
 * @property integer $Conjuntos_idConjunto
 * @property integer $idTitular
 *
 * The followings are the available model relations:
 * @property Contactos[] $contactoses
 * @property Conjuntos $conjuntosIdConjunto
 * @property Contactos $idTitular0
 * @property Mascotas[] $mascotases
 * @property Parqueaderos[] $parqueaderoses
 * @property Quejas[] $quejases
 * @property Quejas[] $quejases1
 */
class Inmuebles extends CActiveRecord {

    public static $seleccioneInmueble = "--Seleccione un inmueble--";

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'inmuebles';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('zona, nombre, tipo, coeficienteCopropiedad, matriculaInmobiliaria, areaConstruida, Conjuntos_idConjunto', 'required'),
            array('numZona, coeficienteCopropiedad, areaConstruida, Conjuntos_idConjunto, idTitular', 'numerical', 'integerOnly' => true),
            array('zona, tipo', 'length', 'max' => 1),
            array('numZona, nombre, coeficienteCopropiedad, areaConstruida', 'length', 'max' => 11),
            array('matriculaInmobiliaria', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idInmueble, zona, numZona, nombre, tipo, coeficienteCopropiedad, matriculaInmobiliaria, areaConstruida, Conjuntos_idConjunto, idTitular', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'contactoses' => array(self::HAS_MANY, 'Contactos', 'Inmuebles_idInmueble'),
            'conjuntosIdConjunto' => array(self::BELONGS_TO, 'Conjuntos', 'Conjuntos_idConjunto'),
            'idTitular0' => array(self::BELONGS_TO, 'Contactos', 'idTitular'),
            'mascotases' => array(self::HAS_MANY, 'Mascotas', 'Inmuebles_idInmueble'),
            'parqueaderoses' => array(self::HAS_MANY, 'Parqueaderos', 'Inmuebles_idInmueble'),
            'quejases' => array(self::HAS_MANY, 'Quejas', 'idRemitente'),
            'quejases1' => array(self::HAS_MANY, 'Quejas', 'idDestinatario'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idInmueble' => 'Inmueble #',
            'zona' => 'Zona',
            'numZona' => 'Número de la zona',
            'nombre' => 'Nombre',
            'tipo' => 'Tipo',
            'coeficienteCopropiedad' => 'Coeficiente Copropiedad',
            'matriculaInmobiliaria' => 'Matricula Inmobiliaria',
            'areaConstruida' => 'Area Construída (m2)',
            'Conjuntos_idConjunto' => 'Conjuntos Id Conjunto',
            'idTitular' => 'Id Titular',
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

        $criteria->compare('idInmueble', $this->idInmueble);
        $criteria->compare('zona', $this->zona, true);
        $criteria->compare('numZona', $this->numZona, true);
        $criteria->compare('nombre', $this->nombre, true);
        $criteria->compare('tipo', $this->tipo, true);
        $criteria->compare('coeficienteCopropiedad', $this->coeficienteCopropiedad, true);
        $criteria->compare('matriculaInmobiliaria', $this->matriculaInmobiliaria, true);
        $criteria->compare('areaConstruida', $this->areaConstruida, true);
        $criteria->compare('estrato', $this->estrato, true);
        $criteria->compare('Conjuntos_idConjunto', $this->Conjuntos_idConjunto);
        $criteria->compare('idTitular', $this->idTitular);

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

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Inmuebles the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getTiposInmuebles() {
        return array(
            '' => '',
            'C' => 'Casa',
            'A' => 'Apartamento',
            'L' => 'Local',
            'O' => 'Oficina',
        );
    }

    public static function getZonas() {
        return array(
            '' => '',
            'B' => 'Bloque',
            'I' => 'Interior',
            'M' => 'Manzana',
            'T' => 'Torre',
        );
    }

    public static function getZona($inicial) {
        $zonas = self::getZonas();
        return $zonas[$inicial];
    }

    public static function getTipoInmueble($inicial) {
        $tipos = self::getTiposInmuebles();
        return $tipos[$inicial];
    }

    public static function getNombre($id) {
        $inmu = Inmuebles::model()->findByPk($id);
        return $inmu->nombre;
    }

    public static function getInmuebles($idConjunto) {
        return self::model()->findAll(self::getInmueblesCriteria($idConjunto));
    }

    public static function getInmueblesCriteria($idConjunto) {
        $criteria = new CDbCriteria;

        $criteria->condition = "Conjuntos_idConjunto = '$idConjunto' ";

        return $criteria;
    }

    public static function buscarInmuebles($rol, $id) {
        return self::model()->findAll(self::getInmueblesCriteria2($rol, $id));
    }

    public static function getInmueblesCriteria2($rol, $id) {
        $criteria = new CDbCriteria;

        $criteria->join = "LEFT JOIN inmueblesporcontacto Ipj ON idInmueble = Ipj.Inmuebles_idInmueble ";
        $criteria->join .= "LEFT JOIN contactos Cn ON Cn.idContacto = Ipj.Contactos_idContacto ";
        $criteria->join .= "LEFT JOIN cruge_user Cuser ON Cn.cruge_user_iduser = Cuser.iduser ";
        $criteria->join .= "LEFT JOIN cruge_authassignment Auth ON Auth.userid = Cuser.iduser ";
        $criteria->condition = "Auth.itemname = '$rol' ";
        $criteria->condition .= "AND Cuser.iduser = $id ";

        return $criteria;
    }

    public function getNombreConjunto() {
        $conjunto = $this->conjuntosIdConjunto;
        return $conjunto->nombre;
    }

    public static function getNombreInmueble($inmueble) {
        $zona = Inmuebles::getZona($inmueble->zona) . ($inmueble->numZona != null ? " $inmueble->numZona" : "");
        $tipo = Inmuebles::getTipoInmueble($inmueble->tipo);
        return "$zona $tipo $inmueble->nombre";
    }

}
