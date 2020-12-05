
$("form").on("submit", function(e){
    e.preventDefault();
    $.post("API/AUT/act/login", {email:$("#email").val(), senha:$("#senha").val()}, function(r){
        console.log(r)
        if(r.success){
            document.querySelector("#msgbox").innerHTML = `
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ${r.response}<br>
            </div>
            `
            setTimeout(function(){ 
                document.location = "/home"
            }, 2000)
        } else {
            document.querySelector("#msgbox").innerHTML = `
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ${r.response}
            </div>
            `
        }
        setTimeout(function(){ 
            document.querySelector("#msgbox").innerHTML = ""
        }, 5000)
    })
})