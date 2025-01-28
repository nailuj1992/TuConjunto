<?php

/**
 * Description of CambiarCredenciales
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class CambiarCredenciales extends CActiveRecord {

    public $new, $renew;

    public function tableName() {
        return 'cruge_user';
    }

    public function rules() {
        return array(
            array('username, email, password, new, renew', 'required'),
            array('username, password, new, renew', 'length', 'max' => 64),
            array('email', 'length', 'max' => 45),
            array('renew', 'compare', 'compareAttribute' => 'new', 'message' => 'Las contraseñas nuevas deben coincidir.'),
        );
    }

    public function attributeLabels() {
        return array(
            'iduser' => 'Iduser',
            'username' => 'Nombre de usuario',
            'email' => 'Correo',
            'password' => 'Ingrese la contraseña antigua',
            'new' => 'Ingrese la nueva contraseña',
            'renew' => 'Vuelva a ingresar la nueva contraseña',
        );
    }

    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'crugeAuthitems' => array(self::MANY_MANY, 'CrugeAuthitem', 'cruge_authassignment(userid, itemname)'),
            'crugeFieldvalues' => array(self::HAS_MANY, 'CrugeFieldvalue', 'iduser'),
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
