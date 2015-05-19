<?php

class UserIdentity extends CUserIdentity
{
	private $id;

	public function authenticate()
	{
        if (strpos($this->username, '@') !== false) {
            $record=User::model()->findByAttributes(array('email'=>$this->username));
        } else {
            $record=User::model()->findByAttributes(array('username'=>$this->username));
        }

        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password!==md5($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->id=$record->id;
            $this->setState('role', $record->role);
            $this->setState('name', $record->name);
            $this->setState('id', $record->id);           
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
 
    public function getId(){
        return $this->id;
    }
}

