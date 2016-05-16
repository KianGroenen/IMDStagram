<?php
include_once("classes/Db.class.php");
class GetDetailPosts
{
    private $m_iUserID;

    public function __set($p_sProperty, $p_vValue)
    {

        switch ($p_sProperty)
        {

            case 'UserID':
                $this->m_iUserID = $p_vValue;
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
        }

    }


    public function getPosts()
    {

        $conn = Db::getInstance();

        $stmt = $conn->prepare("SELECT * FROM posts WHERE user_ID = :user_ID");
        $stmt->bindValue(":user_ID", $this->m_iUserID);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

}

?>