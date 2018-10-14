//Function JQuery to limit the time of alerts messages
$(document).ready(function() {
    setTimeout(function() {
        $(".alert").alert('close');
    }, 4000);
});