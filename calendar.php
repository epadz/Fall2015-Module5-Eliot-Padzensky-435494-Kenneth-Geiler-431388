<?php
//login check stuff goes here. Untill then, we will manually create the session data
session_start();
$loggedIn = true;
if(!isset($_SESSION['username'])){
	$loggedIn = false;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Calendar</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="calendar.js"></script>
<script src="script.js" ></script>
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php if($loggedIn){
		echo'<a href="logout.php">logout</a>';
	}else{
		echo'<a href="login.php">log in or register</a>';
	}
	?>
	<div id="wrap">
    	<div id="background"></div>
    	<div id="top">
        	<div class="nav" id="navl">&larr;</div>
            <div id="month">may</div>
            <div class="nav" id="navr">&rarr;</div>
        </div>
        <div id="content">
        	<div id="days">
            	<div class="dayLabel">sunday</div>
            	<div class="dayLabel">monday</div>
                <div class="dayLabel">tuesday</div>
                <div class="dayLabel">wednesday</div>
                <div class="dayLabel">thursday</div>
                <div class="dayLabel">friday</div>
                <div class="dayLabel">saturday</div>
            </div>
            <div id="weeks">
            	<div class="week">
                	<div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                </div>
                <div class="week">
                	<div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                </div>
                <div class="week">
                	<div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                </div>
                <div class="week">
                	<div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                </div>
                <div class="week">
                	<div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    
    <div id="addNew">
    	<table>
        	<tr>
                <td><input type="text" id="neTitle" placeholder="title"></td>
            </tr>
            <tr>
            	<td><textarea id="neNote" placeholder="note"></textarea></td>
            </tr>
            <tr>
            	<td><input type="text" id="neDate" placeholder="date" ></td>
            </tr>
            <tr>
            	<td><input type="number" id="neHour" min="1" max="12"></td>
                <td><input type="number" id="neMin" min="1" max="12"></td>
                <td><input type="number" id="neAMPM" min="1" max="12"></td>
            </tr>
        </table>
    </div>
    <script type="text/javascript">
		$("#navl").click(function(){lastMonth();});
		$("#navr").click(function(){nextMonth();});
    </script>
</body>
</html>
