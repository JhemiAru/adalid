<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Principal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f6f9;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            position: fixed;
            background: #1e293b;
            color: white;
            padding: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            padding: 10px;
        }

        .main {
            margin-left: 240px;
            padding: 20px;
        }

        .cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .card {
            flex: 1;
            min-width: 200px;
            padding: 20px;
            border-radius: 10px;
            color: white;
        }

        .ingresos { background: green; }
        .egresos { background: red; }
        .caja { background: blue; }
        .inventario { background: purple; }

        .tabla {
            margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        button {
            padding: 8px;
            margin: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Sistema</h2>
    <ul>
        <li>Dashboard</li>
        <li>Inventario</li>
    </ul>
</div>

<div class="main">
    <h2>Dashboard</h2>

    <!-- TARJETAS -->
    <div class="cards">
        <div class="card ingresos">
            <h3>Ingresos</h3>
            <p id="ingresos">0 Bs</p>
        </div>

        <div class="card egresos">
            <h3>Egresos</h3>
            <p id="egresos">0 Bs</p>
        </div>

        <div class="card caja">
            <h3>Caja</h3>
            <p id="caja">0 Bs</p>
        </div>

        <div class="card inventario">
            <h3>Inventario Total</h3>
            <p id="valorInventario">0 Bs</p>
        </div>
    </div>

    <!-- MOVIMIENTOS -->
    <div class="tabla">
        <h3>Movimientos</h3>
        <button onclick="agregarIngreso()">Ingreso</button>
        <button onclick="agregarEgreso()">Egreso</button>

        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Monto</th>
                </tr>
            </thead>
            <tbody id="movimientos"></tbody>
        </table>
    </div>

    <!-- INVENTARIO -->
    <div class="tabla">
        <h3>Inventario</h3>
        <button onclick="agregarProducto()">Agregar Producto</button>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="inventarioTabla"></tbody>
        </table>
    </div>

</div>

<script>
    let ingresos = 0;
    let egresos = 0;
    let inventario = [];

    function actualizar() {
        document.getElementById("ingresos").innerText = ingresos + " Bs";
        document.getElementById("egresos").innerText = egresos + " Bs";
        document.getElementById("caja").innerText = (ingresos - egresos) + " Bs";

        let totalInventario = 0;
        inventario.forEach(p => {
            totalInventario += p.stock * p.precio;
        });

        document.getElementById("valorInventario").innerText = totalInventario + " Bs";
    }

    function agregarIngreso() {
        let monto = parseFloat(prompt("Monto ingreso:"));
        if (!isNaN(monto)) {
            ingresos += monto;
            document.getElementById("movimientos").innerHTML += 
                `<tr><td>Ingreso</td><td>${monto} Bs</td></tr>`;
            actualizar();
        }
    }

    function agregarEgreso() {
        let monto = parseFloat(prompt("Monto egreso:"));
        if (!isNaN(monto)) {
            egresos += monto;
            document.getElementById("movimientos").innerHTML += 
                `<tr><td>Egreso</td><td>${monto} Bs</td></tr>`;
            actualizar();
        }
    }

    function agregarProducto() {
        let nombre = prompt("Nombre del producto:");
        let stock = parseInt(prompt("Stock:"));
        let precio = parseFloat(prompt("Precio:"));

        if (nombre && !isNaN(stock) && !isNaN(precio)) {
            inventario.push({nombre, stock, precio});
            mostrarInventario();
            actualizar();
        }
    }

    function mostrarInventario() {
        let tabla = document.getElementById("inventarioTabla");
        tabla.innerHTML = "";

        inventario.forEach(p => {
            tabla.innerHTML += `
                <tr>
                    <td>${p.nombre}</td>
                    <td>${p.stock}</td>
                    <td>${p.precio} Bs</td>
                    <td>${p.stock * p.precio} Bs</td>
                </tr>
            `;
        });
    }
</script>

</body>
</html>