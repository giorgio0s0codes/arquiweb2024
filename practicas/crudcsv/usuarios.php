<!DOCTYPE html>
<html>
<head>
    <title>User Registry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: block;
            margin: 0 auto;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group input[type="submit"] {
            background-color: #17a2b8;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #138496;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .edit-button {
            background-color: #28a745;
            color: white;
        }
        .delete-button {
            background-color: #dc3545;
            color: white;
        }
        .edit-button:hover {
            background-color: #218838;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Registry</h2>
        <div class="col-md-6" style="margin:0 auto; float:none;">
            <form method="post" action="usuarioCNT.php">
                <h3>User Info</h3>
                <?php if (!empty($error)) echo "<p>$error</p>"; ?>
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Enter Usuario" value="<?php echo $usuario; ?>" />
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Enter Nombre" value="<?php echo $nombre; ?>" />
                </div>
                <div class="form-group">
                    <label for="apellido_paterno">Apellido Paterno</label>
                    <input type="text" id="apellido_paterno" name="apellido_paterno" placeholder="Enter Apellido Paterno" value="<?php echo $apellido_paterno; ?>" />
                </div>
                <div class="form-group">
                    <label for="apellido_materno">Apellido Materno</label>
                    <input type="text" id="apellido_materno" name="apellido_materno" placeholder="Enter Apellido Materno" value="<?php echo $apellido_materno; ?>" />
                </div>
                <div class="form-group">
                    <label for="mail">Mail</label>
                    <input type="email" id="mail" name="mail" placeholder="Enter Mail" value="<?php echo $mail; ?>" />
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Enter Contraseña" value="<?php echo $mail; ?>"/>
                </div>
                <div class="form-group">
                    <label for="number_choice">Choose a Number</label>
                    <select id="number_choice" name="number_choice">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="form-group" align="center">
                    <input type="submit" name="submit" value="Submit" />
                </div>
            </form>
        </div>

        <?php
        // Display user data if available
        $file = fopen('./DB/usuarios.csv', 'r');
        if ($file) {
            echo "<table>";
            echo "<tr><th>Usuario</th><th>Nombre</th><th>Apellido Paterno</th><th>Apellido Materno</th><th>Mail</th><th>Contraseña</th><th>Plan</th><th>Acciones</th></tr>";
            while (($line = fgetcsv($file)) !== FALSE) {
                echo "<tr>";
                foreach ($line as $cell) {
                    echo "<td>" . htmlspecialchars($cell) . "</td>";
                }
                echo "<td class='action-buttons'>";
                echo "<button class='edit-button'>Editar</button>";
                echo "<button class='delete-button'>Borrar</button>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
            fclose($file);
        }
        ?>
    </div>
</body>
</html>
