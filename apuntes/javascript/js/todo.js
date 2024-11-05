//todo.js

var btnAgregar = document.getElementById("addTarea");
var inpTarea = document.getElementById("tarea");
var pendientesTable = document.querySelector("table.table-striped.table-bordered");
var realizadasTable = document.querySelector("#realizadasTable tbody");

btnAgregar.addEventListener("click", function(e){
    e.preventDefault();

    if (inpTarea.value.trim() === "") return;

    var tr = document.createElement("tr");
    var td = document.createElement("td");
    var tdCheckbox = document.createElement("td");
    var checkbox = document.createElement("input");
    checkbox.type = "checkbox";

    td.innerHTML = inpTarea.value;
    tdCheckbox.appendChild(checkbox);

    tr.appendChild(td);
    tr.appendChild(tdCheckbox);

    pendientesTable.querySelector("tbody")?.appendChild(tr) || pendientesTable.appendChild(tr);

    inpTarea.value = "";

    checkbox.addEventListener("change", function() {
        if (checkbox.checked) {
            // Create a new row for "Tareas Realizadas"
            var completedTr = document.createElement("tr");
            var completedTd = document.createElement("td");
            completedTr.classList.add("table-info");
            completedTd.innerHTML = td.innerHTML; // Transfer the task description
            completedTr.appendChild(completedTd); // Append the task description to the completed row

            // Append the completed row to "Tareas Realizadas"
            realizadasTable.appendChild(completedTr);
            
            // Remove the row from "Tareas Pendientes"
            tr.remove();
        }
    });
});