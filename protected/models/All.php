<?php
class All extends CActiveRecord
{
    public static function addListDb($modelIn, $post){
        $regionId = CHtml::encode($post['region_id']);
        $arr = explode("\n", $post['name']);
        foreach(array_keys($arr) as $key) {
            $arr[$key] = trim($arr[$key]);

            $arr[$key] = mb_convert_case($arr[$key], MB_CASE_TITLE, 'UTF-8');
            $arr[$key] = str_replace('М. ', 'м. ', $arr[$key]);
            $arr[$key] = str_replace('С. ', 'с. ', $arr[$key]);
            $arr[$key] = str_replace('Смт ', 'смт ', $arr[$key]);
            $arr[$key] = str_replace('С-Ще ', 'с-ще ', $arr[$key]);

            $model = new $modelIn();
            $model->name = $arr[$key];
            $model->region_id = $regionId;
            $model->save();
            unset($model);
        }
        return true;
    }

    public static function addListDb2($modelIn, $post){
        $regionId = CHtml::encode($post['region_id']);
        $arr = explode("\n", $post['name']);
        foreach(array_keys($arr) as $key) {
            $arr[$key] = trim($arr[$key]);
            $arr[$key] = explode("\t", $arr[$key]);

            $model = new $modelIn();
            $model->name = $arr[$key][0];
            $model->koatu = $arr[$key][1];
            $model->region_id = $regionId;
            $model->save();
            unset($model);
        }
        return true;
    }
}