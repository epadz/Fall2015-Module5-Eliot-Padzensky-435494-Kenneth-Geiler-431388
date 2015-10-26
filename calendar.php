<?php
//login check stuff goes here. Untill then, we will manually create the session data
session_start();
$loggedIn = true;
if(!isset($_SESSION['username'])){
	$loggedIn = false;
}

if (!isset($_SESSION['username'])) {
    ?>
    <script type="text/javascript">
    	var myClasses = $(".addEv");
   	 i = 0;
   	 l = myClasses.length;

	for (i; i < l; i++) {
    	myClasses[i].style.display = 'none';
	};
    </script>
    <?php

}


?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Calendar</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/flick/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="calendar.js"></script>
<script src="script.js" ></script>
<link href="style.css" rel="stylesheet" type="text/css">
<script>
var uid = <?php echo (isset($_SESSION['uid']) ? $_SESSION['uid'] : 'null'); ?>;
</script>
</head>

<body>
    <?php if($loggedIn){
		echo'<a href="./logout.php">logout</a>';
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
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                </div>
                <div class="week">
                	<div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                </div>
                <div class="week">
                	<div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                </div>
                <div class="week">
                	<div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                </div>
                <div class="week">
                	<div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                    <div class="day">
                    	<div class="date"></div>
                        <div class="addEv"></div>
                    </div>
                </div>                
            </div>
        </div>
        <div id="addNew">
            <table>
            	<tr>
                	<td><div id="epaneTitle">new item</div></td>
                </tr>
                <tr>
                    <td><input type="text" id="neTitle" placeholder="title" maxlength="149"></td>
                </tr>
                <tr>
                    <td><textarea id="neNote" placeholder="note"></textarea></td>
                </tr>
                <tr>
                    <td><input type="text" id="neDate" placeholder="date" ></td>
                </tr>
                <tr>
                    <td><input type="number" id="neHour" min="1" max="12" value="4">:<input type="number" id="neMin" min="0" max="59" value="30" step="10"><select id="neAMPM"><option value="am">am</option><option value="pm" selected>pm</option></select></td>
                </tr>
                <tr>
                	<td>
                    	<select id="neTag">
                        	<option>no tag</option>
                    		<option value="meeting">meeting</option>
                            <option value="other">other</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td><div class="button" id="addButton">add</div></td>
                </tr>
                <tr>
                	<td><div class="button" id="deleteButton">discard</div></td>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript">
		$("#navl").click(function(){lastMonth();});
		$("#navr").click(function(){nextMonth();});
    </script>
</body>
</html>
