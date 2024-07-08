<?php
    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location: ../");

    }

    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];

    if($userdata['status'] == 0){
        $status = '<b style = "color: red"> Not Voted </b>';
    }
    else{
        $status = '<b style = "color: green"> Voted </b>';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Dashboard</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        #backbtn{
            padding: 10px;
            border-radius: 5px;
            font-size: 15px;
            background-color: rgb(8, 69, 148);
            color: white;
            float: left;
            margin:15px;
        }

        #logoutbtn{
            padding: 10px;
            border-radius: 5px;
            font-size: 15px;
            background-color: rgb(8, 69, 148);
            color: white;
            float: right;
            margin: 15px;
        }
        #profile{
            background-color: white;
            width: 30%;
            padding: 20px;
            float: left;
        }
        #group{
            background-color: white;
            width: 60%;
            padding: 20px;
            float: right;
            margin : 0px 20px 20px 20px;
        }
        #votebtn{
            padding: 10px;
            border-radius: 5px;
            font-size: 15px;
            background-color: rgb(8, 69, 148);
            color: white;
            float: left;
        }
        #mainpanel{
            padding: 10px;
        }
        #voted{
            padding: 10px;
            border-radius: 5px;
            font-size: 15px;
            background-color: green;
            color: white;
            
        }

    </style>
</head>
<body>

    <div id="mainsection">
        <center>
        <div id="headersection">
                <a href="../"><button id="backbtn"> Back</button></a>
                <a href="../API/login.php"><button id="logoutbtn"> Logout</button></a>
                <h1>Online Voting System</h1>
        </div>
        </center>
        <hr>
        <div id="mainpanel">
            <div id="profile">
                <center><img src="../uploads/<?php echo $userdata['photo']?>" width="100" height="100" ></center><br><br>
                <b>Name: </b><?php echo $userdata['name']?> <br><br>
                <b>Mobile: </b><?php echo $userdata['mobile']?><br><br>
                <b>Address: </b><?php echo $userdata['address']?><br><br>
                <b>Status: </b><?php echo $userdata['status']?><br><br>
            </div>

            <div >
                    <?php
                        if($_SESSION['groupsdata']){
                            for($i=0; $i<count($groupsdata); $i++){
                                ?>
                                <div id="group">
                                    <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo']; ?>" height="100" width="100">
                                    <b>Group Name: </b><?php echo $groupsdata[$i]['name']?><br><br>
                                    <b>Votes: </b><?php echo $groupsdata[$i]['votes']?><br><br>
                                    <form action="../API/vote.php" method = "POST">
                                        <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
                                        <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                                        <?php
                                        
                                            if($_SESSION['userdata']['status']==0){
                                                ?>
                                                    <input type="submit" name = "votebtn" value="Vote" id="votebtn">
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <button disabled type="button" name = "votebtn" value="Vote" id="voted" >Voted</button>
                                                <?php
                                            }                                
                                        ?>
                                        
                                    </form>
                                </div>
                                <br>
                                <br>
                                <?php
                            }
                        }
                        else{
                            echo "error";
                        }
                    
                    ?>
            </div>
        </div>
    </div>

</body>
</html>
