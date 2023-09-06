<?php
include('conn.php');
session_start();

if(!isset($_SESSION['user_id'])){
	header("location: login.php");
}

$username = $_SESSION['user_id'];
//$id = $_GET['rowid'];

$usersendmessage = "SELECT * FROM userdetails WHERE id = '$username'";

$result = $conn->query($usersendmessage);

if(!$result){
    echo $conn->error;
    }

    $umsg_id = NULL;
    while($row=$result->fetch_assoc()){
        //$mesg_id = $row2['id'];
        //$umsg = $row2['adminmessage'];
        $umsg_id = $row['id'];
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GET FIT NOW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
    <link rel="stylesheet" href="gui.css">

    <style>

        form {
            background: none;
            border: none;
        }

        .card{
            display: inline-block;
        }
    </style>

</head>

<body class="altwallpaper">

    <div id="container">
        <!--Start of Hamburger Menu-->
        <div class="hamburgermenu">
        <label for="demo-toggle" class="button drawer-toggle persistent doc"></label>
            <input type="checkbox" id="demo-toggle" class="drawer persistent">
            <div class="demo doc">
            <h3>Menu</h3>
            <label for="doc-drawer-checkbox" class="button drawer-close"></label>
            <label for="demo-toggle" class="button drawer-close"></label>
                <a id="present" href="index.php" class="myNavSideButton">Home</a>
                <a href="login.php" class="myNavSideButton">Login</a>
                <a href="useraccount.php" class="myNavSideButton">My Account</a>
                <a href="edituseraccount.php" class="myNavSideButton">Edit My Account</a>
                <a href="logout.php" class="myNavSideButton">Logout</a>
                <a href="whatwedo.php" class="myNavSideButton">What We Do</a>
                <a href="trainer.php" class="myNavSideButton">Your Trainer</a>
                <a href="contactus.php" class="myNavSideButton">Contact Us</a>
                <a href="signup.php" class="myNavSideButton">Sign Up Now!</a>
            </div>
        </div>
        <!--End of Hamburger Menu-->

        <!--start of maincontent-->
        <div id="maincontent">
            <div id="blogtext">

            <h1><b> Contact Trainer </b></h1>
            <div class='column accountmenu'>
            <a href='userinbox.php' class='myButton'>Return to Inbox</a>
            <a href='useraccount.php' class='myButton'>Return to Account</a>
            </div>

        <form action='sendmessagetoadmin.php?rowid=$umsg_id' method='POST' enctype='multipart/form-data'>

                        <div class='col-sm-4 card'>
                            <div class='section'>
                                <h3 class='doc'>Send Message to Trainer</h3>
                                <input value='<?php echo $umsg_id ?>' type='hidden' name='umessid'>
                                <textarea id=' msg' name='usermessa' placeholder='Enter Message' style='width:85%;' class='doc' type='text'></textarea>
                            </div>
                        </div>

                    <input type='submit' value='Submit' name = 'usersubmitmessage'>
        </form>

    </div>
                                    <?php
                                            if(isset($_POST['usersubmitmessage'])){

                                                $messagedata = $conn -> real_escape_string($_POST['usermessa']);
                                                $userm_id = $conn -> real_escape_string($_POST['umessid']);
                                                
                                                //$insertadminmsg = "INSERT INTO `useradminmessage` (id, adminmessage_id, adminmessage, datesent) VALUES (NULL, '2', '$messagedata', NOW())";
                                                $adminmsg = "INSERT INTO `admin_inbox` (`id`, `usermessage_id`, `usermessage`, `messagesent`) VALUES (NULL, '$userm_id', '$messagedata', NOW())";  

                                                $result = $conn -> query($adminmsg);

                                                if(!$result){
                                                    echo $conn -> error;
                                                    echo $adminmsg;
                                                } else {
                                                echo "<h1><b> Message sent!</b></h1>";
                                                }

                                            
                                            } 

                                    ?>          
        </div>

    </div>

    
</body>

            

</html>