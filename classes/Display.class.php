<?php
include_once("Db.class.php");
    class Display {
        private $m_sUserID;
        

        public function __set($p_sProperty, $p_vValue) {
            switch($p_sProperty) {
                case "UserID":
                    $this->m_sUserID = $p_vValue;
                    break;
            }
        }

        public function __get($p_sProperty) {
            switch($p_sProperty) {
                case "UserID":
                    return $this->m_sUserID;
                    break;
            }

        }
        
        public function Show() {
            $PDO = Db::getInstance();
            $sql = "SELECT DISTINCT posts.ID, users.username, posts.foto, posts.tekst, posts.dateCreated FROM posts LEFT JOIN users ON users.ID = posts.user_ID LEFT JOIN follows ON follows.followed_user_ID = posts.user_ID WHERE follows.follower_ID = :var OR posts.user_ID = :var ORDER BY posts.dateCreated DESC";
            $stmt = $PDO->prepare($sql);
            
            $stmt->bindValue(':var', $this->m_sUserID, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>