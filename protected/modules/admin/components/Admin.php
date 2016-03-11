<?php
class Admin extends Controller{
    public function accessRules()
    {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete','index', 'view', 'create', 'update', 'add'),
                'roles'=> array('administrator'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }
}