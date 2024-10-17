<?php

function editarPlan($plansrch, $newData){
    $plans = getPlanes();
    $planFound = false;
    $updatedPlan = [];

    foreach ($plans as $plan){
        if($plan["id"] == $plansrch){
            $plan["id"] = isset($newData["id"]) ? $newData["id"] : $plan["id"];
            $plan["nombre"] = isset($newData["nombre"]) ? $newData["nombre"] : $plan["nombre"];
            $planFound = true;
        }
        $updatedPlan[] = $plan;
    }

    if(!$planFound) {
        echo "Plan no encontrado.\n";
        return false;
    }

    $file_handle = fopen('./DB/planes.csv', 'w');
    foreach ($updatedPlan as $plan) {
        if (!empty(trim($plan["id"]))) {  // Evitar escribir líneas vacías
            $line = implode(",", array_map('trim', array_values($plan))) . "\n";
            fwrite($file_handle, $line);
        }
    }
    fclose($file_handle);
    echo "Archivo escrito exitosamente.\n";
}

function borrarId($plansrch){
    $plans = getPlanes();

    $plan = getPlan($plansrch);

    if ($plan){
        $planIndex = array_search($plan['id'], array_column($plans, 'id'));

        if ($planIndex !== false){
            unset($plans[$planIndex]);

            $plans = array_values($plans);

            $file_handle = fopen("./DB/planes.csv", "w");
            foreach($plans as $plan){
                fputcsv($file_handle, $plan);
            }
            fclose($file_handle);

            return "Plan eliminado.";
        } 
        else{
            return "Plan no encontrado en la lista.";
        }

    }
    else{
        return "Plan no encontrado.";
    }
}


function getPlanes() {
    // Open the CSV file
    $file_handle = fopen("./DB/planes.csv", "r");
    $data = fread($file_handle, filesize('./DB/planes.csv'));
    fclose($file_handle);
    
    // Split data into lines and filter out any empty lines
    $lineas = array_filter(explode("\n", trim($data)));

    $plans = array();
    foreach ($lineas as $linea) {
        // Trim each line and avoid empty or malformed entries
        $values = array_map('trim', explode(",", $linea));

        if (count($values) == 2) {
            $plan = array(
                "id"    => $values[0],
                "nombre"     => $values[1]
            );
            array_push($plans, $plan);
        }
    }
    
    return $plans;
}

function getPlan($plansrch){
    $plans = getPlanes();

    $plan = array_filter($plans, function($plan) use($plansrch){
        return $plan["id"] == $plansrch;
    });

    if (!empty($plan)) {
        $plan = array_values($plan);
        return $plan[0];
    }
}

if(isset($_GET["prueba"]) && isset($_GET["method"]) && $_GET["method"] == "getPlanes"){
	//Probar el método getUsuarios:
	
	echo "probando getPlanes";
	var_dump(getPlanes());
	
}

if(isset($_GET["prueba"]) && isset($_GET["method"]) && $_GET["id"]  && $_GET["method"] == "getPlan"){
	//Probar el método getPlan:
	
	echo "probando getPlan";
	var_dump(getPlan($_GET["id"]));
	
}

if(isset($_GET["prueba"]) && isset($_GET["method"]) && $_GET["id"]  && $_GET["method"] == "borrarId"){
	//Probar el método Borrar:
	
	echo "probando Borrar";
	var_dump(borrarId($_GET["id"]));
	
}