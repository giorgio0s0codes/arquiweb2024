<!DOCTYPE html>
<html>
<head>
    <title>How to Store Form data in CSV File using PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
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
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>How to Store Form data in CSV File using PHP</h2>
        <div class="col-md-6" style="margin:0 auto; float:none;">
            <form method="post" action="usuarioCNT.php">
                <h3>Contact Form</h3>
                <?php echo $error; ?>
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" name="usuario" placeholder="Enter Usuario" value="<?php echo $usuario; ?>" />
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" placeholder="Enter Nombre" value="<?php echo $nombre; ?>" />
                </div>
                <div class="form-group">
                    <label>Apellido Paterno</label>
                    <input type="text" name="apellido_paterno" placeholder="Enter Apellido Paterno" value="<?php echo $apellido_paterno; ?>" />
                </div>
                <div class="form-group">
                    <label>Apellido Materno</label>
                    <input type="text" name="apellido_materno" placeholder="Enter Apellido Materno" value="<?php echo $apellido_materno; ?>" />
                </div>
                <div class="form-group">
                    <label>Mail</label>
                    <input type="text" name="mail" placeholder="Enter Apellido Materno" value="<?php echo $apellido_materno; ?>" />
                </div>
                <div class="form-group">
                    <label>Choose a Number</label>
                    <select name="number_choice">
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
    </div>
</body>
</html>
