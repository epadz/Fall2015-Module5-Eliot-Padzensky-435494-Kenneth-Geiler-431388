// JavaScript Document
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
	$(".evMark").remove();
	for(var w in weeks){
		var days = weeks[w].getDates();
		// days contains normal JavaScript Date objects. 
		//alert("Week starting on " + days[0].getDay());
 		j = 0;
		for(var d in days){
			$(".week").eq(i).children(".day").eq(j).children(".date").eq(0).html(days[d].getDate() + "");
			$(".week").eq(i).children(".day").eq(j).attr("data-month",days[d].getMonth() + "");
			$(".week").eq(i).children(".day").eq(j).attr("data-day",days[d].getDate() + "");
		j++;
		}
		i++;
	}
	getEvents(month.month);
	$(".day").attr("title","click to add an event");
	$(".day").click(function(e){
		var td = e.target.dataset.day;
		var tm = e.target.dataset.month;
		$("#addNew").css("display","block");
	});
}
$(function(){
	updateCalendar();
});

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
	
	et.appendChild(eh);
	et.appendChild(em);
	et.appendChild(ea);
	
	ed.appendChild(en);
	ed.appendChild(ep);
	
	ev.appendChild(et);
	ev.appendChild(ed);
	
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
				var monthEvents = d;
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