<?php
class Area extends All
{

	public function tableName()
	{
		return 'area';
	}

	public function rules()
	{
		return array(
			array('region_id', 'numerical', 'integerOnly'=>true),
			array('name, koatu', 'length', 'max'=>255),
			array('id, name, koatu, region_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'koatu' => 'Koatu',
			'region_id' => 'Region',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('koatu',$this->koatu,true);
		$criteria->compare('region_id',$this->region_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
