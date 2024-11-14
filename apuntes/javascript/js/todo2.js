//
var tareasData = {
    "nextId": 0,
    tareas: [],
    addTarea: function(textoTarea){
        this.tareas.push({"idTarea":++this.nextId,
                        "tarea":textoTarea,
                        "finalizada":false}
                    );
        return this.nextId;

    },
    finalizarTarea: function(idTarea){
        this.tareas.forEach(function(tarea,index){
            if(tarea.idTarea == idTarea){
                (this.tareas[index]).finalizada = true;
                return this.tareas[index];
            }
        }, this);

    },
    getPendientes: function(){
        return this.tareas.filter(function(tarea) {
            return !tarea.finalizada;
        });
    },
    getFinalizadas: function(){
        return this.tareas.filter(function(tarea) {
            return tarea.finalizada;
        });
    },
};

var btnAgregar = document.getElementById("addTarea");

btnAgregar.addEventListener("click", function(e){
    var textoTarea = document.getElementById("tarea").value;

    tareasData.addTarea(textoTarea);

    var tbd_pend = document.getElementById("tareasPendientes");
    tbd_pend.innerHTML = "";

    tbd_pend.innerHTML = tareasData.tareas.map(function(tarea){

        return `<tr id="tr_${tarea.idTarea}">
                    <td id="nombreTarea_${tarea.idTarea}">${tarea.tarea}</td>
                    <td>
                        <input> id "chk_${tarea.idTarea}"
                                type = "checkbox"
                                name = "chktarea"
                                class = "ctrTarea"
                                data-idTarea = "${tarea.tarea}">
                        </td>
                    </tr>`;
    }).join('');
    
    document.getElementById("tarea").value = "";
    document.getElementById("tarea").focus();
    eventosEliminarTarea();

});

function eventosEliminarTarea(){

    chcbxs = document.querySelectorAll("input.ctrTarea");
    Array.from(chcbxs).forEach(function(chk){

        chk.addEventListener("click",function(event){

            var idTarea = this.getAttribute("data-idTarea");
            var trfnz = tareasData.finalizarTarea(idTarea);

            var tbyFinal = document.getElementById("t_realizada");

            tbyFinal.innerHTML = "";

            tbyFinal.innerHTML = tareasData.getFinalizadas.map(function(tarea){
                return `<tr class = "table-info">
                            <td>${tarea.tarea}</td>
                        </tr>`;
            }).join('');

        });
    });
}