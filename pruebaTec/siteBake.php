

<!DOCTYPE html>
<html>
<head>
    <title>Product Registry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 65%;
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
        <h2>Product Registry</h2>
        <div class="col-md-6" style="margin:0 auto; float:none;">
            <form method="POST" action="./CRUD/registerNewProduct.php">
                <h3>Plan Info</h3>
                <?php if (!empty($error)) echo "<p>$error</p>"; ?>
                <div class="form-group">
                    <label for="nombre">Name</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Enter Nombre" value="" />
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="int" id="price" name="price" placeholder="Enter Price" value="" />
                </div>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <input type="description" id="description" name="description" placeholder="Enter Description" value="" />
                </div>
                <div class="form-group" align="center">
                    <input type="submit" name="submit" value="Submit" />
                </div>
            </form>
        </div>
    </div>
</body>
</html>
