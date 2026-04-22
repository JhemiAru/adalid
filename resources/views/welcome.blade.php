<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pro - Inventario y Finanzas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        /* SIDEBAR FIJO */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: var(--bg-dark);
            color: white;
            padding: 20px;
            box-sizing: border-box;
            z-index: 100;
        }

        .sidebar h2 { color: white; margin-bottom: 30px; }
        .sidebar li {
            list-style: none;
            padding: 12px;
            margin: 8px 0;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }
        .sidebar li.active { background: var(--primary-blue); }
        .sidebar li:hover:not(.active) { background: #1e293b; }

        /* CONTENIDO PRINCIPAL CON SCROLL */
        .main {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 30px;
            min-height: 100vh;
        }

        /* TARJETAS DE MÉTRICAS */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .card { padding: 20px; border-radius: 12px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .ingresos { background: linear-gradient(135deg, #0891b2, #0e7490); }
        .egresos { background: linear-gradient(135deg, #1e3a8a, #1e40af); }
        .caja { background: linear-gradient(135deg, #3b82f6, #2563eb); }
        .inventario { background: linear-gradient(135deg, #60a5fa, #3b82f6); }
        .card h4 { margin: 0; font-size: 0.9rem; opacity: 0.8; }
        .card p { margin: 5px 0 0; font-size: 1.4rem; font-weight: bold; }

        /* BOXES Y GRID */
        .box { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .box-oscura { background: var(--card-bg) !important; color: white; }
        
        .grid-superior { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; }
        .grid-inferior { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        /* CALENDARIO */
        .calendar-table { width: 100%; border-collapse: collapse; text-align: center; }
        .calendar-table th { padding: 8px; color: #64748b; font-size: 0.8rem; }
        .calendar-table td { padding: 10px; cursor: pointer; border-radius: 8px; }
        .hoy { background: var(--primary-blue) !important; color: white; font-weight: bold; }

        /* TABLAS E INVENTARIO */
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { text-align: left; background: #f8fafc; padding: 12px; color: #64748b; font-size: 0.85rem; }
        td { padding: 12px; border-bottom: 1px solid #f1f5f9; }

        .btn {
            padding: 10px 15px; border: none; border-radius: 8px; cursor: pointer;
            background: var(--primary-blue); color: white; font-weight: 500; transition: 0.2s;
        }
        .btn:hover { opacity: 0.9; }

        /* DONA CENTRAL */
        .donut-wrapper { position: relative; height: 180px; margin: 10px 0; }
        .donut-center {
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -40%); text-align: center;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Sistema</h2>
        <ul>
            <li class="active">Tablero de control</li>
            <li>Perfil</li>
            <li>Carpetas</li>
            <li>Inventario</li>
            <li>Configuración</li>
            <li>Usuarios</li>
        </ul>
        <button class="btn" style="position:absolute; bottom:20px; width:80%;">CERRAR SESIÓN</button>
    </div>

    <div class="main">
        <div class="cards">
            <div class="card ingresos"><h4>Ingresos</h4><p id="totalIngresos">0 Bs</p></div>
            <div class="card egresos"><h4>Egresos</h4><p id="totalEgresos">0 Bs</p></div>
            <div class="card caja"><h4>Caja</h4><p id="totalCaja">0 Bs</p></div>
           <div class="card inventario"><h4>Inventario Total</h4><p id="valorTotalInv">0 Bs</p>
</div>
        </div>

        <div class="grid-superior">
            <div class="box">
                <h3>Movimientos Anuales</h3>
                <canvas id="lineChart" height="130"></canvas>
            </div>

            <div class="box box-oscura">
                <h3>Venta de Productos</h3>
                <div class="donut-wrapper">
                    <canvas id="donutChart"></canvas>
                    <div class="donut-center">
                        <small style="color:#aaa">Stock Total</small><br>
                        <strong id="donutStockCenter">0</strong>
                    </div>
                </div>
                <div style="font-size: 0.8rem;">
                    <p><span style="color:#2563eb">.</span> Cat A (EQUIPOS)</p>
                    <p><span style="color:#9ca3af">.</span> Cat B (ROPA)</p>
                    <p><span style="color:#4b5563">.</span> Cat C (ZAPATOS)</p>
                </div>
            </div>
        </div>

        <div class="grid-inferior">
            <div class="box">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                    <h3 id="mesAnio" style="margin:0"></h3>
                    <div>
                        <button class="btn" onclick="moverMes(-1)" style="padding:5px 10px"><</button>
                        <button class="btn" onclick="moverMes(1)" style="padding:5px 10px">>S</button>
                    </div>
                </div>
                <table class="calendar-table">
                    <thead><tr><th>Dom</th><th>Lun</th><th>Mar</th><th>Mié</th><th>Jue</th><th>Vie</th><th>Sáb</th></tr></thead>
                    <tbody id="cuerpoCalendario"></tbody>
                </table>
            </div>

            <div class="box">
                <h3>Registro de Movimientos</h3>
                <button class="btn" onclick="registrar('Ingreso')">+ Ingreso</button>
                <button class="btn" onclick="registrar('Egreso')" style="background:#475569">+ Egreso</button>
                <table>
                    <thead><tr><th>Tipo</th><th>Monto</th></tr></thead>
                    <tbody id="listaMovs"></tbody>
                </table>
            </div>
        </div>

        <div class="box">
            <h3>Gestión de Inventario</h3>
            <button class="btn" onclick="agregarProd()">Agregar Producto Nuevo</button>
            <table>
                <thead>
                    <tr><th>Producto</th><th>Stock</th><th>Precio Unit.</th><th>Total</th></tr>
                </thead>
                <tbody id="tablaInv">
                   
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // --- CALENDARIO ---
        let f = new Date();
        function renderCal() {
            const y = f.getFullYear(), m = f.getMonth();
            document.getElementById("mesAnio").innerText = f.toLocaleString('es', { month: 'long', year: 'numeric' });
            const dMax = new Date(y, m + 1, 0).getDate(), dStart = new Date(y, m, 1).getDay();
            const cont = document.getElementById("cuerpoCalendario");
            cont.innerHTML = "";
            let row = document.createElement("tr");
            for(let i=0; i<dStart; i++) row.appendChild(document.createElement("td"));
            for(let d=1; d<=dMax; d++) {
                let c = document.createElement("td");
                c.innerText = d;
                if(d === new Date().getDate() && m === new Date().getMonth()) c.className = "hoy";
                row.appendChild(c);
                if((d + dStart) % 7 === 0) { cont.appendChild(row); row = document.createElement("tr"); }
            }
            cont.appendChild(row);
        }
        function moverMes(n) { f.setMonth(f.getMonth() + n); renderCal(); }
        renderCal();

        // --- FUNCIONES DASHBOARD ---
        function registrar(tipo) {
    let val = parseFloat(prompt("Monto del " + tipo + ":"));

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
            alert(tipo + " guardado ");
            location.reload();
        });
    }
}

       function agregarProd() {
    let n = prompt("Nombre del producto:");
    let s = parseFloat(prompt("Cantidad en Stock:"));
    let p = parseFloat(prompt("Precio Unitario (Bs):"));

    if(n && !isNaN(s) && !isNaN(p)) {

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
            alert("Producto guardado ✔");
            cargarProductos();
        });
    }
}

function cargarProductos() {
    fetch('/productos')
    .then(res => res.json())
    .then(data => {

        let tabla = document.getElementById("tablaInv");
        tabla.innerHTML = "";

        let totalInventario = 0;
        let unidadesTotales = 0;

        data.forEach(prod => {
            let total = prod.stock * prod.precio;

            totalInventario += total;
            unidadesTotales += parseInt(prod.stock);

            tabla.innerHTML += `
                <tr>
                    <td>${prod.nombre}</td>
                    <td>${prod.stock}</td>
                    <td>${prod.precio} Bs</td>
                    <td>${total} Bs</td>
                </tr>
            `;
        });

        document.getElementById("valorTotalInv").innerText = totalInventario + " Bs";
        document.getElementById("donutStockCenter").innerText = unidadesTotales;
    });
}

function cargarMovimientos() {
    fetch('/resumen')
    .then(res => res.json())
    .then(data => {
        document.getElementById("totalIngresos").innerText = data.ingresos + " Bs";
        document.getElementById("totalEgresos").innerText = data.egresos + " Bs";
        document.getElementById("totalCaja").innerText = data.caja + " Bs";
    });
}

        // --- GRÁFICAS ---
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
                datasets: [{
                    data: [42, 55, 48, 65, 52, 98, 78, 72, 65, 82, 60, 110],
                    borderColor: '#2563eb', tension: 0.4, fill: true, backgroundColor: 'rgba(37, 99, 235, 0.1)'
                }]
            },
            options: { plugins: { legend: { display: false } }, scales: { y: { min: 20 } } }
        });

        new Chart(document.getElementById('donutChart'), {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [70, 15, 15],
                    backgroundColor: ['#2563eb', '#9ca3af', '#4b5563'],
                    borderWidth: 0
                }]
            },
            options: { cutout: '82%', plugins: { legend: { display: false } }, maintainAspectRatio: false }
        });
     cargarProductos();
     cargarMovimientos();
    </script>
</body>
</html>