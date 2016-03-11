<?php
/**
 * Модель User
 *
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $role
 */
class User extends All {
    const ROLE_ADMIN = 'administrator';
    const ROLE_MODER = 'moderator';
    const ROLE_USER = 'user';
    const ROLE_BANNED = 'banned';

    public static function model($className=__CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return 'user';
    }

    protected function beforeSave(){
        $this->password = md5($this->password);
        return parent::beforeSave();
    }
    ///////////////////////////////////
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'logs' => array(self::HAS_MANY, 'Log', 'user_id'),
            'userRole' => array(self::BELONGS_TO, 'UserRole', 'user_role_id'),
        );
    }
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'realname' => 'Realname',
            'email' => 'Email',
            'user_role_id' => 'User Role',
        );
    }
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('login',$this->login,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('realname',$this->realname,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('user_role_id',$this->user_role_id);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('login, password, realname, email, user_role_id', 'required'),
            array('user_role_id', 'numerical', 'integerOnly'=>true),
            array('login, password, realname, email', 'length', 'max'=>255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, login, password, realname, email, user_role_id', 'safe', 'on'=>'search'),
        );
    }
}