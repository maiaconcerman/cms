<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Agriculture Portal</title>
<link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
<div class="container">
    <h2 class="title">Login to SINAG</h2>
    
    <!-- Login form -->
    <form action="process_login.php" method="POST" class="login-form">
        <!-- Email input field -->
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" required class="form-input">

        <!-- Password input field -->
        <label for="password" class="form-label">Password:</label>
        <input type="password" id="password" name="password" required class="form-input">
        <!-- Checkbox to show/hide password -->
        <label>
                <input type="checkbox" id="show-password"> Show Password
            </label><br><br>

        <!-- Terms and Agreements Button -->
        <input type="checkbox" id="agree-terms" required>
        <label for="agree-terms">I agree to the <a href="terms.php" target="_blank">Terms and Agreements</a></label>
        <br><br>
        <button type="submit" class="submit-button">Login</button>
    </form>
    <!-- JavaScript for show/hide password functionality -->
    <script>
        document.getElementById('show-password').addEventListener('change', function() {
            const passwordField = document.getElementById('password');
            passwordField.type = this.checked ? 'text' : 'password';
        });
    </script>
   
</div>
</body>
</html>

