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