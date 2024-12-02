<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Agriculture Portal</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2 class="title">Register for Agriculture Portal</h2>

        <!-- Registration form -->
        <form action="process_register.php" method="POST" class="registration-form">
            <!-- Email input field -->
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" required class="form-input"><br>

            <!-- Password input field -->
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" required class="form-input"><br>

            <!-- Checkbox to show/hide password -->
            <label>
                <input type="checkbox" id="show-password"> Show Password
            </label><br>

            <!-- Terms and privacy policy checkbox -->
            <label>
                <input type="checkbox" name="terms" required> I agree to the terms and privacy policy
            </label><br><br><br>

            <button type="submit" class="submit-button">Register</button>
        </form>

        <!-- Link to go back to the login page -->
        <p class="register-link">Already have an account? <a href="login.php" class="register-button">Login Here</a></p>
    </div>

    <!-- JavaScript for show/hide password functionality -->
    <script>
        document.getElementById('show-password').addEventListener('change', function() {
            const passwordField = document.getElementById('password');
            passwordField.type = this.checked ? 'text' : 'password';
        });
    </script>
</body>
</html>
