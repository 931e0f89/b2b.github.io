<?php
// Auto-generate password function
function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $chars[random_int(0, strlen($chars)-1)];
    }
    return $password;
}

// Get user IP address
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    else return $_SERVER['REMOTE_ADDR'];
}

// Handle form submission
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars(trim($_POST['email']));
    $ip = htmlspecialchars(trim($_POST['ip']));
    $password = htmlspecialchars(trim($_POST['password']));

    // TODO: Save user (email, ip, password) to database or file

    $success = true;
} else {
    $email = '';
    $ip = getUserIP();
    $password = generatePassword(8);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authorization</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f3f3f9;
            font-family: 'Montserrat', sans-serif;
        }
        .container {
            max-width: 350px;
            margin: 40px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(100,100,150,0.08);
            padding: 32px 24px;
            text-align: center;
        }
        .container h2 {
            color: #7c3aed;
            margin-bottom: 24px;
            font-size: 2.0rem;
            font-weight: 700;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        label {
            text-align: left;
            color: #7c3aed;
            font-weight: 500;
            font-size: 0.98rem;
            margin-bottom: 6px;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            padding: 14px 12px;
            border: none;
            border-radius: 6px;
            background: #f0f0f5;
            font-size: 1.08rem;
            color: #222;
            margin-bottom: 2px;
        }
        input[readonly] {
            color: #555;
            background: #eef0f6;
        }
        .btn {
            padding: 15px 0;
            background: #7c3aed;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.2s;
        }
        .btn:hover {
            background: #5a2ec2;
        }
        .success {
            color: #2ecc71;
            font-weight: 600;
            margin-bottom: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Authorization</h2>
        <?php if ($success): ?>
            <div class="success">Registration successful!</div>
        <?php endif; ?>
        <form method="post" autocomplete="off">
            <div>
                <label>Your IP</label>
                <input type="text" name="ip" value="<?php echo htmlspecialchars
