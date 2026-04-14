<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Dashboard Moderno</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background: #f4f6f9;
        color: #1e293b;
    }

    /* SIDEBAR */
    .sidebar {
        width: 220px;
        height: 100vh;
        position: fixed;
        background: white;
        padding: 20px;
        border-right: 1px solid #ddd;
    }

    .sidebar h2 {
        margin-bottom: 20px;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar li {
        padding: 12px;
        margin: 5px 0;
        border-radius: 8px;
        cursor: pointer;
    }

    .sidebar li:hover {
        background: #e2e8f0;
    }

    .active {
        background: #2563eb;
        color: white;
    }

    /* MAIN */
    .main {
        margin-left: 240px;
        padding: 20px;
    }

    /* CARDS */
    .cards {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .card {
        flex: 1;
        min-width: 180px;
        padding: 20px;
        border-radius: 12px;
        color: white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .ingresos { background: linear-gradient(135deg, #06b6d4, #3b82f6); }
    .egresos { background: linear-gradient(135deg, #0ea5e9, #0284c7); }
    .caja { background: linear-gradient(135deg, #38bdf8, #2563eb); }
    .inventario { background: linear-gradient(135deg, #60a5fa, #1d4ed8); }

    /* CAJAS */
    .box {
        margin-top: 20px;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }

    /* TABLAS */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background: #f1f5f9;
    }

    th, td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: center;
    }

    /* BOTONES */
    button {
        padding: 8px 12px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        margin: 5px;
        background: #2563eb;
        color: white;
    }

    button:hover {
        background: #1d4ed8;
    }

    /* GRID */
    .grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-top: 20px;
    }

    /* CALENDARIO */
    .calendar {
        text-align: center;
        padding: 20px;
        background: white;
        border-radius: 12px;
        margin-top: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }

</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Sistema</h2>
    <ul>
        <li class="active">Tablero</li>
        <li>Perfil</li>
        <li>Inventario</li>
        <li>Mensajes</li>
        <li>Configuración</li>
    </ul>
</div>

<!-- MAIN -->
<div class="main">
    <h2>Resumen Financiero y Operativo</h2>

    <!-- CARDS -->
    <div class="cards">
        <div class="card ingresos">
            <h4>Ingresos</h4>
            <p id="ingresos">0 Bs</p>
        </div>

        <div class="card egresos">
            <h4>Egresos</h4>
            <p id="egresos">0 Bs</p>
        </div>

        <div class="card caja">
            <h4>Caja</h4>
            <p id="caja">0 Bs</p>
        </div>

        <div class="card inventario">
            <h4>Inventario</h4>
            <p id="valorInventario">0 Bs</p>
        </div>
    </div>

    <!-- GRÁFICAS -->
    <div class="grid">
        <div class="box">
            <canvas id="grafica"></canvas>
        </div>

        <div class="box">
            <canvas id="donut"></canvas>
        </div>
    </div>

    <!-- CALENDARIO -->
    <div class="calendar">
        <h3>Enero 2025</h3>
        <p>📅 Día seleccionado: 7</p>
    </div>

    <!-- MOVIMIENTOS -->
    <div class="box">
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
    <div class="box">
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
    let nombre = prompt("Nombre:");
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

/* GRÁFICA */
new Chart(document.getElementById("grafica"), {
    type: 'line',
    data: {
        labels: ['Ene','Feb','Mar','Abr','May','Jun'],
        datasets: [{
            label: 'Ventas',
            data: [10,40,30,60,50,80],
            borderColor: '#3b82f6',
            fill: true
        }]
    }
});

/* DONUT */
new Chart(document.getElementById("donut"), {
    type: 'doughnut',
    data: {
        labels: ['A','B','C'],
        datasets: [{
            data: [30,50,20]
        }]
    }
});
</script>

</body>
</html>