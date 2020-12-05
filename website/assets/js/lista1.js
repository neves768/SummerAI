function req(type, url){
	var http = new XMLHttpRequest();
	http.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200){
			console.log(JSON.parse(this.responseText));
		}
	};
	http.open("GET", url, true);
	http.send();
}

var poll = {}, lastPoll = {};
function sendPollToServer(field, state) {
	var KEY = "17LRVPAI6WM6N5B3",
		params = "";
	console.log('a')
	if(JSON.stringify(poll) == JSON.stringify(lastPoll)) return;
	
	// Explode parametros de nossa poll de modificações, para fazer inúmeras modificações além do limite de 15s do ThingSpeak
	for(var i in poll){
		params += `&${i}=${poll[i]}`;
	}
	
	// Submeter a poll
	const http = new XMLHttpRequest();
	http.open("GET", "https://api.thingspeak.com/update?api_key="+KEY+params);
	http.send();
	http.onload = console.log(http.responseText+" "+state)
	lastPoll = {...poll};
	document.querySelector("#polltxt").innerHTML = ""
} 

function initLamps(){
	var http = new XMLHttpRequest();
	http.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200){
			var data = JSON.parse(this.responseText)
			console.log(data);
			makeLamps(data.feeds)
			//req("GET", "https://api.thingspeak.com/channels/1183857/feeds.json?results=1")
		}
	};
	http.open("GET", "https://api.thingspeak.com/channels/1183857/feeds.json?results=1", true);
	http.send();
	setInterval(sendPollToServer, 15000)
}

var timer = {}
function change(btn, idx){
	var el = document.getElementById(idx);
	if((idx in timer) && Date.now()-timer[idx] < 3000){
		alert("Esta lampada possui cooldown de 3s, aguarde até agir novamente.");
		return;
	} else if(!(idx in timer)) timer[idx] = Date.now();
	else timer[idx] = Date.now();
	if(el.src.includes("Loff.png")){
		el.src = "assets/img/Lon.png";
		btn.innerHTML = "Desligar";
		poll[idx] = "1"
	} else {
		el.src = "assets/img/Loff.png";
		btn.innerHTML = "Ligar";
		poll[idx] = "0"
	}
	document.querySelector("#polltxt").innerHTML = "Suas alterações serão submetidas em até 15s"
}

function makeLamps(feeds){
	var quant = 7, // MAX 6. A partir do 7º, os estados serão registrados em um ARRAY no field7.
		state = "0",
		lamps = "",
		thingspeak = "";
	for(var i=1; i <= quant; i++){
		if(feeds[0] != undefined)
			state = feeds[0]['field'+i];
		else state = 0
		poll["field"+i] = state;
		lamps += `
			<div>
				<img src="assets/img/L${state == "1" ? "on" : "off"}.png" class="lamp" id="field${i}"/><br>
				<button type="button" onclick="change(this, 'field${i}')">${state == "1" ? "Desligar" : "Ligar"}</button>
			</div>
		`
		if(i <= 6){
			thingspeak += `	
				<iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1183857/charts/${i}?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Lamp+${i}&type=line"></iframe>
			`
		}
	}
	lastPoll = {...poll};
	document.querySelector("#lampadas").innerHTML = lamps;
	document.querySelector("#graph").innerHTML = thingspeak;
	document.querySelector(".selection").innerHTML = "Foram carregadas "+quant+" lâmpadas dinamicamente";
}

function mudar(){
	var txt = "",
		quant = 10;
	for(var i=0; i<quant; i++){
		txt += (i+1)+" mudou<br>";
	}
	document.querySelector("#result").innerHTML = txt+quant+"x";
}

if(document.getElementById("lampadas") != null){
	initLamps();
}