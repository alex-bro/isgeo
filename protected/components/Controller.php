<?php

class Controller extends CController
{

	public $layout='//layouts/column1';

	public $menu=array();

	public $breadcrumbs=array();

    public function getList($model,$name){;
        $public = new $model();
        $pub = $public->findAll();
        $select = array();
        foreach ($pub as $item){
            $select[$item->id] = $item->$name;
        }
        return $select;
    }
    public function actionUpload()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");
        $folder=Functions::createPathUploadsNow();
        $allowedExtensions = array("jpg","jpeg","gif","png","doc","docx","xls","xlsx","pdf","txt","in4","rar","zip","xml","in4","odt");//array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 100 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder.'/');
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        $result['path'] = $folder;
        echo $return;// it's array
        unset($_SESSION['saved']);
        Yii::app()->session['upFileXml']=$result;
    }
}