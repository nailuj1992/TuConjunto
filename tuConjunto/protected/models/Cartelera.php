<?php

/**
 * This is the model class for table "cartelera".
 *
 * The followings are the available columns in table 'cartelera':
 * @property integer $idCartelera
 * @property string $titulo
 * @property string $descripcion
 * @property string $fechaPub
 * @property integer $Conjuntos_idConjunto
 * @property integer $idAutor
 * @property integer $fotoPrincipal
 */
class Cartelera extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cartelera';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titulo, descripcion, fechaPub', 'required'),
			array('idCartelera, Conjuntos_idConjunto, idAutor', 'numerical', 'integerOnly'=>true),
			array('titulo', 'length', 'max'=>255),
                        array('fotoPrincipal', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idCartelera, titulo, descripcion, fechaPub, Conjuntos_idConjunto, idAutor, fotoPrincipal', 'safe', 'on'=>'search'),
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
                    'conjuntosIdConjunto' => array(self::BELONGS_TO, 'Conjuntos', 'Conjuntos_idConjunto'),			'idDestinatario0' => array(self::BELONGS_TO, 'Inmuebles', 'idDestinatario'),
                    'idAutor0' => array(self::BELONGS_TO, 'Inmuebles', 'idInmueble'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCartelera' => 'Id Cartelera',
			'titulo' => 'Título',
			'descripcion' => 'Descripción',
			'fechaPub' => 'Fecha Pub',
			'Conjuntos_idConjunto' => 'Conjuntos Id Conjunto',
			'idAutor' => 'Id Autor',
                        'fotoPrincipal' => 'Foto principal',
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

		$criteria->compare('idCartelera',$this->idCartelera);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('fechaPub',$this->fechaPub,true);
		$criteria->compare('Conjuntos_idConjunto',$this->Conjuntos_idConjunto);
		$criteria->compare('idAutor',$this->idAutor);
                $criteria->compare('fotoPrincipal',$this->fotoPrincipal);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cartelera the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public static function getShortDesc($id) {
        $cartelera = Cartelera::model()->findByPk($id);
        if (strlen($cartelera->descripcion) >= 40) {
            $small = strip_tags(substr($cartelera->descripcion, 0, 50));
            $small = str_replace("&nbsp;", "", $small);
            $small .= "...";
        } else {
            $small = strip_tags($cartelera->descripcion);
            $small = str_replace("&nbsp;", "", $small);
        }

        return $small;
    }

}
