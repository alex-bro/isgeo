<?php
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'ISGeo - информационная система геодезиста',
    'language'=>'ru',

	'preload'=>array('log'),

	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.vendor.*',
	),

	'modules'=>array(
        'admin',
	),

	'components'=>array(

        'file'=>array(
            'class'=>'application.extensions.file.CFile',
        ),

        'authManager' => array(
            'class' => 'PhpAuthManager',
            'defaultRoles' => array('guest'),
        ),

        'user'=>array(
            'class' => 'WebUser',
            'allowAutoLogin'=>true,
        ),

		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
			'rules'=>array(
                'admin'=>'/admin/user/admin',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),

			),
		),

	),

	'params'=>array(
		'adminEmail'=>'webmaster@example.com',
        'defaultPageSize'=>20,
	),
);
