<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

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
            width: 350px;
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

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .link {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="card">

    <h2>🔐 Iniciar Sesión</h2>

    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <form action="/login" method="POST">
        @csrf

        <input type="email" name="email" placeholder="Correo">
        <input type="password" name="password" placeholder="Contraseña">

        <button type="submit">Ingresar</button>
    </form>

    <div class="link">
        ¿No tienes cuenta? <a href="/register">Regístrate</a>
    </div>

</div>

</body>
</html>