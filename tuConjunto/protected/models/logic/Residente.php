<?php

/**
 * Description of Residente
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class Residente extends CrugeUser2 {

    public $idInmueble;

    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, email, password, idConjunto, idInmueble', 'required'),
            array('state, totalsessioncounter, currentsessioncounter, idConjunto', 'numerical', 'integerOnly' => true),
            array('regdate, actdate, logondate', 'length', 'max' => 30),
            array('username, password', 'length', 'max' => 64),
            array('email', 'length', 'max' => 45),
            array('authkey', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('iduser, regdate, actdate, logondate, username, email, password, authkey, state, totalsessioncounter, currentsessioncounter', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels() {
        return array(
            'iduser' => 'Iduser',
            'regdate' => 'Regdate',
            'actdate' => 'Actdate',
            'logondate' => 'Logondate',
            'username' => 'Nombre de usuario',
            'email' => 'Correo',
            'password' => 'Contraseña',
            'authkey' => 'Authkey',
            'state' => 'State',
            'totalsessioncounter' => 'Totalsessioncounter',
            'currentsessioncounter' => 'Currentsessioncounter',
            'idConjunto' => 'Conjunto',
            'idInmueble' => 'Inmueble',
        );
    }

}
