<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Calendar</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="calendar.js"></script>
<script type="text/javascript">
	
var month = new Month(2015, 9);	
months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
function nextMonth(){
	month = month.nextMonth();
	updateCalendar();
}
function lastMonth(){
	month = month.prevMonth();
	updateCalendar();
}

function updateCalendar(){
	$("#month").html(months[month.month] + "");
	var weeks = month.getWeeks();
 	i = 0;
	for(var w in weeks){
		var days = weeks[w].getDates();
		// days contains normal JavaScript Date objects. 
		//alert("Week starting on " + days[0].getDay());
 		j = 0;
		for(var d in days){
			$(".week").eq(i).children(".day").eq(j).children(".date").eq(0).html(days[d].getDate() + "");
		j++;
		}
		i++;
	}
}
$(function(){
	updateCalendar();
});
</script>
<style>
@import url(http://fonts.googleapis.com/css?family=Roboto:400,100,700);
body{
	background-image:url(background.png);
	font-family:"Roboto", sans-serif;
}
#wrap{
	width:910px;
	height:600px;
	position:absolute;
	left:50%;
	top:100px;
	margin:0 0 0 -450px;
	border-radius:10px;
	overflow:hidden;
	border:2px solid #FFF;
}
#background{
	position:absolute;
	width:910px;
	height:600px;
	background-color:#D0E2F2;
	opacity:.4;
	filter:blur(40); 
	-webkit-filter:blur(40); 
}
#top{
	height:68px;
	width:910px;
	position:relative;
	float:left;
	margin:0px;
	padding:0px;
	border-bottom:solid 2px #FFFFFF;
}
.nav{
	width:40px;
	height:40px;
	border:solid #FFF 5px;
	border-radius:40px;
	margin:9px;
	float:left;
	position:relative;
	color:#FFFFFF;
	line-height:35px;
	text-align:center;
	font-size:30px;
	cursor:pointer;
	font-weight:700;
}
#month{
	width:774px;
	height:68px;
	text-align:center;
	line-height:68px;
	font-size:50px;
	color:#FFFFFF;
	text-transform:lowercase;
	float:left;
	position:relative;
}
#content{
	height:530px;
	width:910px;
	padding:0;
	margin:0;
	position:relative;
	float:left;
}
#days{
	width:910px;
	height:30px;
	position:relative;
	float:left;
}
.dayLabel{
	width:130px;
	height:30px;
	line-height:30px;
	padding:0;
	margin:0;
	color:#fff;
	text-align:center;
	font-size:20px;
	position:relative;
	float:left;
}
#weeks{
	width:910px;
	height:500px;
	position:relative;
	float:left;
}
.week{
	width:910px;
	height:100px;
	float:left;
	position:relative;
}
.week .day{
	width:112px;
	height:82px;
	margin:5px;
	border-radius:10px;
	border:solid 4px #FFFFFF;
	position:relative;
	float:left;
}
.date{
	width:112px;
	height:18px;
	padding:0;
	margin:0;
	background-color:#D0E2F2;
	text-align:center;
	font-size:16px;
	line-height:18px;
	color:#FFFFFF;
	border-top-left-radius:5px;
	border-top-right-radius:5px;
}
</style>
</head>

<body>
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
    
    <script type="text/javascript">
		$("#navl").click(function(){lastMonth();});
		$("#navr").click(function(){nextMonth();});
    </script>
</body>
</html>