<?php

include_once("Db.class.php");
class User
{
    private $m_sUserName;
    private $m_sPassword;
    private $m_sEmail;

    public function __set($p_sProperty, $p_vValue)
    {
        switch($p_sProperty)
        {
            case "UserName":
                $this->m_sUserName = $p_vValue;
                break;
            case "Password":
                $this->m_sPassword = $p_vValue;
                break;
            case "Email":
                $this->m_sEmail = $p_vValue;
                break;
        }
    }

    public function __get($p_sProperty)
    {
        switch($p_sProperty)
        {
            case "UserName":
                return $this->m_sUserName;
                break;
            case "Password":
                return $this->m_sPassword;
                break;
            case "Email":
                return $this->m_sEmail;
                break;
        }

    }

    public function UsernameAvailable()
    {
        $PDO = Db::getInstance();

        $stm = $PDO->prepare('SELECT * FROM Users WHERE username = :username');
                $stm->bindValue(':username', $this->m_sUserName, $PDO::PARAM_STR);
                $stm->execute();

                if($stm->rowCount() > 0) {
                    return false;
         } else {
                    return true;
         }
 	}

	public function Create()
 	{
 		$PDO = Db::getInstance();
 		$stmt = $PDO->prepare("INSERT INTO Users (username, password, email) VALUES (:username, :password, :email);");
 		$stmt->bindValue(':username', $this->m_sUserName, PDO::PARAM_STR);
 		$stmt->bindValue(':password', $this->m_sPassword, PDO::PARAM_STR);
 		$stmt->bindValue(':email', $this->m_sEmail, PDO::PARAM_STR);

 		if ($stmt->execute())
 		{
 			//query went OK!
 		}
		else
 		{
    			// er zijn geen query resultaten, dus query is gefaald
    			throw new Exception('Could not create your account!');
 		}
 	}

}
?>