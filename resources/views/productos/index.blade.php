<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Catálogo Maestro</title>

<style>
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:#f1f5f9;
}

/* SIDEBAR */
.sidebar{
    width:230px;
    height:100vh;
    position:fixed;
    background:#0f172a;
    color:white;
    padding:20px;
}

/* MAIN */
.main{
    margin-left:250px;
    padding:25px;
}

/* HEADER */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* BOTONES */
.btn{
    background:#0f172a;
    color:white;
    padding:8px 14px;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

.btn:hover{
    background:#1e293b;
}

/* FILTROS */
.filtros{
    margin-top:15px;
}

.filtros button{
    margin:4px;
}

/* CARDS */
.cards{
    display:flex;
    gap:15px;
    margin-top:20px;
}

.card{
    flex:1;
    padding:18px;
    border-radius:12px;
    color:white;
    font-weight:bold;
}

.blue{background:#3b82f6;}
.green{background:#22c55e;}
.red{background:#ef4444;}

/* TABLA */
.table-container{
    margin-top:25px;
    background:white;
    padding:20px;
    border-radius:15px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#0f172a;
    color:white;
    padding:12px;
}

td{
    padding:12px;
}

tr:hover{
    background:#f8fafc;
}

/* DETALLE */
.detalle-card{
    display:flex;
    gap:30px;
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    flex-wrap:wrap;
}

.detalle-img img{
    width:180px;
    border-radius:12px;
}

.detalle-info{
    flex:1;
}

/* FILAS */
.fila{
    display:flex;
    gap:30px;
    margin:10px 0;
}

.item{
    flex:1;
}

.item label{
    font-size:13px;
    color:#64748b;
}

.item span{
    display:block;
    font-weight:bold;
    font-size:16px;
    margin-top:4px;
}

.item input,
.item textarea,
.item select{
    width:100%;
    padding:8px;
    border-radius:6px;
    border:1px solid #cbd5e1;
    box-sizing:border-box;
}

/* ACCIONES */
.acciones{
    display:flex;
    gap:10px;
    margin-top:15px;
    flex-wrap:wrap;
}

.edit{
    background:orange;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:6px;
    cursor:pointer;
}

.delete{
    background:red;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:6px;
    cursor:pointer;
}

.cancel{
    background:gray;
    color:white;
    border:none;
    padding:8px 12px;
    border-radius:6px;
    cursor:pointer;
}

.edit:hover,
.delete:hover,
.cancel:hover{
    transform:scale(1.04);
}
</style>
</head>

<body>

<div class="sidebar">
    <h2>INVENTARIO</h2>
</div>

<div class="main">

<!-- HEADER -->
<div class="header">
    <h2>Catálogo Maestro</h2>

    <a href="/productos/create">
        <button class="btn">+ Nuevo</button>
    </a>
</div>

<!-- FILTROS -->
<div class="filtros">
<strong>Categorías:</strong>

<a href="/productos">
    <button class="btn">Todos</button>
</a>

@foreach($categorias as $cat)
<a href="/productos?categoria_id={{ $cat->id }}">
    <button class="btn">{{ $cat->nombre }}</button>
</a>
@endforeach
</div>

<!-- TARJETAS -->
<div class="cards">
    <div class="card blue">
        Total Productos: {{ $productos->count() }}
    </div>

    <div class="card green">
        Stock Total: {{ $productos->sum('stock') }}
    </div>

    <div class="card red">
        Inventario
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
<th>Precio</th>
<th>Ver</th>
</tr>
</thead>

<tbody>

@foreach($productos as $producto)

<!-- FILA PRODUCTO -->
<tr onclick="toggleDetalle({{ $producto->id }})" style="cursor:pointer;">
<td>{{ $producto->id }}</td>

<td>
<img src="/imagenes/{{ $producto->imagen ?? 'default.png' }}" width="50">
</td>

<td>{{ $producto->nombre }}</td>

<td>{{ $producto->stock }}</td>

<td>{{ number_format($producto->precio,2) }} Bs</td>

<td>👁</td>
</tr>

<!-- DETALLE -->
<tr id="detalle-{{ $producto->id }}" style="display:none;">
<td colspan="6">

<div class="detalle-card">

<div class="detalle-img">
    <img src="/imagenes/{{ $producto->imagen ?? 'default.png' }}">
</div>

<div class="detalle-info">

<h2>{{ $producto->nombre }}</h2>

<!-- FORM ACTUALIZAR -->
<form action="/productos/{{ $producto->id }}" method="POST">
@csrf
@method('PUT')

<div class="fila">

<div class="item">
<label>Stock</label>

<span id="text-stock-{{ $producto->id }}">
{{ $producto->stock }}
</span>

<input
type="number"
name="stock"
min="0"
value="{{ $producto->stock }}"
id="input-stock-{{ $producto->id }}"
style="display:none;">
</div>

<div class="item">
<label>Categoría</label>

<span id="text-cat-{{ $producto->id }}">
{{ $producto->categoria->nombre ?? 'Sin categoría' }}
</span>

<select
name="categoria_id"
id="input-cat-{{ $producto->id }}"
style="display:none;">

@foreach($categorias as $cat)
<option value="{{ $cat->id }}"
{{ $producto->categoria_id == $cat->id ? 'selected' : '' }}>
{{ $cat->nombre }}
</option>
@endforeach

</select>
</div>

</div>

<div class="fila">
<div class="item" style="flex:100%;">

<label>Descripción</label>

<span id="text-desc-{{ $producto->id }}">
{{ $producto->descripcion }}
</span>

<textarea
name="descripcion"
id="input-desc-{{ $producto->id }}"
style="display:none;">{{ $producto->descripcion }}</textarea>

</div>
</div>

<!-- BOTONES -->
<div class="acciones">

<button
type="button"
class="edit"
id="btn-editar-{{ $producto->id }}"
onclick="activarEdicion({{ $producto->id }})">
Editar
</button>

<button
type="submit"
class="edit"
id="btn-guardar-{{ $producto->id }}"
style="display:none;">
Actualizar
</button>

<button
type="button"
class="cancel"
id="btn-cancelar-{{ $producto->id }}"
style="display:none;"
onclick="cancelarEdicion({{ $producto->id }})">
Cancelar
</button>

</form>

<!-- FORM ELIMINAR -->
<form
action="/productos/{{ $producto->id }}"
method="POST"
onsubmit="return confirm('¿Eliminar producto?')">

@csrf
@method('DELETE')

<button
class="delete"
id="btn-eliminar-{{ $producto->id }}">
Eliminar
</button>

</form>

</div>

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
function toggleDetalle(id){

    let fila = document.getElementById('detalle-' + id);

    if(fila.style.display === 'none' || fila.style.display === ''){
        fila.style.display = 'table-row';
    }else{
        fila.style.display = 'none';
    }
}

function activarEdicion(id){

    document.getElementById('text-stock-' + id).style.display = 'none';
    document.getElementById('text-cat-' + id).style.display = 'none';
    document.getElementById('text-desc-' + id).style.display = 'none';

    document.getElementById('input-stock-' + id).style.display = 'block';
    document.getElementById('input-cat-' + id).style.display = 'block';
    document.getElementById('input-desc-' + id).style.display = 'block';

    document.getElementById('btn-editar-' + id).style.display = 'none';
    document.getElementById('btn-eliminar-' + id).style.display = 'none';

    document.getElementById('btn-guardar-' + id).style.display = 'inline-block';
    document.getElementById('btn-cancelar-' + id).style.display = 'inline-block';
}

function cancelarEdicion(id){

    document.getElementById('text-stock-' + id).style.display = 'block';
    document.getElementById('text-cat-' + id).style.display = 'block';
    document.getElementById('text-desc-' + id).style.display = 'block';

    document.getElementById('input-stock-' + id).style.display = 'none';
    document.getElementById('input-cat-' + id).style.display = 'none';
    document.getElementById('input-desc-' + id).style.display = 'none';

    document.getElementById('btn-editar-' + id).style.display = 'inline-block';
    document.getElementById('btn-eliminar-' + id).style.display = 'inline-block';

    document.getElementById('btn-guardar-' + id).style.display = 'none';
    document.getElementById('btn-cancelar-' + id).style.display = 'none';
}
</script>

</body>
</html>