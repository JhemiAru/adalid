<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Productos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f6f9;
        }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            height: 100vh;
            position: fixed;
            background: #0f172a;
            color: white;
            padding: 20px;
        }

        .sidebar h2 {
            font-size: 18px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            padding: 10px;
            cursor: pointer;
        }

        .sidebar li:hover {
            background: #1e293b;
        }

        /* MAIN */
        .main {
            margin-left: 240px;
            padding: 20px;
        }

        /* HEADER */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            background: #1e293b;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        /* CARD */
        .cards {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .card {
            flex: 1;
            padding: 15px;
            border-radius: 10px;
            color: white;
        }

        .blue { background: #2563eb; }
        .green { background: #16a34a; }
        .red { background: #dc2626; }

        /* TABLE */
        .table-container {
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
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #0f172a;
            color: white;
        }

        .acciones button {
            padding: 5px 8px;
            border: none;
            cursor: pointer;
        }

        .edit { background: orange; color: white; }
        .delete { background: red; color: white; }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>📦 SISTEMA</h2>
    <ul>
        <li>Dashboard</li>
        <li>Productos</li>
        <li>Inventario</li>
    </ul>
</div>

<!-- MAIN -->
<div class="main">

    <div class="header">
        <h2>Lista de Productos</h2>
        <button class="btn">+ Nuevo Producto</button>
    </div>

    <!-- CARDS RESUMEN -->
    <div class="cards">
        <div class="card blue">
            <h3>Total Productos</h3>
            <p>2</p>
        </div>

        <div class="card green">
            <h3>Stock Total</h3>
            <p>15</p>
        </div>

        <div class="card red">
            <h3>Valor Inventario</h3>
            <p>650 Bs</p>
        </div>
    </div>

    <!-- TABLA -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>1</td>
                    <td>Teclado</td>
                    <td>50 Bs</td>
                    <td>10</td>
                    <td>500 Bs</td>
                    <td class="acciones">
                        <button class="edit">Editar</button>
                        <button class="delete">Eliminar</button>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Mouse</td>
                    <td>30 Bs</td>
                    <td>5</td>
                    <td>150 Bs</td>
                    <td class="acciones">
                        <button class="edit">Editar</button>
                        <button class="delete">Eliminar</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</div>

</body>
</html>