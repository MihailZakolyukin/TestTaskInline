<?php

function search ($query) 
{ 
    $connect = mysqli_connect("localhost", "root", "root", "testing");
    if (!empty($query)) 
    { 
        if (strlen($query) < 3) {
            $result = 'Слишком короткий поисковый запрос.';
        } else if (strlen($query) > 128) {
            $result = 'Слишком длинный поисковый запрос.';
        } else{ 
            $q = "SELECT tbl_posts.title, tbl_comments.body FROM tbl_comments, tbl_posts WHERE tbl_comments.body LIKE '%$query%'";

            $result = mysqli_query($connect, $q);}

        }
    return $result;
} 

$result = search($_POST['query']);

if (mysqli_num_rows($result) > 0){
	while($rowData = mysqli_fetch_array($result)){
		echo "<b>Название записи: </b>".$rowData[0].'<br>';
        echo "<b>Комментарий: </b>".$rowData[1].'<br><br>';
	}
}

// echo search($_POST['query']);