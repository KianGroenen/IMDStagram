<?php

include_once("Db.class.php");
class User
{
    private $m_sUserName;
    private $m_sPassword;
    private $m_sEmail;
    private $m_bPrive;
    private $m_sProfilePicture;
    private $m_sID;


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
            case "Prive":
                $this->m_bPrive = $p_vValue;
                break;
            case "ProfilePicture":
                $this->m_sProfilePicture = $p_vValue;
                break;
            case "ID":
                $this->m_sID = $p_vValue;
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
            case "Prive":
                return $this->m_bPrive;
                break;
            case "ProfilePicture":
                return $this->m_sProfilePicture;
                break;
            case "ID":
                return $this->m_sID;
                break;
        }

    }


    /*je kan zowel met email als met username inloggen fetch_ASSOC vind wat bij mekaar hoort*/
    public function canLogin() {
        if(!empty($this->m_sUserName) && !empty($this->m_sPassword)){
            $PDO = Db::getInstance();
            $stmt = $PDO->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindValue(":username", $this->m_sUserName, PDO::PARAM_STR );
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $password = $this->m_sPassword;
                $hash = $result['password'];

                if(password_verify($password, $hash)){
                    $this->createSession($result['ID']);
                    return true;
                }
                else{
                    return false;
                }
            }
            else {
                return false;
            }
        }
    }

    public function UsernameAvailable()
    {
        $PDO = Db::getInstance();

        $stm = $PDO->prepare('SELECT * FROM users WHERE username = :username');
                $stm->bindValue(':username', $this->m_sUserName, $PDO::PARAM_STR);
                $stm->execute();

                if($stm->rowCount() > 0) {
                    return false;
         } else {
                    return true;
         }
 	}
    
    
    public function Edit() {
        $PDO = Db::getInstance();
        $options = ['cost' => 12];
        $protectedPW = password_hash($this->m_sPassword, PASSWORD_DEFAULT, $options);
        /*$sql = "UPDATE users SET 
                    username = :username, 
                    password = :password, 
                    email = :email,  
                    Avatar = :Avatar,  
                    prive = :prive  
                WHERE ID = :ID";*/
        $sql = "UPDATE users SET ";
        
        if (!empty($this->m_sUserName)) {
            $sql .= "username = :username, ";
        }
        
        if (!empty($this->m_sPassword)) {
            $sql .= "password = :password, ";
        }
        
        if (!empty($this->m_sEmail)) {
            $sql .= "email = :email, ";
        }
        
        if (!empty($this->m_sProfilePicture || $this->m_sProfilePicture != NULL )) {
            $sql .= "Avatar = :Avatar, ";
        }
        
        $sql .= "prive = :prive ";
        $sql .= "WHERE ID = :ID";
        
        $statement = $PDO->prepare($sql);
        if (!empty($this->m_sUserName)) {
            $statement->bindValue(':username', $this->m_sUserName, PDO::PARAM_STR);
        }
        
        if (!empty($this->m_sPassword)) {
            $statement->bindValue(':password', $protectedPW, PDO::PARAM_STR);
        }
 		
        if (!empty($this->m_sEmail)) {
            $statement->bindValue(':email', $this->m_sEmail, PDO::PARAM_STR);
        }
 		
        if (!empty($this->m_sProfilePicture || $this->m_sProfilePicture != NULL )) {
            $statement->bindValue(':Avatar', $this->m_sProfilePicture, PDO::PARAM_STR);
        }
        
        $statement->bindValue(':prive', $this->m_bPrive, PDO::PARAM_BOOL);
        $statement->bindValue(':ID', $this->m_sID, PDO::PARAM_STR);
        
        if ($statement->execute()) {
            print_r("Profile Updated");
        } else {
            throw new exception("Could not update your account!");
        }
    }
    
	public function Create()
 	{
 		$PDO = Db::getInstance();
 		$stmt = $PDO->prepare("INSERT INTO users (username, password, email, prive, Avatar) VALUES (:username, :password, :email, :prive, :profilepicture);");
        $options = [ 'cost' => 12];
        $password = password_hash($this->m_sPassword, PASSWORD_DEFAULT, $options);
 		$stmt->bindValue(':username', $this->m_sUserName, PDO::PARAM_STR);
 		$stmt->bindValue(':password', $password, PDO::PARAM_STR);
 		$stmt->bindValue(':email', $this->m_sEmail, PDO::PARAM_STR);
        $stmt->bindValue(':prive', $this->m_bPrive, PDO::PARAM_BOOL);
        $stmt->bindValue(':profilepicture', $this->m_sProfilePicture, PDO::PARAM_STR);
        
 		if ($stmt->execute())
        {
            
             $PDO = Db::getInstance();
        $stmt2 = $PDO->prepare("SELECT * FROM users WHERE username = :username");
        $stmt2->bindParam(":username", $this->m_sUserName);
        $stmt2->execute();
        $data = $stmt2->fetch(); 
        $volgID = $data["ID"];
            
        $stmt3 = $PDO->prepare("INSERT INTO follows (followed_user_ID, follower_ID) VALUES (:followed, :follower);");
 		$stmt3->bindValue(':followed', $volgID);
 		$stmt3->bindValue(':follower', $volgID);
        if ($stmt3->execute())
        {
            
            //query went OK!
            header("Location: login.php");
           
 		}
		else
 		{
    			// er zijn geen query resultaten, dus query is gefaald
    			throw new Exception('Could not create your account!');
 		}
           
 		}
		else
 		{
    			// er zijn geen query resultaten, dus query is gefaald
    			throw new Exception('Could not create your account!');
 		}
 	} 
    
    private function createSession($id) {
        session_start();
        $_SESSION["ID"] = $id;
    }
    

}
?>