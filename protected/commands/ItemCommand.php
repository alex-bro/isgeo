<?

class ItemCommand extends CConsoleCommand{


	/*public function run($args){
	
		
		print_r($args);
		
	}*/
	
	public function actionIndex($id,$name){
	
	
		print $id. "  ". $name;
	
	}

/*	public function actionType(array $types){
	
			print_r($types);
	}
	
	public function actionView(){
	
		$path = Yii::getPathOfAlias("application.commands.views");
		$this->renderFile($path."/index.php");
		
	}*/

}