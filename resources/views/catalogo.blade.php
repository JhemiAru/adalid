<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f1f5f9;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, #0f172a, #1e293b);
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .sidebar a:hover {
            background: #334155;
        }

        /* MAIN */
        .main {
            margin-left: 260px;
            padding: 30px;
        }

        h2 {
            margin-bottom: 20px;
        }

        /* GRID */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        /* CARD */
        .card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 160px;
            object-fit: cover;
        }

        .info {
            padding: 12px;
        }

        .info h3 {
            margin: 0;
            font-size: 16px;
        }

        .desc {
            font-size: 12px;
            color: #666;
            margin: 5px 0;
        }

        .price {
            font-weight: bold;
            color: #0f172a;
        }

    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>📦 Sistema</h2>

    <a href="/">🏠 Dashboard</a>
    <a href="/catalogo">🛍️ Catálogo</a>
    <a href="/productos">📋 Productos</a>
</div>

<!-- MAIN -->
<div class="main">

    <h2>📦 Catálogo de Productos</h2>

    <div class="grid">

        <!-- PRODUCTO 1 -->
        <div class="card">
            <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8">
            <div class="info">
                <h3>Laptop HP</h3>
                <p class="desc">Laptop Intel i5 ideal para estudio y trabajo.</p>
                <p class="price">Bs 4500</p>
            </div>
        </div>

        <!-- PRODUCTO 2 -->
        <div class="card">
            <img src="https://images.unsplash.com/photo-1510557880182-3d4d3cba35a5">
            <div class="info">
                <h3>Mouse Gamer</h3>
                <p class="desc">Mouse con DPI ajustable y luces RGB.</p>
                <p class="price">Bs 120</p>
            </div>
        </div>

        <!-- PRODUCTO 3 -->
        <div class="card">
            <img src="https://images.unsplash.com/photo-1585238342028-4c1b4b0f3b7d">
            <div class="info">
                <h3>Teclado Mecánico</h3>
                <p class="desc">Teclado gamer RGB switches rápidos.</p>
                <p class="price">Bs 250</p>
            </div>
        </div>

        <!-- PRODUCTO 4 -->
        <div class="card">
            <img src="https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f">
            <div class="info">
                <h3>Audífonos</h3>
                <p class="desc">Cancelación de ruido y sonido HD.</p>
                <p class="price">Bs 300</p>
            </div>
        </div>

        <!-- PRODUCTO 5 -->
        <div class="card">
            <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9">
            <div class="info">
                <h3>Smartphone</h3>
                <p class="desc">Pantalla AMOLED, cámara 48MP.</p>
                <p class="price">Bs 1800</p>
            </div>
        </div>

        <!-- PRODUCTO 6 -->
        <div class="card">
            <img src="https://images.unsplash.com/photo-1518770660439-4636190af475">
            <div class="info">
                <h3>Tablet</h3>
                <p class="desc">Ideal para estudio y dibujo digital.</p>
                <p class="price">Bs 2200</p>
            </div>
        </div>

        <!-- PRODUCTO 7 -->
        <div class="card">
            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30">
            <div class="info">
                <h3>Monitor LED</h3>
                <p class="desc">Monitor 24 pulgadas Full HD.</p>
                <p class="price">Bs 900</p>
            </div>
        </div>

        <!-- PRODUCTO 8 -->
        <div class="card">
            <img src="https://images.unsplash.com/photo-1587829741301-dc798b83add3">
            <div class="info">
                <h3>Impresora</h3>
                <p class="desc">Impresora multifuncional WiFi.</p>
                <p class="price">Bs 1200</p>
            </div>
        </div>

    </div>

</div>

</body>
</html>