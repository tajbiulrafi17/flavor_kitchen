<?php
    include('config/constants.php');
    
    if(isset($_GET["action"])){
        $action = $_GET["action"];

        switch($action){
            case 'search-result':
                $keyword = $_GET['keyword'];
                liveSearch($keyword);
                break;
        }
    }
    function liveSearch($keyword){

        $conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
        $sql = "SELECT * FROM food WHERE title LIKE '%$keyword%' OR description LIKE '%$keyword%'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);
                //Count Rows
                $count = mysqli_num_rows($res);
                //Check whether food available of not
                if($count>0)
                {
                    $data = [];
                    //Food Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $data[] = $row;
                    }
                    echo json_encode($data);
                }

    }
?>