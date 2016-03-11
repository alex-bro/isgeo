<?php

class SiteController extends Controller
{

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {

        return array(
            array('allow',
                'actions'=>array('login','page'),
                'users'=>array('*'),
            ),
            array('allow',
                'actions'=>array('addxml','clear','post','index','view','delete',
                    'error','contact','login','logout','page','upload','kadnum',
                    'upxml','files','sendxml','sendfile'),
                'roles'=> array('administrator','moderator','user'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

	public function actions()
	{
		return array(

			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

    public function actionClear (){
        unset($_SESSION['upFileXml']);
        $this->redirect($this->createUrl('post'));
    }
    // акшн запись загрука архива и его описание
    public function actionPost($id=false)
    {
        // если новая запись
        if ($id === false){
            // новая запись
            $model=new Post;
            // загружаем сессию с данными их хмл
            if($result = Yii::app()->session['upFileXml']){
                // парсим хмл
                $xml = Functions::parseXml($result);
                // проеделяем есть ли метка записи
                $saved = Yii::app()->session['saved'];

                // запись в таблицу кад файлов если он ранее не был записан
                if(!$saved)
                {
                    // логгирование и зпись
                    Log::Logging(11,Kadnum::addKadFile($result,$xml));
                    // устанавливаем метку записан
                    Yii::app()->session['saved'] = 1;
                }
                // наполнение формы данными из хмл
                $model->title = $xml['StreetName'].' '.$xml['Building'];
                $model->fio = $xml['FullName']->LastName.' '.$xml['FullName']->FirstName.' '.$xml['FullName']->MiddleName;
                $model->square = $xml['Size'];
                // поиск положение участка
                $area = Functions::findArea([$xml['Region'],$xml['District'],$xml['Settlement']]);
                // наполнение формы данными из хмл
                $model->domain_id =$area[0];
                $model->region_id =$area[1];
                $model->area_id =$area[2];
            }
        } else {
            // если существующая запись то подгрузить ее модель
            $model = Post::model()->findByPk($id);
        }
        // если пост
        if(isset($_POST['Post']))
        {
            //загрузка в модель данных из формы
            $model->attributes=$_POST['Post'];
            $model->archive=CUploadedFile::getInstance($model,'archive');
            // валидация модели
            $resFile = false;
            if($model->validate()){
                // зписываем модель пост
                 $model->save();
                // если есть сессия тоесть был загружен хмл
                if($result = Yii::app()->session['upFileXml']){
                    //$result['path'] = Functions::createPathUploadsNow();
                    // записывем файл
                     $resFile = $model->archive->saveAs($result['path'].'/'.$model->archive->name);
                }else{
                    // если нет сесси то хмл не загружен создаем путь сами
                    $result['path'] = Functions::createPathUploadsNow();
                    //записывем файл
                    $resFile = $model->archive->saveAs($result['path'].'/'.$model->archive->name);
                }
            }
            //запись в таблицу кад файла айди поста
            if(isset($result['filename'])){
                $criteria = new CDbCriteria();
                $criteria->compare('path',str_replace($_SERVER['DOCUMENT_ROOT'],'',$result['path']),true);
                $kadId = Kadnum::model()->find($criteria);
                if($kadId) Kadnum::model()->updateByPk($kadId->id,['post_id' => $model->id] );
            }
            if($resFile === true){
                // запист в таблицу имя архива
                $fileId = Files::addFile($model->id, $result['path'], $model->archive->name);
                // зпись в таблицу пост айди записи файла
                $model->files_id = $fileId;
            }

            // записиваем уникальный урл
            $model->url = $this->createAbsoluteUrl('index',['id'=>$model->id]);
            $model->save();
            // логгирование
            Log::Logging(31,$model->id);

            if(isset($result['filename']))Functions::addUrlToXml($result['path'].'/'.$result['filename'],$model->url);

            // уничтожаем сессию
            unset($_SESSION['upFileXml']);
            unset($_SESSION['saved']);
            // регистрируем скрипт флеш
            Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-success").animate({opacity: 1.0}, 5000).fadeOut("slow");',
                CClientScript::POS_READY
            );
            // устанавливаем флеш
            Yii::app()->user->setFlash('success',"Архив добавлен");
            // переброс на добавить хмл
            $this->redirect('/site/view');
        }
        // рендер
        $this->render('post',array('model'=>$model));
    }

	public function actionIndex($id=false)
	{
        $model =null;
        if ($id !== false) {
            $model = Post::model()->findByPk($id);
            Log::Logging(30,$id);
            $criteria = new CDbCriteria();
            $criteria->condition='post_id=:post_id AND status=:status';
            $criteria->params=array(':post_id'=>$id, ':status'=>1);
            $rawData=Files::model()->findAll($criteria);
            $dataProviderFile=new CArrayDataProvider($rawData, array(
                'id'=>'files',
                'sort'=>array(
                    'attributes'=>array(
                        'date',
                    ),
                ),
                'pagination'=>array(
                    'pageSize'=>20,
                ),
            ));
            $this->render('index',['model'=>$model,'dataFile'=>$dataProviderFile]);
        }else{
            $this->render('index');
        }

	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	public function actionLogin()
	{
		$model=new LoginForm;

		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
                Log::Logging(1);
				$this->redirect(Yii::app()->user->returnUrl);
		}
		$this->render('login',array('model'=>$model));
	}

	public function actionLogout()
	{
        Log::Logging(2);
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionView()
    {
        $model=new Post('search');
        $model->unsetAttributes();
        if(isset($_GET['Post']))
            $model->attributes=$_GET['Post'];

        $this->render('view',array(
            'model'=>$model,
        ));
    }
    // акшн удаление поста
    public function actionDelete($id)
    {
        if(Yii::app()->user->checkAccess('administrator')){
            $post = Post::model()->findByPk($id);
            $post->status = 0;
            Log::Logging(33,$id);
            Files::model()->updateAll(array('status' => 0 ), 'post_id = '.$post->id);
            Kadnum::model()->updateAll(array('status' => 0 ), 'post_id = '.$post->id);
            $post->save(false);
            $files = Files::model()->findAll('post_id=:post_id', array(':post_id' => $post->id));
            foreach($files as $file){
                if($file->type == 1 )Log::Logging(23,$id);
            }
            $kads = Files::model()->findAll('post_id=:post_id', array(':post_id' => $post->id));
            foreach($kads as $kad){
                if($kad->type == 1 )Log::Logging(13,$id);
            }
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('view'));
        }
    }
    // акшн показать список хмл
    public function actionKadnum()
    {
        $model=new Kadnum('search');
        $model->unsetAttributes();
        if(isset($_GET['Kadnum']))
            $model->attributes=$_GET['Kadnum'];

        $this->render('kadnum',array(
            'model'=>$model,
        ));
    }
    // акшн показать список архивов
    public function actionFiles()
    {
        $model=new Files('search');
        $model->unsetAttributes();
        if(isset($_GET['Files']))
            $model->attributes=$_GET['Files'];

        $this->render('files',array(
            'model'=>$model,
        ));
    }
    // акшн выбрать загруженный хмл
    public function actionUpxml($id=false){
        if($id !== false){
            $kad = Kadnum::model()->findByPk($id);
            if($kad){
                $arr = explode('/',$kad->path);
                $result['filename'] =end($arr);
                $result['path'] = $_SERVER['DOCUMENT_ROOT'].str_replace('/'.$result['filename'], '', $kad->path);
                Yii::app()->session['upFileXml'] = $result;
                Yii::app()->session['saved'] = 1;
                if(!$kad->post_id)$this->redirect('/site/post');
                else $this->redirect('/site/post/'.$kad->post_id);
            }
        }
    }
    // акшн скачиваем xml
    public function actionSendxml($id=false){
        if($id){
            $xml = Kadnum::model()->findByPk($id);
            if($xml){
                $fileName = end(explode('/',$xml->path));
                Log::Logging(10,$id);
                Yii::app()->request->sendFile($fileName, file_get_contents($_SERVER['DOCUMENT_ROOT'].$xml->path));
            }
        }
    }
    // акшн скачиваем файл архива
    public function actionSendfile($id=false){
        if($id){
            $file = Files::model()->findByPk($id);
            if($file){
                $fileName = end(explode('/',$file->path));
                Log::Logging(20,$id);
                Yii::app()->request->sendFile($fileName, file_get_contents($_SERVER['DOCUMENT_ROOT'].$file->path));
            }
        }
    }
}