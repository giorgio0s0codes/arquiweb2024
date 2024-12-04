<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
    </head>

    <body class="d-flex justify-content-center align-items-center vh-100" style="background-color: #FFC0CB;">
        <?php
        session_start();
        $error = isset($_SESSION['error']) ? $_SESSION['error'] : null;
        unset($_SESSION['error']); // Clear the error after displaying it
        ?>
        <form method="POST" action="loginCNT.php">
            <div class="bg-white p-5 rounded-5" style="width: 25rem">
                <div class="text-center fs-1">Login</div>
                <?php if ($error): ?>
                    <div class="alert text-center mt-3" style="background-color: darkred; color: white;">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                <div class="form-group mt-3">
                    <input class="form-control" type="text" id="usuario" name="usuario" placeholder="username">
                </div>
                <div class="form-group mt-1">
                    <input class="form-control" type="password" id="password" name="password" placeholder="password">
                </div>
                <div>
                <input class="btn text-white mt-4 w-100 form-group" type="submit" name="submit" value="Enter" 
                        style="background-color: purple; border-color: purple;" />
                </div>
            </div>

        </form>
    </body>

</html>