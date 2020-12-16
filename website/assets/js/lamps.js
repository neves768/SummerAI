function initLamps(){
    $.get("API/DEV/list", {}, function(r){
        makeLamps(r)
    })
}

var timer = {}, devices={};
function change(idx){
	var el = document.getElementById(idx);
	if((idx in timer) && Date.now()-timer[idx] < 3000){
		alert("Esta lampada possui cooldown de 3s, aguarde até agir novamente.");
		return;
	} else if(!(idx in timer)) timer[idx] = Date.now();
	else timer[idx] = Date.now();
	if(el.src.includes((devices[idx].type)+"off.png")){
		el.src = "assets/img/"+(devices[idx].type)+"on.png";
        $("#"+idx+"lbl").text("Desligar");
        st = true
	} else {
        el.src = "assets/img/"+(devices[idx].type)+"off.png";
        $("#"+idx+"lbl").text("Ligar");
        st = false
    }
    console.log(el.src)
    $.post("API/DEV/update", {ID: idx, state: st}, function(r){
        console.log(r)
    })
}

function makeLamps(data){
	var quant = 7, // MAX 6. A partir do 7º, os estados serão registrados em um ARRAY no field7.
		state = "0",
        lamps = "";
    for(var i=0; i < data.response.length; i++){
        state = JSON.parse(data.response[i].dados).state
        devices[data.response[i].ID] = data.response[i]
        lamps += `
        <div class="media text-muted pt-3">
            <img src="assets/img/${data.response[i].type}${state == "true" ? "on" : "off"}.png" class="lamp" id="${data.response[i].ID}" width="25"/>
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

function getMsgBox(success, msg){
    return `
    <div class="alert alert-${success ? "success" : "danger"}" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        ${msg}
    </div>
    `
}

function addDevice(){
    $.post("API/DEV/add/device", {nome: $("#devicename").val(), type: $("#deviceID").val()}, function(r){
        $("#daddmsgbox").html(getMsgBox(r.success, r.response))
        initLamps()
        setTimeout(function(){
            $("#deviceAdd").modal("hide")
        }, 1500)
    })
}

if(document.getElementById("lampadas") != null){
    initLamps();
    $("#addDevicebtn").on("click", addDevice);
}