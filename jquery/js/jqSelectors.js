//
(function suma(window){

    var divs = $("div");

    console.log(divs);

    $("#contenido .col-12").css("background-color", "red");

    $("button.btn").on("click", function(e){
        //$("#contenido div.col-12").html($(this).data("id"));
        $("#contenido div.col-12").html(`<span class="badge text-bg-success">
                                            ${$(this).data("id")}
                                         </span>`);
        if($(this).data("id") == 100){
            $("#contenido div.col-12").last().fadeToggle("slow","linear");
        }
    });

})(window);