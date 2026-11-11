document.addEventListener("DOMContentLoaded", function(){

let button = document.querySelector("#lookup");
button.addEventListener("click", function(){
    let search = document.getElementById("country").value.trim();
    
    if (search==""){
        $.get("world.php", function(response) {
        document.querySelector("#result").innerHTML=response;
        });
        return;
    }
        
    $.get("world.php", {country:search}, function(response) {
        document.querySelector("#result").innerHTML=response;
        });

    });
});