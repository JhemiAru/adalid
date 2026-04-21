<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pro - Inventario y Finanzas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CSRF (OBLIGATORIO PARA LARAVEL) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        :root {
            --primary-blue: #2563eb;
            --bg-dark: #000000;
            --card-bg: #111111;
            --sidebar-width: 240px;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            color: #1e293b;
            display: flex;
        }

        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: var(--bg-dark);
            color: white;
            padding: 20px;
        }

        .main {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 30px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            padding: 20px;
            border-radius: 12px;
            color: white;
        }

        .ingresos { background: #0e7490; }
        .egresos { background: #1e40af; }
        .caja { background: #2563eb; }
        .inventario { background: #3b82f6; }

        .box {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .btn {
            padding: 10px 15px;
            background: var(--primary-blue);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Sistema</h2>
    <p>Dashboard</p>
</div>

<!-- MAIN -->
<div class="main">

    <!-- CARDS -->
    <div class="cards">
        <div class="card ingresos">
            <h4>Ingresos</h4>
            <p id="totalIngresos">0 Bs</p>
        </div>

        <div class="card egresos">
            <h4>Egresos</h4>
            <p id="totalEgresos">0 Bs</p>
        </div>

        <div class="card caja">
            <h4>Caja</h4>
            <p id="totalCaja">0 Bs</p>
        </div>

        <div class="card inventario">
            <h4>Inventario</h4>
            <p id="valorTotalInv">0 Bs</p>
        </div>
    </div>

    <!-- MOVIMIENTOS -->
    <div class="box">
        <h3>Movimientos</h3>
        <button class="btn" onclick="registrar('Ingreso')">+ Ingreso</button>
        <button class="btn" onclick="registrar('Egreso')" style="background:#1e293b">+ Egreso</button>

        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody id="listaMovs"></tbody>
        </table>
    </div>

    <!-- INVENTARIO -->
    <div class="box">
        <h3>Inventario</h3>
        <button class="btn" onclick="agregarProd()">+ Producto</button>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="tablaInv"></tbody>
        </table>
    </div>

</div>

<script>

let ing = 0;
let egr = 0;
let totalInv = 0;

// 📦 CARGAR PRODUCTOS DESDE BD
function cargarProductos() {
    fetch('/productos')
    .then(res => res.json())
    .then(data => {

        let tabla = document.getElementById("tablaInv");
        tabla.innerHTML = "";

        totalInv = 0;

        data.forEach(p => {
            let total = p.stock * p.precio;
            totalInv += total;

            tabla.innerHTML += `
                <tr>
                    <td>${p.nombre}</td>
                    <td>${p.stock}</td>
                    <td>${p.precio} Bs</td>
                    <td>${total} Bs</td>
                </tr>
            `;
        });

        document.getElementById("valorTotalInv").innerText = totalInv + " Bs";
    });
}

// 💰 INGRESOS / EGRESOS (BD)
function registrar(tipo) {
    let val = parseFloat(prompt("Monto:"));

    if (!isNaN(val)) {

        let url = tipo === "Ingreso" ? "/ingresos" : "/egresos";

        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ monto: val })
        })
        .then(res => res.json())
        .then(() => {
            alert(tipo + " guardado ✔️");
            location.reload();
        });
    }
}

// 📦 GUARDAR PRODUCTO
function agregarProd() {
    let n = prompt("Nombre:");
    let s = parseFloat(prompt("Stock:"));
    let p = parseFloat(prompt("Precio:"));

    fetch('/productos', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            nombre: n,
            stock: s,
            precio: p
        })
    })
    .then(res => res.json())
    .then(() => {
        alert("Producto guardado ✔️");
        cargarProductos();
    });
}

// 🚀 INICIALIZAR
cargarProductos();

</script>

</body>
</html>