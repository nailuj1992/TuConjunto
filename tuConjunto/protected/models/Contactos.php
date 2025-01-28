<?php

/**
 * This is the model class for table "contactos".
 *
 * The followings are the available columns in table 'contactos':
 * @property integer $idContacto
 * @property string $nombres
 * @property string $apellidos
 * @property string $telefono
 * @property string $celular
 * @property string $foto
 * @property string $genero
 * @property integer $Inmuebles_idInmueble
 * @property integer $cruge_user_iduser
 * @property integer $Conjuntos_idConjunto
 *
 * The followings are the available model relations:
 * @property Conjuntos $conjuntosIdConjunto
 * @property Inmuebles $inmueblesIdInmueble
 * @property CrugeUser $crugeUserIduser
 * @property Inmuebles[] $inmuebles
 * @property Vehiculos[] $vehiculoses
 */
class Contactos extends CActiveRecord {

    public static $contactoRegistrado = "Debes ser un contacto registrado.";
    public static $seleccioneContacto = "--Seleccione un destinatario--";
    public static $usuarioDesconocido = "USUARIO DESCONOCIDO";
    public static $widthFoto = 100;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'contactos';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombres, apellidos, telefono, celular, genero, Conjuntos_idConjunto, cedula', 'required'),
            array('telefono, celular, Inmuebles_idInmueble, cruge_user_iduser, Conjuntos_idConjunto', 'numerical', 'integerOnly' => true),
            array('nombres, apellidos', 'length', 'max' => 255),
            array('telefono, celular', 'length', 'max' => 11),
            array('genero', 'length', 'max' => 1),
            array('cedula', 'length', 'max'=>15),
            array('foto', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('idContacto, nombres, apellidos, telefono, celular, foto, genero, Inmuebles_idInmueble, cruge_user_iduser, Conjuntos_idConjunto, cedula', 'safe', 'on' => 'search'),
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
            'inmueblesIdInmueble' => array(self::BELONGS_TO, 'Inmuebles', 'Inmuebles_idInmueble'),
            'crugeUserIduser' => array(self::BELONGS_TO, 'CrugeStoredUser', 'cruge_user_iduser'),
            'inmuebles' => array(self::HAS_MANY, 'Inmuebles', 'idTitular'),
            'vehiculoses' => array(self::HAS_MANY, 'Vehiculos', 'idDueno'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'idContacto' => 'Id Contacto',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'telefono' => 'Telefono',
            'celular' => 'Celular',
            'foto' => 'Foto',
            'genero' => 'Género',
            'Inmuebles_idInmueble' => 'Inmuebles Id Inmueble',
            'cruge_user_iduser' => 'Cruge User Iduser',
            'Conjuntos_idConjunto' => 'Conjuntos Id Conjunto',
            'cedula' => 'Cédula',
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

        $criteria->compare('idContacto', $this->idContacto);
        $criteria->compare('nombres', $this->nombres, true);
        $criteria->compare('apellidos', $this->apellidos, true);
        $criteria->compare('telefono', $this->telefono, true);
        $criteria->compare('celular', $this->celular, true);
        $criteria->compare('foto', $this->foto, true);
        $criteria->compare('genero', $this->genero, true);
        $criteria->compare('Inmuebles_idInmueble', $this->Inmuebles_idInmueble);
        $criteria->compare('cruge_user_iduser', $this->cruge_user_iduser);
        $criteria->compare('Conjuntos_idConjunto', $this->Conjuntos_idConjunto);
        $criteria->compare('cedula',$this->cedula,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function buscar($iduser) {
        $criteria = new CDbCriteria;

        $criteria->join = "LEFT JOIN cruge_user cu ON cu.iduser = cruge_user_iduser ";
        $criteria->condition = "cu.iduser = $iduser ";

        return $criteria;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Contactos the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Obtiene el contacto dado su iduser.
     * @param type $idUser ID de usuario (tabla cruge_user).
     * @return type
     */
    public static function getContacto($iduser) {
        return Contactos::model()->find(array(
                    'condition' => "cruge_user_iduser = $iduser",
        ));
    }

    public static function getGender() {
        return array(
            '' => '',
            'M' => 'Masculino',
            'F' => 'Femenino',
            'O' => 'Otro',
        );
    }

    public static function getGenero($inicial) {
        $generos = self::getGender();
        return $generos[$inicial];
    }

}
