(async function () {
    if(app === "undefined"){
        await (await import('assets/js/jquery-3.5.1.min.js'));
        await (await import('assets/js/engine_voice.js'));
    } else {

    }
})();
