<?php
  session_start();

  if(!isset($_SESSION['userdata'])){
     header("location:../");
  }
  $userdata=$_SESSION['userdata'];
  $groupsdata=$_SESSION['groupsdata'];

  if($_SESSION['userdata']['status']==0){
    $status='<b style="color:red"> Not Voted</b>';
  }
  else{
    $status='<b style="color:green">Voted</b>';
  }
?>


<!DOCTYPE HTML>

<html>
<head>
<title>dash board for online voting</title>
<style>
  body {
  background-color: lightblue;
  
}
#back-button {
  float: left;
  margin-left: 20px;
  margin-top: 20px;
  padding: 5px;
  font-size: 15px;
  background-color: #3498db;
  color: white;
  border-radius: 5px;
  margin:10px;
}

#logout-button {
  float: right;
  margin-right: 20px;
  margin-top: 20px;
  padding: 5px;
  font-size: 15px;
  background-color: #3498db;
  color: white;
  border-radius: 5px;
  margin:10px;
}
#profile{
  background-color:white;
  width:30%;
  padding:20px;
  float:left;
}
#group{
  background-color:white;
  width:60%;
  padding:20px;
  float:right;
}
#mainpanel{
  padding:10px;
}
#votebtn{
  padding: 5px;
  font-size: 15px;
  background-color: #3498db;
  color: white;
  border-radius: 5px;
}
#mainpanel{
  padding: 10px;

}
#voted{
  padding: 15px;
  font-size: 15px;
  background-color: green;
  color: white;
  border-radius: 5px;
}
</style>
</head>
<body>
  <div id=mainsection>
      <a href="../"><button id="back-button"></a>Back</button></a>
      <a href="logout.php"><button  id="logout-button">Log out</button></a>
      <h1 style="text-align: center; color:black;margin-top:20px;">Online Voting System</h1>
      <br>  <hr>
   <div id="mainpanel">
     <div id="profile">
       <center> <img src="../uploads/<?php echo $userdata['photo']?>" height="100" width="100"></center>
       <br><br><b>Name: </b><?php echo $userdata['name']?><br><br>
       <b>Mobile: </b><?php echo $userdata['mobile']?><br><br>
       <b>Address: </b><?php echo $userdata['address']?><br><br> 
       <b>Status: </b><?php echo  $status?><br><br> 
  
     </div>
     <div id="group">
       <?php

          if(($_SESSION['groupsdata'])){
   
            for($i=0; $i<count($groupsdata); $i++){
             ?>
            <div>
            <img style="float: right" src="../uploads/<?php echo $groupsdata[$i]['photo']?>" height="80" width="80">
            <b>Group Name : </b><?php echo $groupsdata[$i]['name']?><br><br>
            <b>Votes :</b> <?php echo $groupsdata[$i]['votes']?><br><br>
            <form action="../api/vote.php" method="POST">
            <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
            <input type="hidden" name = "gid" value="<?php echo $groupsdata[$i]['id'] ?>">
            <?php
              if($_SESSION['userdata']['status']==0)
              {
                ?>
                 <input type="submit" name = "votebtn" value="Vote" id="votebtn">
                 <?php
              }
              else{
                ?>
                 <button Disabled type="submit" name = "votebtn" value="Vote" id="voted">Voted</button>
                 <?php
              }
            ?>
            </form>
            </div> 
            <hr>
            <?php
            }
          }
       
         else{
    
            }  
          ?>


     </div>
  </div>
  </div>
</body>
</html>

