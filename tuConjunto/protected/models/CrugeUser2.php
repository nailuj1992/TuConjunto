<?php

/**
 * This is the model class for table "cruge_user".
 *
 * The followings are the available columns in table 'cruge_user':
 * @property integer $iduser
 * @property string $regdate
 * @property string $actdate
 * @property string $logondate
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $authkey
 * @property integer $state
 * @property integer $totalsessioncounter
 * @property integer $currentsessioncounter
 *
 * The followings are the available model relations:
 * @property CrugeAuthitem[] $crugeAuthitems
 * @property CrugeFieldvalue[] $crugeFieldvalues
 */
class CrugeUser2 extends CActiveRecord {

    public $idConjunto;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'cruge_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, email, password, idConjunto', 'required'),
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

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'crugeAuthitems' => array(self::MANY_MANY, 'CrugeAuthitem', 'cruge_authassignment(userid, itemname)'),
            'crugeFieldvalues' => array(self::HAS_MANY, 'CrugeFieldvalue', 'iduser'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
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

        $criteria->compare('iduser', $this->iduser);
        $criteria->compare('regdate', $this->regdate, true);
        $criteria->compare('actdate', $this->actdate, true);
        $criteria->compare('logondate', $this->logondate, true);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('authkey', $this->authkey, true);
        $criteria->compare('state', $this->state);
        $criteria->compare('totalsessioncounter', $this->totalsessioncounter);
        $criteria->compare('currentsessioncounter', $this->currentsessioncounter);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function buscar($rol) {
        return new CActiveDataProvider($this, array(
            'criteria' => $this->getCriteria($rol),
        ));
    }

    public function buscarResidente($rol) {
        return new CActiveDataProvider($this, array(
            'criteria' => $this->getCriteriaResidente($rol),
        ));
    }

    public function getCriteria($rol) {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $criteria = new CDbCriteria;

        $criteria->distinct = true;
        $criteria->join = "RIGHT JOIN cruge_authassignment Auth ON Auth.userid = iduser ";
        $criteria->condition = "Auth.itemname = '$rol' ";
        if ($conjunto != null) {
            $criteria->join .= "RIGHT JOIN contactos Cn ON iduser = Cn.cruge_user_iduser ";
            $criteria->join .= "RIGHT JOIN conjuntos Cj ON Cn.Conjuntos_idConjunto = Cj.idConjunto ";
            $criteria->condition .= "AND Cj.idConjunto = $conjunto->idConjunto ";
        }

        return $criteria;
    }

    public function getCriteriaResidente($rol) {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $criteria = new CDbCriteria;

        $criteria->distinct = true;
        $criteria->join = "RIGHT JOIN cruge_authassignment Auth ON Auth.userid = iduser ";
        $criteria->condition = "Auth.itemname = '$rol' ";
        if ($conjunto != null) {
            $criteria->join .= "RIGHT JOIN contactos Cn ON iduser = Cn.cruge_user_iduser ";
            $criteria->join .= "RIGHT JOIN inmueblesporcontacto ipc ON ipc.Contactos_idContacto = Cn.idContacto ";
            $criteria->join .= "RIGHT JOIN inmuebles i ON ipc.Inmuebles_idInmueble = i.idInmueble ";
            $criteria->join .= "RIGHT JOIN conjuntos Cj ON i.Conjuntos_idConjunto = Cj.idConjunto ";
            $criteria->condition .= "AND Cj.idConjunto = $conjunto->idConjunto ";
        }

        return $criteria;
    }

    public function getEstado($usuario) {
        $user = CrugeUser2::model()->find("iduser =:iduser", array(":iduser" => $usuario));

        if ($user->state == 1) {
            return "Activada";
        } else
            return "Desactivada";
    }

    public function getLogondate($usuario) {
        $user = CrugeUser2::model()->find("iduser =:iduser", array(":iduser" => $usuario));
        if ($user->logondate != null) {
            return Yii::app()->dateFormatter->format("yyyy-MM-dd", strtotime($user->logondate));
        }
    }

    // Yii::app()->dateFormatter->format("d MMM y h s",strtotime("logondate"))'

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CrugeUser the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * Permite enviar un correo al usuario dado.
     * @param type $usuario Informacion del usuario.
     * @param type $pass Contrasena SIN HASH del usuario.
     * @return type
     */
    public static function enviarCorreo($usuario, $pass) {
        $user = new CrugeStoredUser;
        $user->username = $usuario->username;
        $user->email = $usuario->email;
        $user->password = $pass;
        $user->authkey = $usuario->authkey;

        $message = Yii::app()->sendgrid->createEmail();
        $message->setHtml('<h2> ¡Bienvenido a Tu Conjunto! </h2>'
                        . '<p>Tu cuenta ha sido creada exitosamente.</p>'
                        . '<p>Ahora, visita este link para verificarla</p>'
                        . '<p><a href="' . Yii::app()->user->um->getActivationUrl($user) . '">Click aquí para Activar</a></p>'
                        . '<b>Usuario y contraseña</b>'
                        . '<p> Usuario: ' . $user->username . '</p>'
                        . '<p> correo: ' . $user->email . '</p>'
                        . '<p> contraseña: ' . $user->password . '</p>'
                        . '<br>'
                        . '<p>Una vez actives tu cuenta, te sugerimos que modifiques tu perfil y cambies tu contraseña <br>'
                        . 'para que puedas disfrutar con mayor seguridad de tu estancia por acá.</p>'
                        . '<p>¡Te esperamos!</p>'
                        . '<br>'
                        . '<p>Equipo de <a href="tuconjunto.com.co">Tu Conjunto</a></p>')
                ->setSubject('¡Bienvenido a Tu Conjunto!')
                ->addTo($user->email)
                ->setFrom('contacto@tuconjunto.com.co');
        return Yii::app()->sendgrid->send($message);
    }

    public static function generateAuthKey($user) {
        return CrugeUtil::hash($user->username . "-" . $user->password);
    }

}
