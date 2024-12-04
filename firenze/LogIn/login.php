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

    <body class="bg-info d-flex justify-content-center align-items-center vh-100 ">
        <form method="POST" action="loginCNT2.php">
            <div class="bg-white p-5 rounded-5" style="width: 25rem">
                <div class="text-center fs-1">Login</div>
                <div class="form-group mt-3">
                    <input class="form-control" type="text" id="usuario" name="usuario" placeholder="username">
                </div>
                <div class="form-group mt-1">
                    <input class="form-control" type="password" id="password" name="password" placeholder="password">
                </div>
                <div>
                    <input class="btn btn-info text-white mt-4 w-100 form-group" type="submit" name="submit" value="Enter" />
                </div>
            </div>

        </form>
    </body>

</html>