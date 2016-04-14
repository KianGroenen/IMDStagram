<?php

include_once("Db.class.php");
class User
{
    private $m_sUsername;
    private $m_sPassword;
    private $m_sEmail;
    public function __set($p_sProperty, $p_vValue)
    {
        switch($p_sProperty)
        {
            case "username":
                $this->m_sUsername = $p_vValue;
                break;
            case "password":
                $this->m_sPassword = $p_vValue;
                break;
            case "email":
                $this->m_sEmail = $p_vValue;
                break;
        }
    }

    public function __get($p_sProperty)
    {
        $vResult = null;
        switch($p_sProperty)
        {
            case "username":
                $vResult = $this->m_sUsername;
                break;
            case "password":
                $vResult = $this->m_sPassword;
                break;
            case "email":
                $vResult = $this->m_sEmail;
                break;
        }
        return $vResult;
    }

    public function UsernameAvailable()
    {
        $PDO = Db::getInstance();

        $stm = $PDO->prepare('SELECT * FROM Users WHERE username = :username');
                $stm->bindValue(':username', $_POST["username"], $PDO::PARAM_STR);
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
 		$stmt->bindValue(':username', $_POST["username"], PDO::PARAM_STR);
 		$stmt->bindValue(':password', $_POST["password"], PDO::PARAM_STR);
 		$stmt->bindValue(':email', $_POST["email"], PDO::PARAM_STR);

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