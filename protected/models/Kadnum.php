<?php

/**
 * This is the model class for table "kadnum".
 *
 * The followings are the available columns in table 'kadnum':
 * @property integer $id
 * @property integer $status
 * @property string $kad0
 * @property string $kad1
 * @property string $kad2
 * @property string $kad3
 * @property integer $date
 * @property string $path
 * @property string $title
 * @property string $fio
 * @property integer $post_id

 *
 * The followings are the available model relations:
 * @property Post $post
 * @property Files $files
 */
class Kadnum extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'kadnum';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, date, post_id', 'numerical', 'integerOnly'=>true),
			array('kad0', 'length', 'max'=>10),
			array('kad1', 'length', 'max'=>2),
			array('kad2', 'length', 'max'=>3),
			array('kad3', 'length', 'max'=>4),
			array('path, title, fio', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, status, kad0, kad1, kad2, kad3, date, path, title, fio, post_id', 'safe', 'on'=>'search'),
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
			//'post' => array(self::BELONGS_TO, 'Post', 'post_id'),
            //'posts' => array(self::HAS_MANY, 'Post', 'post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'status' => 'Status',
			'kad0' => 'КОАТУ',
			'kad1' => 'Зона',
			'kad2' => 'Квартал',
			'kad3' => 'Участок',
			'date' => 'Дата',
			'path' => 'Путь',
			'title' => 'Название',
			'fio' => 'ФИО',
			'post_id' => 'Пост',
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
		//$criteria->compare('status',$this->status);
        $criteria->compare('status',[1,2],true);
		$criteria->compare('kad0',$this->kad0,true);
		$criteria->compare('kad1',$this->kad1,true);
		$criteria->compare('kad2',$this->kad2,true);
		$criteria->compare('kad3',$this->kad3,true);
		$criteria->compare('date',$this->date);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('post_id',$this->post_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kadnum the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    // зписывает данные о хмл в таблицу
    public static function addKadFile($result,$xml){
        $kad = new Kadnum();
        $kad->status = 1;
        $kad->kad0 = $xml['KOATUU'];
        $kad->kad1 = $xml['CadastralZoneNumber'];
        $kad->kad2 = $xml['CadastralQuarterNumber'];
        $kad->kad3 = $xml['ParcelID'];
        $kad->path = str_replace($_SERVER['DOCUMENT_ROOT'],'',$result['path']).'/'.$result['filename'];
        $kad->title  = $xml['StreetName'].' '.$xml['Building'];
        $kad->fio = $xml['FullName']->LastName.' '.$xml['FullName']->FirstName.' '.$xml['FullName']->MiddleName;
        $kad->save();
        return $kad->id;
    }
}
