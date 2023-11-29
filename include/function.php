<?php
function findval($conn,$columname, $tablename, $wherecolumn, $wherevalue)
{
    $sql = "SELECT $columname FROM $tablename where $wherecolumn='$wherevalue'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if($result){
        return $row['name'];
    }else{
        return 'not found!';
    }
    
}

function prev_post_id($conn,$curr_post_id){
    $sql = "SELECT id FROM tbl_post";
    $result = mysqli_query($conn, $sql);
    $array=array();
    while($row = mysqli_fetch_assoc($result)){
        $array[] = $row['id'];
    }
    $currentIndex = array_search($curr_post_id, $array);
    if($array[0] == $curr_post_id){
        return -1;
    }else{
        $previousId = $array[$currentIndex - 1];
    }
    
    return $previousId;
}


function next_post_id($conn,$curr_post_id){
    $sql = "SELECT id FROM tbl_post";
    $result = mysqli_query($conn, $sql);
    $array=array();
    while($row = mysqli_fetch_assoc($result)){
        $array[] = $row['id'];
    }
    $currentIndex = array_search($curr_post_id, $array);
    if($curr_post_id == $array[count($array) -1]){
        return -1;
    }else{
        $nextId = $array[$currentIndex + 1];
    }
    
    return $nextId;
}


?>