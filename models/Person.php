<?php

// auto-loading
Yii::setPathOfAlias('Person', dirname(__FILE__));
Yii::import('Person.*');

class Person extends BasePerson
{

    //public $create_at;
    
    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function init()
    {
        return parent::init();
    }

    public function getItemLabel()
    {
        return parent::getItemLabel();
    }

    public function getCreate_at()
    {
        if(empty($this->user_id)){
            return '-';
        }
        $mUser = User::model()->findbyPk($this->user_id);
        return $mUser->create_at;
    }

    public function getLastvisit_at()
    {
        if(empty($this->user_id)){
            return '-';
        }
        $mUser = User::model()->findbyPk($this->user_id);
        return $mUser->lastvisit_at;
    }
    
//    public function getUserCreateAt()
//    {
//        return (string) $this->create_at;
//    }    

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            array()
        );
    }

    public function rules()
    {
        return array_merge(
            parent::rules()
        /* , array(
          array('column1, column2', 'rule1'),
          array('column3', 'rule2'),
          ) */
        );
    }

    public function search()
    {
        $criteria = $this->searchCriteria();
        //$criteria->select .= ', user.create_at user_create_at';

        //$criteria->join .= 'INNER JOIN user ON t.user_id = id';        
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
            'sort'=>array(
                'defaultOrder'=>'last_name,first_name',
            )    

        ));
    }
    
    /**
     * for person create user, assign Customer office role, send Inivation email
     * @param int $person_id
     * @return boolean
     */
    public function createUser($person_id){
        
        $m = Person::model();
        $model = $m->findByPk($person_id);
        
        //person may be already registred as user
        if(!empty($model->user_id)){
            return TRUE;
        }
        
        //create user
        $password = $this->randomPassword();
        $mUser = new User;
        $mUser->attributes = array(
            'username' => $model->email,
            'password' => UserModule::encrypting($password),
            'email' => $model->email,
            'superuser' => 0,
            'status' => User::STATUS_ACTIVE,
        );
        $mUser->activkey = UserModule::encrypting(microtime() . $password);

        if (!$mUser->save()) {
            return FALSE;
        }
       
        //attach user to person
        $model->user_id = $mUser->id;
        $model->save();

        //create user profile
		$profile=new Profile;
		$profile->user_id=$mUser->id;
		$profile->first_name=$model->first_name;
		$profile->last_name=$model->last_name;
		$profile->save();
        unset($profile);

        //add Customer office role
        Rights::assign(DbrUser::RoleCustomerOffice, $mUser->id);
        
        //send email
        Yii::import('vendor.dbrisinajumi.person.components.invitationEmail');
        $e = new invitationEmail();
        $name = $model->first_name . ' ' . $model->last_name;
        $e->sendInvitate($model->email, $password, $model->email, $name);
        
        return true;        
        
    }

    /**
     * for person create user, assign Customer office role, send Inivation email
     * @param int $person_id
     * @return boolean
     */
    public function resetPassword($person_id){
        
        $m = Person::model();
        $model = $m->findByPk($person_id);
        
        //person must be registred
        if(empty($model->user_id)){
            return TRUE;
        }
        
        //reset password and email 
        $password = $this->randomPassword();
        $mUser = User::model()->findbyPk($model->user_id);
        $mUser->attributes = array(
            'username' => $model->email,
            'password' => UserModule::encrypting($password),
            'email' => $model->email,
            'status' => User::STATUS_ACTIVE,
        );
        $mUser->activkey = UserModule::encrypting(microtime() . $password);

        if (!$mUser->save()) {
            return FALSE;
        }
       
       
        //send email
        Yii::import('vendor.dbrisinajumi.person.components.resetPasswordEmail');
        $e = new resetPasswordEmail();
        $name = $model->first_name . ' ' . $model->last_name;
        $e->sendInvitate($model->email, $password, $model->email, $name);
        
        return true;        
        
    }
    
    /**
     * @param type $len
     * @return type
     */
    public function randomPassword($len = 8) {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $len; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }    

}
