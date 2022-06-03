<?php
    session_start();
    include("connect.php");

    $votes = $_POST['gvotes'];
    $total_votes= $votes+1;
    $gid = $_POST['gid'];
    $uid = $_SESSION['userdata']['id'];

    $update_votes = mysqli_query($connect, "UPDATE user SET votes='$total_votes' where id='$gid'");
    $update_user_status = mysqli_query($connect, "UPDATE user SET status=1 where id='$uid'");

    if($update_votes and $update_user_status){
        $groups = mysqli_query($connect, "SELECT * FROM  user where role=2 ");
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
        $_SESSION['userdata']['status']= 1;
        $_SESSION['groupdata'] = $groupsdata;
        echo '<script>
                    alert("Voting successfully!.");
                    window.location = "../routes/dashboard.php";
                </script>
                ';
        
    }
    else{
        echo '<script>
                    alert("Voting failed!.. Try again.");
                    window.location = "../routes/dashboard.php";
                </script>
                ';
    }
    
?>