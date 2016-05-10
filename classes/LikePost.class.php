<?php

include_once("Db.class.php");
class LikePost{

    private $m_iliker_ID;
    private $m_ipost_ID;

    //setter en getters
    public function __set($p_sProperty, $p_vValue)
    {
        switch($p_sProperty)
        {
            case "liker_ID":
                $this->m_iliker_ID = $p_vValue;
                break;
            case "Post_ID":
                $this->m_ipost_ID = $p_vValue;
                break;
        }
    }

    public function __get($p_sProperty)
    {
        switch($p_sProperty)
        {
            case "liker_ID":
                return $this->m_iliker_ID;
                break;
            case "post_ID":
                return $this->m_ipost_ID;
                break;
        }

    }

    public function saveLike() {

        $PDO = Db::getInstance();

        $stmt = $PDO->prepare("SELECT * FROM likes WHERE post_ID = :post_ID AND liker_ID = :liker_ID");
        $stmt->bindValue(':post_ID', $this->m_Post_ID, PDO::PARAM_INT);
        $stmt->bindValue(':liker_ID', $this->m_liker_ID, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() === 0){
            //zelfde maar met insert

            $PDO = Db::getInstance();

            $stmt = $PDO->prepare("INSERT INTO likes (post_ID, liker_ID) VALUES (:post_ID, :liker_ID)");
            $stmt->bindValue(':post_ID', $this->m_Post_ID, PDO::PARAM_INT);
            $stmt->bindValue(':liker_ID', $this->m_liker_ID, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function deleteLike() {

        $PDO = Db::getInstance();

        $stmt = $PDO->prepare("DELETE FROM likes WHERE post_ID = :post_ID AND liker_ID = :liker_ID");
        $stmt->bindValue(':post_ID', $this->m_Post_ID, PDO::PARAM_INT);
        $stmt->bindValue(':liker_ID', $this->m_liker_ID, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getUserLikes(){
        $PDO = Db::getInstance();

        $stmt = $PDO->prepare("SELECT post_ID FROM likes WHERE liker_ID = :liker_ID");
        $stmt->bindValue(":liker_id", $this->m_iliker_ID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPhotoLikes($post_id){
        //liked door de huidige gebruiker
        $PDO = Db::getInstance();

        $stmt = $PDO->prepare("SELECT liker_id, post_id FROM likes WHERE post_id = :post_id");
        $stmt->bindValue(":post_id", $post_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

    function isLiked($array, $key, $val){
        foreach ($array as $item)
            if (isset($item[$key]) && $item[$key] == $val)
                return true;
            return false;
    }


}

?>