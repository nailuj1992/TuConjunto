<?php

/**
 * This is the model class for table "autorizado".
 *
 * The followings are the available columns in table 'autorizado':
 * @property integer $idAutorizado
 * @property integer $Inmuebles_idInmueble
 * @property string $siempre
 * @property string $horaEntrada
 * @property string $horaSalida
 * @property string $nombres
 * @property string $apellidos
 * @property string $foto
 * @property string $cedula
 * @property integer $bloqueado
 *
 * The followings are the available model relations:
 * @property Inmuebles $inmueblesIdInmueble
 */
class Autorizado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'autorizado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Inmuebles_idInmueble, horaEntrada, horaSalida, dia, nombres, apellidos, cedula, bloqueado', 'required'),
			array('Inmuebles_idInmueble, bloqueado', 'numerical', 'integerOnly'=>true),
			array('siempre', 'length', 'max'=>1),
			array('nombres, apellidos, foto, dia', 'length', 'max'=>255),
			array('cedula', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idAutorizado, Inmuebles_idInmueble, siempre, horaEntrada, horaSalida, dia, nombres, apellidos, foto, cedula, bloqueado', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'inmueblesIdInmueble' => array(self::BELONGS_TO, 'Inmuebles', 'Inmuebles_idInmueble'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idAutorizado' => 'Id Autorizado',
			'Inmuebles_idInmueble' => 'Inmuebles Id Inmueble',
			'siempre' => 'Siempre',
			'horaEntrada' => 'Hora Entrada',
			'horaSalida' => 'Hora Salida',
                        'dia' => 'Día de la semana',
			'nombres' => 'Nombres',
			'apellidos' => 'Apellidos',
			'foto' => 'Foto',
			'cedula' => 'Cedula',
			'bloqueado' => 'Bloqueado',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idAutorizado',$this->idAutorizado);
		$criteria->compare('Inmuebles_idInmueble',$this->Inmuebles_idInmueble);
		$criteria->compare('siempre',$this->siempre,true);
		$criteria->compare('horaEntrada',$this->horaEntrada,true);
		$criteria->compare('horaSalida',$this->horaSalida,true);
                $criteria->compare('dia',$this->dia,true);
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('apellidos',$this->apellidos,true);
		$criteria->compare('foto',$this->foto,true);
		$criteria->compare('cedula',$this->cedula,true);
		$criteria->compare('bloqueado',$this->bloqueado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Autorizado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getTime() {
        return array(
            '' => '',
            '00:00:00' => '12:00 am',
            '00:30:00' => '12:30 am',
            '01:00:00' => '1:00 am',
            '01:30:00' => '1:30 am',
            '02:00:00' => '2:00 am',
            '02:30:00' => '2:30 am',
            '03:00:00' => '3:00 am',
            '03:30:00' => '3:30 am',
            '04:00:00' => '4:00 am',
            '04:30:00' => '4:30 am',
            '05:00:00' => '5:00 am',
            '05:30:00' => '5:30 am',
            '06:00:00' => '6:00 am',
            '06:30:00' => '6:30 am',
            '07:00:00' => '7:00 am',
            '07:30:00' => '7:30 am',
            '08:00:00' => '8:00 am',
            '08:30:00' => '8:30 am',
            '09:00:00' => '9:00 am',
            '09:30:00' => '9:30 am',
            '10:00:00' => '10:00 am',
            '10:30:00' => '10:30 am',
            '11:00:00' => '11:00 am',
            '11:30:00' => '11:30 am',
            
            '12:00:00' => '12:00 pm',
            '12:30:00' => '12:30 pm',
            '13:00:00' => '1:00 pm',
            '13:30:00' => '1:30 pm',
            '14:00:00' => '2:00 pm',
            '14:30:00' => '2:30 pm',
            '15:00:00' => '3:00 pm',
            '15:30:00' => '3:30 pm',
            '16:00:00' => '4:00 pm',
            '16:30:00' => '4:30 pm',
            '17:00:00' => '5:00 pm',
            '17:30:00' => '5:30 pm',
            '18:00:00' => '6:00 pm',
            '18:30:00' => '6:30 pm',
            '19:00:00' => '7:00 pm',
            '19:30:00' => '7:30 pm',
            '20:00:00' => '8:00 pm',
            '20:30:00' => '8:30 pm',
            '21:00:00' => '9:00 pm',
            '21:30:00' => '9:30 pm',
            '22:00:00' => '10:00 pm',
            '22:30:00' => '10:30 pm',
            '23:00:00' => '11:00 pm',
            '23:30:00' => '11:30 pm',
        );
    }
      public static function getDia() {
        return array(
            '' => '',
            'L' => 'Lunes',
            'M' => 'Martes',
            'X' => 'Miércoles',
            'J' => 'Jueves',
            'V' => 'Viernes',
            'S' => 'Sábado',
            'D' => 'Domingo',
        );
    }
    
     public static function getNombreDia($dia) {
         if ($dia=='L'){
             return 'Lunes';
         }
         elseif ($dia=='M'){
             return 'Martes';
         }
         elseif ($dia=='X'){
             return 'Miércoles';
         }
         elseif ($dia=='J'){
             return 'Jueves';
         }
         elseif ($dia=='V'){
             return 'Viernes';
         }
         elseif ($dia=='S'){
             return 'Sábado';
         }
         elseif ($dia=='D'){
             return 'Domingo';
         }
         
         
         
    }
}
