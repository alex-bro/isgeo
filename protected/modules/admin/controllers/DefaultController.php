<?php

class DefaultController extends Admin
{
	public function actionIndex()
	{
		$this->render('index');
	}
}