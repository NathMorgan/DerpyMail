$(document).ready(function() {
    getterLoop('incoming', $('#incoming'));
    getterLoop('outgoing', $('#outgoing'));
});

function getterLoop(datasource, element, olddata) {
    jQuery.get("datasince.php?source="+datasource, null, function(data) {
        element.html(data);
        if(olddata != data) {
            element.stop().effect("highlight", {color: "#FF0000"} , 1000);
        }
        window.setTimeout(function() { getterLoop(datasource, element, data) }, 1000);
    });
}
