function check(input) {
    if(document.querySelector('#senha').value.length > 0 || document.querySelector('#senhacf').value.length > 3){
        if (input.value != document.querySelector('#senha').value) {
            input.setCustomValidity('Suas senhas estão divergindo');
            document.querySelector("#msgbox").innerHTML = `
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                As senhas estão divergindo. Confirme sua senha corretamente.
            </div>
            `
        } else {
            input.setCustomValidity('');
            document.querySelector("#msgbox").innerHTML = ""
        }
    }
}

$("form").on("submit", function(e){
    e.preventDefault();
    $.post("API/AUT/act/register", {nome:$("#nome").val(), sobrenome:$("#sobrenome").val(), email:$("#email").val(), senha:$("#senha").val()}, function(r){
        if(r.success){
            document.querySelector("#msgbox").innerHTML = `
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                ${r.response}<br>
                <a href="/iotsummer">Clique aqui</a> para retornar ao início, caso não seja redirecionado automaticamente.
            </div>
            `
            setTimeout(function(){ 
                document.location = "/iotsummer/"
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
    });
})