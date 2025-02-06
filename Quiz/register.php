<?php
include 'translation.php';


// Process the registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $username = $data['username'] ?? '';
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';
    $confirmPassword = $data['confirm_password'] ?? '';

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $errorMessage = "Les mots de passe ne correspondent pas.";
    } else {
        // Save user data in users.json
        $usersFile = "users.json";
        if (!file_exists($usersFile)) {
            file_put_contents($usersFile, json_encode([]));
        }

        $users = json_decode(file_get_contents($usersFile), true);

        // Check if the user already exists
        $userExists = array_filter($users, fn($u) => $u['email'] === $email);
        if ($userExists) {
            $errorMessage = "Un utilisateur avec cet email existe déjà.";
        } else {
            // Encrypt the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Add new user
            $users[] = [
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword
            ];

            // Save the updated user list
            file_put_contents($usersFile, json_encode($users));

            // Redirect to index.php after successful registration
            header("Location: index.php?lang=fr");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo translate('register', $lang, $translations); ?></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #fff, #f8f1eb);
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .register-container {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            color: #d97c7c;
        }

        input {
            width: 90%;
            padding: 10px 0;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding-left: 14px;
        }

        button {
            background: #f8c6c5;
            border: none;
            border-radius: 30px;
            padding: 10px;
            width: 100%;
            font-size: 18px;
            color: #b24e4e;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 4px 6px 0px #d97c7c;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        button:hover {
            transform: translateY(2px);
            box-shadow: 2px 3px 0px #d97c7c;
        }

        .back-button {
            margin-top: 20px;
            background: transparent;
            border: 2px solid #d97c7c;
            color: #d97c7c;
        }

        .back-button:hover {
            background: #d97c7c;
            color: white;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2><?php echo translate('Sign up'); ?></h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="<?= translate('Username'); ?>" required>
            <input type="email" name="email" placeholder="<?= translate('Email'); ?>" required>
            <input type="password" name="password" placeholder="<?= translate('Password'); ?>" required>
            <input type="password" name="confirm_password" placeholder="<?= translate('Confirm Password'); ?>" required>
            <button type="submit"><?php echo translate('register'); ?></button>
        </form>
        <?php if (isset($errorMessage)) { echo "<p class='error-message'>$errorMessage</p>"; } ?>
        <button class="back-button" onclick="window.location.href='index.php'"><?php echo translate('Back'); ?></button>
    </div>
</body>
</html>
