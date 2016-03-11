<?php
class WebUser extends CWebUser {
    private $_model = null;

    function getRole() {
        if($user = $this->getModel()){
            // в таблице User есть поле role
            return $user->role;
        }
    }

    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $user =User::model()->findByPk($this->id);
            $this->_model = $user->userRole;
        }
        return $this->_model;
    }
}