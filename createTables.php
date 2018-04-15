<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include 'dbConnect.php';
            try
			{
				$query1="create table alumnee (al_fname varchar(50),gender varchar(6),al_email varchar(50),al_uname varchar(20) primary key,al_pass varchar(20),y_o_g int,roll int,course varchar(2),branch varchar(50),address varchar(50),city varchar(30),state varchar(30),nation varchar(30),pincode varchar(10),mob bigint,status varchar(20) not null,y_o_j int,dob date,al_lname varchar(50),guide varchar(3),accept_messages varchar(3))";       
				mysqli_query($conn,$query1)or die('cannot create table1');
				$query2="create table admin (fname varchar(50),desg varchar(20),dept_name varchar(20),email varchar(50),logid varchar(20) primary key,upass varchar(20),status varchar(20),contact bigint, lname varchar(20))";            
				mysqli_query($conn,$query2)or die('cannot create table2');
				$query3="create table event (event_id int primary key AUTO_INCREMENT,event_name varchar(30),edate date,etime varchar(20),venue varchar(30),manager varchar(20))";
				mysqli_query($conn,$query3)or die('cannot create table3');
				$query4="create table invite (al_uname varchar(20) references alumnee(al_uname),event_id  int references event(event_id))";
				mysqli_query($conn,$query4)or die('cannot create table4');
				$query5="create table message (mess_id int primary key AUTO_INCREMENT,content varchar(50), d_n_t timestamp default CURRENT_TIMESTAMP,user_id varchar(20))";
				mysqli_query($conn,$query5)or die('cannot create table5');
				$query6="create table coursemaster (course varchar(10),branch varchar(10))"; 
				mysqli_query($conn,$query6)or die('cannot create table6');
				$query7="create table mid_names (al_uname varchar(20) references alumnee(al_uname), al_mname varchar(20))";
				mysqli_query($conn,$query7)or die('cannot create table7');
				$query8="create table ad_mid_names (logid varchar(20) references admin(logid), mname varchar(20))";
				mysqli_query($conn,$query8)or die('cannot create table8');
				$query9="create table broadcasts (b_id int primary key AUTO_INCREMENT,content varchar(1000),logid varchar(20) references admin(logid), d_n_t timestamp default CURRENT_TIMESTAMP)";
				mysqli_query($conn,$query9)or die('cannot create table9');
				$query10="create table broadmessage (b_id int references broadcasts(b_id),al_uname varchar(20) references alumnee(al_uname))";
				mysqli_query($conn,$query10)or die('cannot create table10');
				$query11="create table superadmin (logid varchar(20), superpass varchar(30))";
				mysqli_query($conn,$query11)or die('cannot create table11');
				$query12="create table dept_master (dept_name varchar(50))";
				mysqli_query($conn,$query12)or die('cannot create table12');
				$query13="create table designations (post_name varchar(50))";
				mysqli_query($conn,$query13)or die('cannot create table13');
				$query14="create table suggestions (suggest_id int primary key AUTO_INCREMENT,message varchar(100))";
				mysqli_query($conn,$query14)or die('cannot create table14');
				$query15="create table works_for (al_uname varchar(20) references alumnee(al_uname), org_name varchar(50), org_desc varchar(100))";
				mysqli_query($conn,$query15)or die('cannot create table15');
				$query16="create table guided (al_uname varchar(20) references alumnee(al_uname), project_name varchar(50), project_area varchar(30))";
				mysqli_query($conn,$query16)or die('cannot create table16');
				$query17="create table fields (al_uname varchar(20) references alumnee(al_uname), field_name varchar(30))";
				mysqli_query($conn,$query17)or die('cannot create table17');
				$query18="create table qualification (al_uname varchar(20) references alumnee(al_uname),qual varchar(20))";
				mysqli_query($conn,$query18)or die('cannot create table18');
				$query19="create view profile_info as select a.al_uname,a.al_fname,m.al_mname,a.al_lname,a.gender,a.y_o_g,a.y_o_j,a.course,a.branch,a.guide,a.accept_messages from alumnee a left outer join mid_names m on a.al_uname=m.al_uname";
				mysqli_query($conn,$query19)or die('cannot create table19');
				$query20="insert into superadmin values('mac','m1234')";
				mysqli_query($conn,$query20)or die('cannot create table20');
				
				/*$query21="create table imgtab (img_id int, img_data blob, al_uname references alumnee(al_uname))";
				mysqli_query($conn,$query21)or die('cannot create table21');*/
				
				$query22="CREATE TABLE imgdb ( al_uname varchar(20) ,path varchar(100) )";
				mysqli_query($conn,$query22)or die('cannot create table22');
				
				echo "Created Tables Successfully...";
			
			}
			catch(Exception $e)
			{
				echo "Message : ".$e->getMessage();
			}
		?>
    </body>
</html>
