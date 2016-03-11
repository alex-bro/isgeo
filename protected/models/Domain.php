<?php
class Domain extends All
{
	public function tableName()
	{
		return 'domain';
	}
	public function rules()
	{
		return array(
			array('name', 'required'),
			array('name, koatu', 'length', 'max'=>255),
			array('id, name, koatu', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'regions' => array(self::HAS_MANY, 'Region', 'domain_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'koatu' => 'Koatu',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('koatu',$this->koatu,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
