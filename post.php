<?php
session_start();
//print_r($_SESSION);

include_once("classes/Post.class.php");
include_once("classes/User.class.php");

if(!empty($_POST))
{
    
    print_r($_POST);
    echo "<br>".$_POST["postText"]."<br>";
    
    if(!empty($_FILES))
    {
        $imageError = $_FILES["postFoto"]["error"];
        $imageType = $_FILES["postFoto"]["type"];
        $imageName = $_FILES["postFoto"]["name"];
        $imageTmpName = $_FILES["postFoto"]["tmp_name"];
        $user = $_SESSION["ID"];
        $text = $_POST["postText"];
        $location = $_POST["postLocation"];
        
       /* echo  $uploadName . "<br>"
            . $uploadType . "<br>"
            . $uploadTmpName . "<br>"
            . $uploadError . "<br>";
        
        print_r($_FILES);*/
        try
        {
        $upload = new Post($user, $_POST["postText"], $imageType, $imageName, $imageTmpName, $imageError, $location);
        
            // werkt niet, kweet niet waarom.
            /*$upload = new Post();
        
            $upload->UserID = $user;
            $upload->PostText = $text;
            $upload->ImageType = $imageType;
            $upload->ImageName = $imageName;
            $upload->ImageTmpName = $imageTmpName;
            $upload->ImageError = $imageError;
            
            $cv = $upload->leesUit();
            echo($cv);*/
            
            //$upload->post();
        }
        catch(exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>upload foto</title>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script type="text/javascript">
    
window.onload = initialize;    
    
    
    
var geocoder;

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
} 
//Get the latitude and the longitude;
function successFunction(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    codeLatLng(lat, lng)
}

function errorFunction(){
    alert("Geocoder failed");
}

  function initialize() {
    geocoder = new google.maps.Geocoder();
  }

  function codeLatLng(lat, lng) {

    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      console.log(results)
        if (results[1]) {
         //formatted address
         //alert(results[1].formatted_address);
         document.getElementById("postLocation").value = results[1].formatted_address;

        } else {
          alert("No results found");
        }
      } else {
        alert("Geocoder failed due to: " + status);
      }
    });
  }
</script> 
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
       <label for="postFoto"> upload picture</label>
        <input type="file" name="postFoto" id="postFoto">
        <label for="potsText"> input tekst</label>
        <input type="text" name="postText" id="postText">
        <input type="text" name="postLocation" id="postLocation">
        <input type="submit" value="upload post" name="submit">
    </form>
</body>
</html>