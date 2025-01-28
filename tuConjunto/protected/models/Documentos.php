<?php

/**
 * This is the model class for table "documentos".
 *
 * The followings are the available columns in table 'documentos':
 * @property integer $idDocumentos
 * @property string $nombre
 * @property string $categoria
 * @property string $urlDocumento
 * @property integer $Conjuntos_idConjunto
 *
 * The followings are the available model relations:
 * @property Conjuntos $conjuntosIdConjunto
 */
class Documentos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */    public static $size = 2; // en MB

        public static function maxSize() {
            return 1024 * 1024 * self::$size;
        }

	public function tableName()
	{
		return 'documentos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, categoria, Conjuntos_idConjunto', 'required'),
                        array('urlDocumento', 'length', 'max'=>250),
                        array('urlDocumento', 'file',
                               'types'=>'pdf,txt',
                            'allowEmpty'=>true, 'on'=>'insert'
                        ),
			array('Conjuntos_idConjunto', 'numerical', 'integerOnly'=>true),
			array('nombre, categoria, urlDocumento', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idDocumentos, nombre, categoria, urlDocumento, Conjuntos_idConjunto', 'safe', 'on'=>'search'),
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
			'conjuntosIdConjunto' => array(self::BELONGS_TO, 'Conjuntos', 'Conjuntos_idConjunto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idDocumentos' => 'Id Documentos',
			'nombre' => 'Nombre',
			'categoria' => 'Categoría',
			'urlDocumento' => 'Documento',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idDocumentos',$this->idDocumentos);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('categoria',$this->categoria,true);
		$criteria->compare('urlDocumento',$this->urlDocumento,true);
		$criteria->compare('Conjuntos_idConjunto',$this->Conjuntos_idConjunto);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Documentos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public static function getCategories() {
        return array(
            '' => '',
            'DJ' => 'Documentos jurídicos',
            'C' => 'Contratos',
            'ACO' => 'Actas del concejo',
            'ACM' => 'Actas del comite de convivencia',
            'AA' => 'Actas de asamblea', 
        );
    }
}
