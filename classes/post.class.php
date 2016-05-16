<?php
include_once("classes/Db.class.php");
    class Post
    {
        
        private $m_iUserID;
        private $m_sPostText;
        private $m_sImageType;
        private $m_sImageName;
        private $m_sImageTmpName;
        private $m_bImageError;
        private $m_sLocation;
        
        public function __construct($p_iUserID, $p_sPostText, $p_sImageType, $p_sImageName, $p_sImageTmpName, $p_bImageError, $p_sLocation)
        {
            
            $this->m_iUserID = $p_iUserID;
            $this->m_sPostText = $p_sPostText;
            $this->m_sImageType = $p_sImageType;
            $this->m_sImageName = $p_sImageName;
            $this->m_sImageTmpName = $p_sImageTmpName;
            $this->m_bImageError = $p_bImageError;
            $this->m_sLocation = $p_sLocation;
            
        }
        
        public function __set($p_sProperty, $p_vValue)
        {
            switch($p_sProperty)
            {
            
                case 'UserID':    
                    $this->m_iUserID = $p_vValue;
                break;
                case 'PostText':
                    $this->m_sPostText = $p_vValue;
                break;
                case 'ImageType':
                    $this->m_sImageType = $p_vValue;
                break;
                case 'ImageName':
                    $this->m_sImageName = $p_vValue;
                break;
                case 'ImageTmpName':
                    $this->m_sImageTmpName = $p_vValue;
                break;
                case 'ImageError':
                    $this->m_bImageError = $p_vValue;
                break;
                case 'Location':
                    $this->m_sLocation = $p_vValue;
                break;
                    
            }
            
        }
        
        public function __get($p_sProperty)
        {
            
            switch ($p_sProperty)
            {
            
                case 'UserID':    
                    return($this->m_iUserID);
                break;
                case 'PostText':
                    return($this->m_sPostText);
                break;
                case 'ImageType':
                    return($this->m_sImageType);
                break;
                case 'ImageName':
                    return($this->m_sImageName);
                break;
                case 'ImageTmpName':
                    return($this->m_sImageTmpName);
                break;
                case 'ImageError':
                    return($this->m_bImageError);
                break;
                case 'Location':
                    return($this->m_sLocation);
                break;
                    
            }
            
        }
        
        public function post(){
            
            
            //check of er problemen zijn met de upload
            if($this->m_bImageError>0)
            {
                throw new Exception('problem with file upload.');
            }
        
            //check of het een image is
            if($this->m_sImageType!= 'image/jpeg' && $this->m_sImageType!= 'image/png')
            {
                throw new Exception('Not an image type we accept');
            }
        
            // check of de image al bestaat.
            if(file_exists('postImages/' . $this->m_sImageName))
            {
                throw new Exception('file with same name already exists.');
            }
        
            if(!move_uploaded_file($this->m_sImageTmpName, 'postImages/' .    $this->m_sImageName))
            {
                throw new Exception('error uploading file.');
            }
            
            // uploaden naar databank
            $conn = Db::getInstance();
        
            $statement = $conn->prepare("INSERT INTO posts (user_ID, tekst, foto, location) VALUES (:user_ID, :tekst, :foto, :location)");
            $statement->bindvalue(":user_ID", $this->m_iUserID);
            $statement->bindvalue(":tekst", $this->m_sPostText);
            $statement->bindvalue(":foto", $this->m_sImageName);
            $statement->bindvalue(":location", $this->m_sLocation);
            if($statement->execute())
            {
                return($statement);
            }
        }
        
        public function leesUit(){
            
            $cv = "UserID " . $this->m_iUserID . " PostText " . $this->m_sPostText . " ImageType " . $this->m_sImageType . " ImageName ".$this->m_sImageName . " ImageTmpName " . $this->m_sImageTmpName . " ImageError " . $this->m_sImageError;
        
            return($cv);
        }
        
        
    }

?>