// JavaScript Document
var state = 0; //0 = calendar, 1 = event add/edit
var month = new Month(2015, 9);	
months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
var monthEvents;
var tagCols = {none: '#9FF', meeting: '#6F6', birthday: '#F60', important: '#F00', reminder: '#ccc'};
function nextMonth(){
	month = month.nextMonth();
	refreshCalendar();
}
function lastMonth(){
	month = month.prevMonth();
	refreshCalendar();
}
function updateCalendar(){
	$("#month").html(months[month.month] + "");
	var weeks = month.getWeeks();
 	i = 0;
	$(".evMark").remove();
	for(var w in weeks){
		var days = weeks[w].getDates();
		// days contains normal JavaScript Date objects. 
		//alert("Week starting on " + days[0].getDay());
 		j = 0;
		for(var d in days){
			$(".week").eq(i).children(".day").eq(j).children(".date").eq(0).html(days[d].getDate() + "");
			$(".week").eq(i).children(".day").eq(j).attr("data-year",days[d].getFullYear() + "");
			$(".week").eq(i).children(".day").eq(j).attr("data-month",days[d].getMonth() + "");
			$(".week").eq(i).children(".day").eq(j).attr("data-day",days[d].getDate() + "");
		j++;
		}
		i++;
	}
	getEvents(month.month);
	$(".day").attr("title","click to add an event");
	$(".addEv").click(function(e){
		if( e.target != this ){
			return;
		}
		var td = e.target.parentNode.dataset.day;
		var tm = e.target.parentNode.dataset.month;
		flip();
		prepareNew(e.target.parentNode.dataset.year, e.target.parentNode.dataset.month, e.target.parentNode.dataset.day);
	});
}
$(function(){
	updateCalendar();
});
//just refreshes events without creating click events
function refreshCalendar(){
	$("#month").html(months[month.month] + "");
	var weeks = month.getWeeks();
 	i = 0;
	$(".evMark").remove();
	for(var w in weeks){
		var days = weeks[w].getDates();
		// days contains normal JavaScript Date objects. 
		//alert("Week starting on " + days[0].getDay());
 		j = 0;
		for(var d in days){
			$(".week").eq(i).children(".day").eq(j).children(".date").eq(0).html(days[d].getDate() + "");
			$(".week").eq(i).children(".day").eq(j).attr("data-year",days[d].getFullYear() + "");
			$(".week").eq(i).children(".day").eq(j).attr("data-month",days[d].getMonth() + "");
			$(".week").eq(i).children(".day").eq(j).attr("data-day",days[d].getDate() + "");
		j++;
		}
		i++;
	}
	getEvents(month.month);
}

//makes an event
//ev data = json with data of event
//returns an html element
function makeEvent(evData){
	ev = document.createElement("div");//event
	ev.className = "event";
	
	et = document.createElement("div");//time
	et.className = "evTime";
	
	eh = document.createElement("div");//hour
	eh.className = "evTimes";
	eh.innerHTML = evData.hour;
	
	em = document.createElement("div");//minute
	em.className = "evTimes";
	em.innerHTML = evData.minute;
	
	ea = document.createElement("div");//second
	ea.className = "evTimes";
	ea.innerHTML = evData.ampm;
	
	ed = document.createElement("div");//details
	ed.className = "evDetails";
	
	en = document.createElement("div");//title
	en.className = "evTitle";
	en.innerHTML = evData.title;
	
	ep = document.createElement("div");//description
	ep.className = "evDesc";
	ep.innerHTML = evData.note;
	
	ee = document.createElement("div");//editing tools
	ee.className = "evTools";
	
	eeE = document.createElement("div");//editing tools
	eeE.className = "evTool";
	eeE.innerHTML = "e";
	eeE.setAttribute("title", 'Edit This Event');
	$(eeE).click(function(){prepEditEvent(evData.eventID);flip();});
	
	eeD = document.createElement("div");//editing tools
	eeD.className = "evTool";
	eeD.innerHTML = "x";
	eeD.setAttribute("title", 'Delete This Event');
	$(eeD).click(function(){deleteEvent(evData.eventID);});
	
	eeS = document.createElement("div");//editing tools
	eeS.className = "evTool";
	eeS.innerHTML = "s";
	eeS.setAttribute("title", 'Email This Event');
	
	var eET = username + " scheduled an event titled '" + evData.title + "' on " + evData.month + "/" + evData.day + "/"+ evData.year + " at " + evData.hour + ":" + evData.minute + " " + evData.ampm + "\nNOTE: " + evData.note;
	if(eET.length > 150){
		eET = eET.substring(0,150) + '...';
	}
	eET = encodeURIComponent(eET);
	
	$(eeS).click(function(){window.location = ("mailto:?subject=event%20from%20my%20calendar&body=" + eET)});
	
	et.appendChild(eh);
	et.appendChild(em);
	et.appendChild(ea);
	
	ed.appendChild(en);
	ed.appendChild(ep);
	
	ee.appendChild(eeE);
	ee.appendChild(eeD);
	ee.appendChild(eeS);
	
	ev.appendChild(et);
	ev.appendChild(ed);
	ev.appendChild(ee);
	
	ev.setAttribute("data-eid", evData.eventID);
	ev.setAttribute("title", evData.tag + '');
	$(ev).css("background-color", tagCols[evData.tag + '']);
	return ev;
}
//gets events for a month [0,11]
function getEvents(month){
	$.ajax({
		url: "getData.php?month=" + month,
		type: "GET",
		cache: false,
		dataType: "json",
		success: function(d, s){
			if(s == "success"){
				monthEvents = d;
				for(i = 0; i < monthEvents.length; i++){
					evd = monthEvents[i].day;
					evm = monthEvents[i].month;
					evDay = $('div[data-day="' + evd + '"][data-month="' + evm + '"').eq(0);
					if(evDay.children(".evMark").length == 0){
						evDay.append('<div class="evMark"><div class="evNum">1</div><div class="events"></div></div>');
					}else{
						evDay.children(".evMark").eq(0).children(".evNum").eq(0).html(parseInt(evDay.children(".evMark").eq(0).children(".evNum").eq(0).html()) + 1);
					}
					evDay.children(".evMark").eq(0).children(".events").eq(0).append(makeEvent(monthEvents[i]));
				}
			}
		}
	});
}

//switches to event add/edit pane or calendar
function flip(){
	if(state == 0){
		state = 1;
		$("#wrap").children().not("#background, #addNew").css("display","none");
		$("#wrap").css({
			"transition": "0.6s",
			"transform": 'rotateY(180deg)',
			"width":'300px',
			"margin":'0 0 0 -150px'
		});
		setTimeout(function(){
			$("#wrap").css({
				"transition": "0s",
				"transform": 'rotateY(0deg)'
			});
			$("#wrap").children("#addNew").css("display","block");
		},600);
	}else if(state == 1){
		state = 0;
		$("#wrap").children("#addNew").css("display","none");
		$("#wrap").css({
			"transition": "0.6s",
			"transform": 'rotateY(-180deg)',
			"width":'910px',
			"margin":'0 0 0 -450px'
		});
		setTimeout(function(){
			$("#wrap").css({
				"transition": "0s",
				"transform": 'rotateY(0deg)'
			});
			$("#wrap").children().not("#addNew").css("display","block");
			refreshCalendar();
		},600);
	}
	
}
//makes pane ready for new event
function prepareNew(ny, nm, nd){
	$("#neTitle").val('');
	$("#neNote").val('');
	defDat = new Date(ny, (parseInt(nm)+1), nd);
	$("#neDate").val((parseInt(nm)+1) + "/" + nd + "/" + ny);
	$("#neDate").datepicker({
		defaultDate:defDat
	});
	$("#neTag option[value='none']").attr("selected",true);
	$("#deleteButton, #addButton").off("click");
	$("#deleteButton").click(flip);
	$("#addButton").click(addEvent);
	$("#addButton").html("add");
	$("#deleteButton").html("discard");
}

//saves a new event to the server
function addEvent(){
	if(uid && uid!=null && uid != 'null' && state ==1){
		var neDtPts = document.getElementById('neDate').value.split('/');
		var neData = {};
		neData["uid"] = uid;
		neData["a"] = 0;//0 - add new 1-edit 2-delete
		neData["neT"] = document.getElementById('neTitle').value + '';
		neData["neN"] = document.getElementById('neNote').value + '';
		neData["neDM"] = parseInt(neDtPts[0])-1;
		neData["neDD"] = parseInt(neDtPts[1]);
		neData["neDY"] = parseInt(neDtPts[2]);
		neData["neH"] = parseInt(document.getElementById('neHour').value);
		neData["neM"] = parseInt(document.getElementById('neMin').value);
		neData["neA"] = document.getElementById('neAMPM').value + '';
		neData["neC"] = document.getElementById('neTag').value + '';
		$.post("eventActions.php", neData, function(r){
			if(parseInt(r) == 0){
				alert("there was an error saving your event");
			}else if(parseInt(r) == 1){
				
			}
		});
	}else{
		alert("you must be logged in to post an event");
	}
	flip();
}
function prepEditEvent(eid){
	var ce = monthEvents.filter(function(d){return d.eventID == eid;});
	$("#neTitle").val(ce[0].title + "");
	$("#neNote").val(ce[0].note + "");
	defDat = new Date(ce[0].year, (parseInt(ce[0].month)+1), ce[0].day);
	$("#neDate").val((parseInt(ce[0].month)+1) + "/" + ce[0].day + "/" + ce[0].year);
	$("#neDate").datepicker({
		defaultDate:defDat
	});
	$("#neHour").val(ce[0].hour + "");
	$("#neMin").val(ce[0].minute + "");
	$("#neAMPM").val(ce[0].ampm + "");
	$("#neTag").val(ce[0].tag + "");
	$("#deleteButton, #addButton").off("click");
	$("#deleteButton").click(flip);
	$("#addButton").click(function(){editEvent(eid);});
	$("#addButton").html("save");
	$("#deleteButton").html("cancel");
}
function editEvent(eid){
	if(uid && uid!=null && uid != 'null' && eid && state==1){
		var neDtPts = document.getElementById('neDate').value.split('/');
		var neData = {};
		neData["uid"] = uid;
		neData["eid"] = parseInt(eid);
		neData["a"] = 1;//0 - add new 1-edit 2-delete
		neData["neT"] = document.getElementById('neTitle').value + '';
		neData["neN"] = document.getElementById('neNote').value + '';
		neData["neDM"] = parseInt(neDtPts[0])-1;
		neData["neDD"] = parseInt(neDtPts[1]);
		neData["neDY"] = parseInt(neDtPts[2]);
		neData["neH"] = parseInt(document.getElementById('neHour').value);
		neData["neM"] = parseInt(document.getElementById('neMin').value);
		neData["neA"] = document.getElementById('neAMPM').value + '';
		neData["neC"] = document.getElementById('neTag').value + '';
		$.post("eventActions.php", neData, function(r){
			if(parseInt(r) == 0){
				alert("there was an error saving your event");
			}else if(parseInt(r) == 1){
				
			}
		});
	}else{
		alert("you must be logged in to post an event");
	}
	flip();
}
function deleteEvent(eid){
	if(uid && uid!=null && uid != 'null' && eid){
		var neData = {};
		neData["uid"] = uid;
		neData["a"] = 2;//0 - add new 1-edit 2-delete
		neData["eid"] = eid;
		$.post("eventActions.php", neData, function(r){
			if(parseInt(r) == 0){
				alert("there was an error deleting your event");
			}else if(parseInt(r) == 1){
				refreshCalendar();
			}
		});
	}
}
