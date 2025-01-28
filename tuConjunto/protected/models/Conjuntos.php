<?php

/**
 * This is the model class for table "conjuntos".
 *
 * The followings are the available columns in table 'conjuntos':
 * @property integer $idConjunto
 * @property string $nombre
 * @property string $nit
 * @property string $direccion
 * @property string $telefono
 * @property integer $Ciudades_idCiudades
 * @property string $logo
 * @property string $dominio
 *
 * The followings are the available model relations:
 * @property Asambleas[] $asambleases
 * @property Ciudades $ciudadesIdCiudades
 * @property Contactos[] $contactoses
 * @property Documentos[] $documentoses
 * @property Encuestas[] $encuestases
 * @property Inmuebles[] $inmuebles
 * @property Noticias[] $noticiases
 */
class Conjuntos extends CActiveRecord {

    public static $noConjuntoEnlazado = "Usted debe estar enlazado a un conjunto.";
    public static $seleccioneConjunto = "--Seleccione un conjunto--";
    public static $widthLogo = 100;
    public $departamento;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'conjuntos';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombre, nit, direccion, departamento, Ciudades_idCiudades, estrato', 'required'),
            array('telefono, departamento, Ciudades_idCiudades, estrato', 'numerical', 'integerOnly' => true),
            array('estrato', 'length', 'max' => 1),
            array('nombre, nit, direccion, dominio', 'length', 'max' => 255),
            array('telefono', 'length', 'max' => 11),
//            array('nit', 'length', 'max' => 11, 'min' => 11),
            array('nit', 'validarNit'),
            array('logo', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idConjunto, nombre, nit, direccion, telefono, Ciudades_idCiudades, logo, dominio, estrato', 'safe', 'on' => 'search'),
        );
    }

    public function validarNit() {
        if (strpos($this->nit, "-") !== false) {
            $nit = explode("-", $this->nit);
            $data = $nit[0];
            $digit = $nit[1];

            if (strlen($data) == 9) {
                // Algoritmo: https://es.wikipedia.org/wiki/N%C3%BAmero_de_Identificaci%C3%B3n_Tributaria
                $weight = array(41, 37, 29, 23, 19, 17, 13, 7, 3);
                $value = 0;
                for ($i = 0; $i < sizeof($weight); $i++) {
                    $value += $weight[$i] * $data[$i];
                }
                $value = $value % 11;
                if ($value >= 2) {
                    $value = 11 - $value;
                }
                if ($value != $digit) {
                    $this->addError('nit', 'El digito no coincide.');
                }
            } else {
                $this->addError('nit', 'El número antes del guión (-) no tiene 9 cifras.');
            }
        } else {
            $this->addError('nit', 'Falta un guión (-).');
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'asambleases' => array(self::HAS_MANY, 'Asambleas', 'Conjuntos_idConjunto'),
            'ciudadesIdCiudades' => array(self::BELONGS_TO, 'Ciudades', 'Ciudades_idCiudades'),
            'contactoses' => array(self::HAS_MANY, 'Contactos', 'Conjuntos_idConjunto'),
            'documentoses' => array(self::HAS_MANY, 'Documentos', 'Conjuntos_idConjunto'),
            'encuestases' => array(self::HAS_MANY, 'Encuestas', 'Conjuntos_idConjunto'),
            'inmuebles' => array(self::HAS_MANY, 'Inmuebles', 'Conjuntos_idConjunto'),
            'noticiases' => array(self::HAS_MANY, 'Noticias', 'Conjuntos_idConjunto'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idConjunto' => 'Id Conjunto',
            'nombre' => 'Nombre',
            'nit' => 'Nit',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'Ciudades_idCiudades' => 'Ciudad',
            'logo' => 'Logo',
            'dominio' => 'Dominio',
            'estrato' => 'Estrato',
            'departamento' => 'Departamento',
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

        $criteria->compare('idConjunto', $this->idConjunto);
        $criteria->compare('nombre', $this->nombre, true);
        $criteria->compare('nit', $this->nit, true);
        $criteria->compare('direccion', $this->direccion, true);
        $criteria->compare('telefono', $this->telefono, true);
        $criteria->compare('Ciudades_idCiudades', $this->Ciudades_idCiudades);
        $criteria->compare('logo', $this->logo, true);
        $criteria->compare('dominio', $this->dominio, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Conjuntos the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Obtiene el conjunto al que tiene acceso el usuario ingresado.
     * @param type $idUser id del usuario ingresado.
     * @return type
     */
    public static function getConjunto($idUser) {
        $contacto = Contactos::getContacto($idUser);
        if ($contacto != null) {
            return self::model()->findByPk($contacto->Conjuntos_idConjunto);
        } else {
            return null;
        }
    }

    public static function getNombre($id) {
        return self::model()->findByPk($id)->nombre;
    }

    public static function buscarConjuntos($rol, $id) {
        return new CActiveDataProvider(Conjuntos::model(), array(
            'criteria' => self::getConjuntosCriteria($rol, $id),
        ));
    }

    public static function buscarConjuntos2($rol, $id) {
        return self::model()->findAll(self::getConjuntosCriteria($rol, $id));
    }

    public static function getConjuntosCriteria($rol, $id) {
        $criteria = new CDbCriteria;

        $criteria->join = "LEFT JOIN conjuntosporcontacto Cpj ON idConjunto = Cpj.Conjuntos_idConjunto ";
        $criteria->join .= "LEFT JOIN contactos Cn ON Cn.idContacto = Cpj.Contactos_idContacto ";
        $criteria->join .= "LEFT JOIN cruge_user Cuser ON Cn.cruge_user_iduser = Cuser.iduser ";
        $criteria->join .= "LEFT JOIN cruge_authassignment Auth ON Auth.userid = Cuser.iduser ";
        $criteria->condition = "Auth.itemname = '$rol' ";
        $criteria->condition .= "AND Cuser.iduser = $id ";

        return $criteria;
    }

    public static function getEstratos() {
        return array(
            '' => '',
            '1' => '# 1',
            '2' => '# 2',
            '3' => '# 3',
            '4' => '# 4',
            '5' => '# 5',
            '6' => '# 6',
        );
    }

    public static function getEstrato($inicial) {
        $estratos = self::getEstratos();
        return $estratos[$inicial];
    }

}