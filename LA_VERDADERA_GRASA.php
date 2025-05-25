<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SISTEMA PRACTICA DE RODOLFO</title>
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            padding: 0;
            background: url("20241119_230725.jpg") no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            animation: fadeInBg 2s;
            font-size: 0.85em;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        @keyframes fadeInBg {
            from { filter: blur(8px) brightness(0.7);}
            to { filter: blur(0) brightness(1);}
        }
        .register-form, .login-form {
            background: rgba(34, 31, 177, 0.96);
            padding: 1.2em 1.5em;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgb(31, 22, 155, 0.25);
            margin-top: 2em;
            animation: popIn 1s;
            width: 270px;
        }
        .register-form input, .register-form button,
        .login-form input, .login-form button {
            margin-bottom: 0.7em;
            width: 100%;
            padding: 0.45em 0.7em;
            border-radius: 8px;
            border: none;
            font-size: 0.97em;
            box-sizing: border-box;
        }
        .register-form input, .login-form input {
            background:rgb(55, 61, 112);
            color: #222;
            border: 1px solid rgb(112, 140, 253);
            transition: border 0.2s;
        }
        .register-form input:focus, .login-form input:focus {
            outline: none;
            border: 1.5px solid rgb(88, 95, 150);
        }
        .register-form button, .login-form button {
            background: linear-gradient(90deg,rgb(253, 253, 253) 60%,rgb(61, 60, 66) 100%);
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.10s, transform 0.7s;
            font-size: 1em;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(148, 148, 153, 0.2);
        }
        .register-form button:hover, .login-form button:hover {
            background: linear-gradient(90deg, #3b4fdc 60%, #2a3daa 100%);
            transform: translateY(-2px) scale(1.04);
        }
        .register-form label, .login-form label {
            color: #fff;
            font-size: 0.98em;
            margin-bottom: 0.2em;
            display: block;
            font-weight: 500;
            letter-spacing: 0.2px;
        }
        .success-message {
            color:rgb(11, 19, 131);
            font-weight: bold;
            margin-bottom: 1em;
            text-align: center;
            animation: fadeIn 4s;
        }
        .error-message {
            color:#fff;
            background:#c00;
            font-weight:bold;
            margin-bottom:1em;
            text-align:center;
            border-radius:6px;
            padding:0.5em;
            animation: fadeIn 2s;
        }
        .footer {
            margin-top: 3em;
            color: #fff;
            text-align: center;
            text-shadow: 0 2px 8px #000;
            animation: fadeIn 2s;
        }
        @keyframes slideDown {
            from { transform: translateY(-4px); opacity: 0;}
            to { transform: translateY(0); opacity: 1;}
        }
        @keyframes fadeIn {
            from { opacity: 0;}
            to { opacity: 1;}
        }
        @keyframes popIn {
            from { transform: scale(0.8); opacity: 0;}
            to { transform: scale(1); opacity: 1;}
        }
        .switch-btn {
            position: absolute;
            top: 18px;
            right: 24px;
            background: #fff;
            color: #2a3daa;
            border: none;
            border-radius: 8px;
            padding: 0.5em 1.1em;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 2px 8px #1e1e6b33;
            transition: background 0.2s, color 0.2s, transform 0.2s;
            z-index: 10;
        }
        .switch-btn:hover {
            background: #2a3daa;
            color: #fff;
            transform: scale(1.04);
        }
        .hidden {
            display: none;
        }
        .custom-title, .custom-subtitle, .custom-desc {
            text-align: center;
        }
        .custom-title {
            font-size: 2.5em;
            color: #fff;
            font-weight: bold;
            margin-bottom: 0.2em;
            letter-spacing: 2px;
            text-shadow: 0 2px 8px #000;
            animation: slideDown 1s;
        }
        .custom-subtitle {
            font-size: 1.5em;
            color:rgb(25, 34, 161);
            margin-bottom: 0.5em;
            text-shadow: 0 2px 8px #000;
            animation: fadeIn 1.5s;
        }
        .custom-desc {
            font-size: 1.2em;
            color: #fff;
            margin-bottom: 1.5em;
            text-shadow: 0 2px 8px #000;
            animation: fadeIn 2s;
        }
    </style>
    <script>
        function toggleForms() {
            document.getElementById('register-form').classList.toggle('hidden');
            document.getElementById('login-form').classList.toggle('hidden');
        }
    </script>
</head>
<body>
    <button class="switch-btn" onclick="toggleForms()">Cambia</button>
    <div style="display:flex; flex-direction:column; align-items:center; margin-top:2em;">
        <div class="custom-title">BILLIE FANS</div>
        <div class="custom-subtitle">EL CLUB DE FANS</div>
        <div class="custom-desc">JEFE</div>
    </div>

    <?php
    $success = false;
    $error = '';
    $name = '';
    $email = '';
    $age = '';
    $showLogin = false;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['login'])) {
            // Admin login
            $login_name = trim($_POST["login_name"] ?? "");
            $login_email = trim($_POST["login_email"] ?? "");
            if (
                strtolower($login_name) === 'admin' &&
                strtolower($login_email) === 'admin@admin.com'
            ) {
                header("Location: access.php");
                exit;
            } else {
                $error = "Access denied. Invalid credentials.";
                $showLogin = true;
            }
        } else {
            // User registration
            $name = trim($_POST["name"] ?? "");
            $email = trim($_POST["email"] ?? "");
            $age = trim($_POST["age"] ?? "");

            if ($name === '' || $email === '' || $age === '') {
                $error = "All fields are required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email address.";
            } elseif (!ctype_digit($age) || (int)$age < 1) {
                $error = "Age must be a positive number.";
            } else {
                $line = date("Y-m-d H:i:s") . " | " .
                    str_replace(["\r","\n","|"], '', $name) . " | " .
                    str_replace(["\r","\n","|"], '', $email) . " | " .
                    str_replace(["\r","\n","|"], '', $age) . PHP_EOL;
                $file = __DIR__ . "/register.txt";
                if (file_put_contents($file, $line, FILE_APPEND | LOCK_EX) !== false) {
                    $success = true;
                    $name = '';
                    $email = '';
                    $age = '';
                } else {
                    $error = "Could not save registration. Please try again.";
                }
            }
        }
    }
?>

    <div id="register-form" class="register-form<?php if($showLogin) echo ' hidden'; ?>">
        <?php if ($success): ?>
            <div class="success-message">Registro exitoso.</div>
        <?php elseif (!empty($error) && !$showLogin): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" autocomplete="off" style="display: flex; flex-direction: column; align-items: center;">
            <label for="name" style="align-self: flex-start;">Nombre:</label>
            <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($name); ?>">
            <label for="email" style="align-self: flex-start;">Correo electrónico:</label>
            <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>">
            <label for="age" style="align-self: flex-start;">Edad:</label>
            <input type="text" id="age" name="age" required value="<?php echo htmlspecialchars($age); ?>">
            <button type="submit" style="margin-top: 0.7em;">Registrarse</button>
        </form>
    </div>

    <div id="login-form" class="login-form<?php if(!$showLogin) echo ' hidden'; ?>">
        <?php if (!empty($error) && $showLogin): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" autocomplete="off">
            <label for="login_name">Nombre de administrador:</label>
            <input type="text" id="login_name" name="login_name" required>
            <label for="login_email">Correo del administrador:</label>
            <input type="email" id="login_email" name="login_email" required>
            <button type="submit" name="login" value="1">Iniciar sesión</button>
        </form>
    <div class="footer">
        &copy; <?php echo date("Y"); ?> EL JEFE/BILLIE. Todos los derechos reservados.
    </div>
<?php
ob_end_flush();

?>
<style>
    .instagram-btn-fixed {
        position: fixed;
        top: 30px;
        left: 30px;
        z-index: 100;
        display: flex;
        align-items: center;
        gap: 0.6em;
        background: linear-gradient(90deg, #e1306c 60%, #fdc468 100%);
        color: #fff;
        font-weight: bold;
        padding: 0.7em 1.5em;
        border-radius: 8px;
        text-decoration: none;
        font-size: 1.1em;
        box-shadow: 0 2px 8px rgba(25, 25, 156, 0.2);
        transition: background 0.2s, transform 0.2s;
        margin-bottom: 1em;
    }
    .instagram-btn-fixed:hover {
        background: linear-gradient(90deg, #fdc468 60%, #e1306c 100%);
        transform: scale(1.04);
        color: #fff;
        text-decoration: none;
    }
    .instagram-icon {
        width: 1.4em;
        height: 1.4em;
        display: inline-block;
        vertical-align: middle;
    }
</style>
<a href="https://www.instagram.com/?hl=es-la" target="_blank" class="instagram-btn-fixed">
    <svg class="instagram-icon" viewBox="0 0 448 512" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <linearGradient id="ig-gradient" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#fdc468"/>
            <stop offset="100%" stop-color="#e1306c"/>
        </linearGradient>
        <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9 114.9-51.3 114.9-114.9S287.7 141 224.1 141zm0 186c-39.5 0-71.5-32-71.5-71.5s32-71.5 71.5-71.5 71.5 32 71.5 71.5-32 71.5-71.5 71.5zm146.4-194.3c0 14.9-12 26.9-26.9 26.9s-26.9-12-26.9-26.9 12-26.9 26.9-26.9 26.9 12 26.9 26.9zm76.1 27.2c-1.7-35.3-9.9-66.7-36.2-92.9C385.6 9.9 354.2 1.7 318.9 0 278.4-1.7 169.6-1.7 129.1 0 93.8 1.7 62.4 9.9 36.2 36.2 9.9 62.4 1.7 93.8 0 129.1c-1.7 40.5-1.7 149.3 0 189.8 1.7 35.3 9.9 66.7 36.2 92.9 26.2 26.2 57.6 34.4 92.9 36.2 40.5 1.7 149.3 1.7 189.8 0 35.3-1.7 66.7-9.9 92.9-36.2 26.2-26.2 34.4-57.6 36.2-92.9 1.7-40.5 1.7-149.3 0-189.8zM398.8 388c-7.8 19.6-22.9 34.7-42.5 42.5-29.4 11.7-99.2 9-132.3 9s-102.9 2.6-132.3-9c-19.6-7.8-34.7-22.9-42.5-42.5-11.7-29.4-9-99.2-9-132.3s-2.6-102.9 9-132.3c7.8-19.6 22.9-34.7 42.5-42.5C121.1 9 190.9 11.6 224 11.6s102.9-2.6 132.3 9c19.6 7.8 34.7 22.9 42.5 42.5 11.7 29.4 9 99.2 9 132.3s2.6 102.9-9 132.3z" fill="url(#ig-gradient)"/>
    </svg>
    Ir a Instagram
</a>

<?php
$file = __DIR__ . '/register.txt';
if (!file_exists($file)) {
    file_put_contents($file, "File created automatically.");
}
if (file_exists($file)) {
    $lines = file($file);
    foreach ($lines as $line) {
        echo htmlspecialchars($line) . "<br>";
    }
}
?>
</body>
</html>
