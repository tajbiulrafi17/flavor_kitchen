<?php
    
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

        $paramSearch = "%" . $keyword . "%";
        $sqlSearch = "SELECT * FROM food WHERE title LIKE ? OR description LIKE ?";

        include 'config/constants.php'; 

        $stmt = $db->prepare($sqlSearch);
        $stmt->bind_param("ss", ...[$paramSearch], ...[$paramSearch]);
        $stmt->execute(); 
        $result = $stmt->get_result();

        $data = [];

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        $stmt->close();
        $db->close();
        echo json_encode($data);

    }

?>