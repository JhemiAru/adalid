<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Usuario</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: linear-gradient(135deg, #e2e8f0, #f8fafc);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 360px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #0f172a;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #1e293b;
        }

        .link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .link a {
            color: #0f172a;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="card">

    <h2>👤 Registro de Usuario</h2>

    <form action="/register" method="POST">
        @csrf

        <input type="text" name="name" placeholder="Nombre">
        <input type="email" name="email" placeholder="Correo">
        <input type="password" name="password" placeholder="Contraseña">

        <button type="submit">Registrar</button>
    </form>

    <!-- 🔥 AQUÍ ESTÁ EL CAMBIO -->
    <div class="link">
        ¿Ya tienes cuenta? <a href="/login">Inicia sesión</a>
    </div>

</div>

</body>
</html>