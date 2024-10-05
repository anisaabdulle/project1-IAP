<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class=" container mt-5">
        <h1>Register</h1>
        <form action="registers.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">username</label> 
                <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
</div>
    <div class="mb-3">
        <label for="password" class="form-label">password</label>
        <input type="password" class="form-control" id="password" name="password" required>

    </div>
    <button type="submit" class="btn btn-primary">register</button>
        </form>
        <p class="mt-3">Already have an account? <a href="signup.php">Sign in here</a></p>
    </div>
   
</body>
</html>