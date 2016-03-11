<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property integer $id
 * @property integer $status
 * @property string $title
 * @property string $fio
 * @property string $date
 * @property string $url
 * @property string $description
 * @property double $square
 * @property integer $region_id
 * @property integer $files_id
 * @property integer $area_id
 * @property integer $domain_id
 *
 * The followings are the available model relations:
 * @property Kadnum[] $kadnums
 * @property Log[] $logs
 * @property Area $area
 * @property Domain $domain
 * @property Files $files
 * @property Region $region
 */
class Post extends CActiveRecord
{
    public $archive;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('date', 'required'),
            array('archive', 'file', 'types'=>'rar, zip, 7z','maxSize'=>100*1024*1024),
			array('status, region_id, files_id, area_id, domain_id', 'numerical', 'integerOnly'=>true),
			array('square', 'numerical'),
			array('title, fio, url', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, status, title, fio, date, url, description, square, region_id, files_id, area_id, domain_id', 'safe', 'on'=>'search'),
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
			'kadnums' => array(self::HAS_MANY, 'Kadnum', 'post_id'),
			'logs' => array(self::HAS_MANY, 'Log', 'post_id'),
			'area' => array(self::BELONGS_TO, 'Area', 'area_id'),
			'domain' => array(self::BELONGS_TO, 'Domain', 'domain_id'),
			'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
            'files' => array(self::HAS_MANY, 'Files', 'post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'status' => 'Статус',
			'title' => 'Название',
			'fio' => 'ФИО',
			'date' => 'Дата время',
			'url' => 'Url',
			'description' => 'Описание',
			'square' => 'Площадь (га)',
			'region_id' => 'Район',
			'files_id' => 'Files',
			'area_id' => 'Населенный пункт / Совет',
			'domain_id' => 'Область',
            'archive'=>'Архив',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('status',[1,2],true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('square',$this->square);
		$criteria->compare('region_id',$this->region_id);
		$criteria->compare('files_id',$this->files_id);
		$criteria->compare('area_id',$this->area_id);
		$criteria->compare('domain_id',$this->domain_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Post the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
