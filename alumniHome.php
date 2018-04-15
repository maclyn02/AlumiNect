<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<title>Alumni Home Page</title>
</head>
<body>
    <?php
        
        if(!empty($_SESSION['uID']))
        {  
            $uid=$_SESSION['uID'];
        ?>  
        <table width="100%" height="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="2" bgcolor="tan" align="center">
                    <label style="color:white;font-size:50px;font-style:italic">Welcome</label>
                </td>
            </tr>
            <tr>
                <td width="80%" height="540">
                    <iframe src="search.php" name="work" width="100%" height="100%" scrolling="yes" style="border-width:0px">
                    </iframe>
                </td>
                <td width="20%" height="540">
                    <table bgcolor="wheat" height="100%" width="100%">
                    <tr>
                        <td align="center">
                            <a href="profile.php?uid=<?php echo $uid;?>" target="work"><h2>Profile<h2></a>
                        </td>
                    </tr>
                    <tr>                         
                        <td align="center">
                            <a href="discussions.php" target="work"><h2>Discussions</h2></a>
                        </td> 
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="messages.php" target="work"><h2>Messages</h2></a>
                        </td>
                    </tr>
                </table>
                </td>  
            </tr>
            <tr>
                <td colspan="2" bgcolor="tan" height="20%"><center><label style="font-size:20px">Logged in as <?php echo $_SESSION['username'];?><br><a href="mainScreen.php" target="_top">Logout?</a></label></center>
                </td>
            </tr>
        </table>
        <?php        
        }
        else
        {
            header("location:mainScreen.php");
        }
        ?>
</body>
</html>
