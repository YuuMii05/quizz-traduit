<?php
include_once 'translation.php';
?>
<?php
// Process the login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    $usersFile = "users.json";
    if (!file_exists($usersFile)) {
        file_put_contents($usersFile, json_encode([]));
    }

    $users = json_decode(file_get_contents($usersFile), true);
    $user = array_filter($users, fn($u) => $u['email'] === $email);

    if ($user && password_verify($password, $user[array_key_first($user)]['password'])) {
        // Redirect to dashboard (quiz creation page) after successful login
        header("Location: create_quiz.php");
        exit;
    } else {
        $errorMessage = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
 
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
 
        .login-container {
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
            text-align: left;
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
        input[type=email] {
            padding-left: 14px;
        }
        input[type=password] {
            padding-left: 14px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2><?php echo translate('Log in'); ?></h2>
        <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="<?= translate('Email'); ?>" required>
        <input type="password" name="password" placeholder="<?= translate('Password'); ?>" required>
        <button type="submit"><?php echo translate('Connection'); ?></button>
        </form>
        <button class="back-button" onclick="window.location.href='index.php'"><?php echo translate('Back'); ?></button>
        <?php if (isset($errorMessage)) { echo "<p class='error-message'>$errorMessage</p>"; } ?>
    </div>
</body>
</html>
 