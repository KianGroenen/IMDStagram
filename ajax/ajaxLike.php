<?php

include_once ("LikePost.class.php");
$like = new LikePost();

// post id moet uniek per post zijn om enkel 1 foto te liken uit de lijst (lijst is er nog niet)
if(!empty($_POST['post_id']))
{
    $like->Post_ID = $_POST['post_id'];
    $like->liker_ID = $_SESSION["ID"];

    try
    {
        if($like->saveLike()){
            $response['status'] = 'like';
            $response['message'] = 'liked';
        }

    }
    catch (Exception $e)
    {
        $feedback = $e->getMessage();
        $response['status'] = "error";
        $response['message'] = $feedback;
    }
    //json maakt dit leesbaar voor php en javascript
    header('Content-type: application/json');
    echo json_encode($response);
}


?>