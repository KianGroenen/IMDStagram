<?php
include_once("classes/Db.class.php");
    class DeletePost {

        private $m_sUserID;
        private $m_sID;


        public function __set($p_sProperty, $p_vValue)
        {
            switch($p_sProperty)
            {
                case "UserID":
                    $this->m_sUserID = $p_vValue;
                    break;
                case "Identiteit":
                    $this->m_sID = $p_vValue;
                    break;
            }
        }

        public function __get($p_sProperty)
        {
            switch($p_sProperty)
            {
                case "UserID":
                    return $this->m_sUserID;
                    break;
                case "Identiteit":
                    return $this->m_sID;
                    break;
            }

        }

        public function Delete() {
            $PDO = Db::getInstance();
            $sql = "DELETE FROM posts WHERE user_ID = :userID AND ID = :ID";
            $stmt = $PDO->prepare($sql);
            $stmt->bindValue(':userID', $this->m_sUserID);
            $stmt->bindValue(':ID', $this->m_sID);
            
            if ($stmt->execute()) {
                //query went OK!
                header("location: detailPagina.php?id=".$this->m_sUserID);
            }
            else
            {
                // er zijn geen query resultaten, dus query is gefaald
                throw new Exception('Could not delete POST!');
            }
        }
    }
?>