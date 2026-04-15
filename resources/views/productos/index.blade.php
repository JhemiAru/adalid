<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Catálogo Maestro</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #f1f5f9;
}

/* SIDEBAR */
.sidebar {
    width: 230px;
    height: 100vh;
    position: fixed;
    background: #020617;
    color: #e2e8f0;
    padding: 20px;
}

.sidebar h2 {
    font-size: 20px;
    margin-bottom: 20px;
}

.sidebar li {
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 5px;
    transition: 0.3s;
}

.sidebar li:hover {
    background: #1e293b;
}

/* MAIN */
.main {
    margin-left: 250px;
    padding: 25px;
}

/* HEADER */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* BOTONES */
.btn {
    background: #0f172a;
    color: white;
    padding: 8px 14px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: 0.3s;
}

.btn:hover {
    background: #1e293b;
}

/* FILTRO */
.filtros {
    margin-top: 20px;
}

.filtros button {
    margin: 4px;
}

/* CARDS */
.cards {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.card {
    flex: 1;
    padding: 18px;
    border-radius: 12px;
    color: white;
    font-weight: bold;
}

.blue { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.green { background: linear-gradient(135deg, #22c55e, #16a34a); }
.red { background: linear-gradient(135deg, #ef4444, #dc2626); }

/* TABLA */
.table-container {
    margin-top: 25px;
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0px 6px 15px rgba(0,0,0,0.08);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #0f172a;
    color: white;
    padding: 12px;
}

td {
    padding: 12px;
}

tr:hover {
    background: #f1f5f9;
}

/* IMÁGENES */
img {
    border-radius: 12px;
    transition: 0.3s;
}

img:hover {
    transform: scale(1.05);
}

/* BOTONES ACCIONES */
.edit {
    background: #f59e0b;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 6px;
}

.delete {
    background: #ef4444;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 6px;
}

/* DETALLE */
.detalle {
    display: flex;
    gap: 25px;
    padding: 20px;
}
</style>
</head>

<body>

<div class="sidebar">
    <h2>📦 INVENTARIO</h2>
    <ul>
        <li>Dashboard</li>
        <li>Productos</li>
        <li>Inventario</li>
    </ul>
</div>

<div class="main">

<div class="header">
    <h2>Catálogo Maestro</h2>

    <a href="/productos/create">
        <button class="btn">+ Nuevo</button>
    </a>
</div>

<!-- FILTRO -->
<div class="filtros">
    <strong>Categorías:</strong>

    <a href="/productos"><button class="btn">Todos</button></a>

    @foreach($categorias as $cat)
        <a href="/productos?categoria_id={{ $cat->id }}">
            <button class="btn">{{ $cat->nombre }}</button>
        </a>
    @endforeach
</div>

<!-- CARDS -->
<div class="cards">
    <div class="card blue">
        Total Productos <br>
        {{ $productos->count() }}
    </div>

    <div class="card green">
        Stock Total <br>
        {{ $productos->sum('stock') }}
    </div>

    <div class="card red">
        Inventario <br>
        --
    </div>
</div>

<!-- TABLA -->
<div class="table-container">
<table>

<thead>
<tr>
    <th>ID</th>
    <th>Imagen</th>
    <th>Producto</th>
    <th>Stock</th>
    <th>Ver</th>
</tr>
</thead>

<tbody>

@foreach($productos as $producto)

<tr onclick="toggleDetalle({{ $producto->id }})" style="cursor:pointer;">
    <td>{{ $producto->id }}</td>

    <td>
        <img src="/imagenes/{{ $producto->imagen ?? 'default.png' }}" width="55">
    </td>

    <td>{{ $producto->nombre }}</td>

    <td>{{ $producto->stock }}</td>

    <td>👁</td>
</tr>

<tr id="detalle-{{ $producto->id }}" style="display:none;">
<td colspan="5">

<div class="detalle">

<div>
    <img src="/imagenes/{{ $producto->imagen ?? 'default.png' }}" width="180">
</div>

<div>

<h3>{{ $producto->nombre }}</h3>

<p><strong>Descripción:</strong><br>
{{ $producto->descripcion }}</p>

<p><strong>Categoría:</strong> 
{{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>

<p><strong>Stock:</strong> {{ $producto->stock }}</p>

<br>

<a href="/productos/{{ $producto->id }}/edit">
    <button class="edit">Editar</button>
</a>

<form action="/productos/{{ $producto->id }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button class="delete">Eliminar</button>
</form>

</div>

</div>

</td>
</tr>

@endforeach

</tbody>
</table>
</div>

</div>

<script>
function toggleDetalle(id) {
    let fila = document.getElementById('detalle-' + id);

    fila.style.display = (fila.style.display === 'none') ? 'table-row' : 'none';
}
</script>

</body>
</html>