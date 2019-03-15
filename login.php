<html>

<head>
    <title>Login and Regiseter</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="login-box">
            <div class="row">
                <div class="rol-md-6 login-left">
                    <h2>Login </h2>
                    <form action="validation.php" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="user" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary"> Login
                        </button>
                    </form>


                </div>
                <div class="rol-md-6 login-right">
                    <h2>Register</h2>
                    <form action="registration.php" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="user" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary"> Register
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</body>

</html>
