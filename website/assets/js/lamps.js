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
	
} 

function initLamps(){
    $.get("API/AUT/list/devices", {}, function(r){
        makeLamps(r)
    })
}

var timer = {}
function change(idx){
	var el = document.getElementById(idx);
	if((idx in timer) && Date.now()-timer[idx] < 3000){
		alert("Esta lampada possui cooldown de 3s, aguarde até agir novamente.");
		return;
	} else if(!(idx in timer)) timer[idx] = Date.now();
	else timer[idx] = Date.now();
	if(el.src.includes("Loff.png")){
		el.src = "assets/img/Lon.png";
        $("#"+idx+"lbl").text("Desligar");
        st = true
	} else {
        el.src = "assets/img/Loff.png";
        $("#"+idx+"lbl").text("Ligar");
        st = false
	}
    $.post("API/AUT/set/device", {ID: idx, state: st}, function(r){
        console.log(r)
    })
}

function makeLamps(data){
	var quant = 7, // MAX 6. A partir do 7º, os estados serão registrados em um ARRAY no field7.
		state = "0",
        lamps = "";
	for(var i=0; i < data.response.length; i++){
        console.log(data.response[i].dados)
        state = JSON.parse(data.response[i].dados).state
        lamps += `
        <div class="media text-muted pt-3">
            <img src="assets/img/L${state == "true" ? "on" : "off"}.png" class="lamp" id="${data.response[i].ID}" width="25"/>
            <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark">${data.response[i].nome}</strong>
                <a id="${data.response[i].ID}lbl" href="javascript:change('${data.response[i].ID}')">${state == "true" ? "Desligar" : "Ligar"}</a>
                Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor
                mauris condimentum nibh, ut fermentum massa justo sit amet risus.
            </p>
        </div>
		`
	}
	document.querySelector("#lampadas").innerHTML = lamps;
}

if(document.getElementById("lampadas") != null){
	initLamps();
}