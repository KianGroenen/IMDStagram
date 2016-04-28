<?php
include_once("Db.class.php");
class Search {
    private $m_sSearch;
    
    public function __set($p_sProperty, $p_vValue) {
        switch ($p_sProperty) {
            case "Search":
                $this->m_sSearch = $p_vValue;
                break;
        }
    }

    public function __get($p_sProperty) {
        switch ($p_sProperty) {
            case "Search":
                return $this->m_sSearch;
                break;
        }

    }
    
    public function Searching() {
        $m_sDetectHashT = substr($this->m_sSearch, 0, 1);
        $PDO = Db::getInstance();
        if ($m_sDetectHashT == "#") {
            //-----SEARCH TAGS-----
            //query the database table
            $stm = $PDO->prepare('SELECT * FROM posts WHERE tekst LIKE :tekst');
            $stm->bindValue(':tekst', '%' . $this->m_sSearch . '%', $PDO::PARAM_STR);
            //run the query against the mysql query function
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
            
        } else {
            //-----SEARCH USERNAMES-----
            //query the database table
            $stm = $PDO->prepare('SELECT * FROM users WHERE username LIKE :name');
            $stm->bindValue(':name', '%' . $this->m_sSearch . '%', $PDO::PARAM_STR);
            //run the query against the mysql query function
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
    }
}
?>