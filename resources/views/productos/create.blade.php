<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nuevo Producto</title>

<style>
body{
    font-family:Arial;
    background:#f1f5f9;
    padding:30px;
}

.form{
    max-width:450px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
}

h2{
    text-align:center;
    margin-bottom:20px;
    color:#0f172a;
}

input,
select{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:1px solid #cbd5e1;
    border-radius:8px;
    box-sizing:border-box;
}

input:focus,
select:focus{
    outline:none;
    border-color:#3b82f6;
}

button{
    width:100%;
    background:#0f172a;
    color:white;
    padding:12px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    margin-top:10px;
}

button:hover{
    background:#1e293b;
}
</style>

</head>

<body>

<div class="form">

<h2>Agregar Producto</h2>

<form action="/productos" method="POST">
    @csrf

    <input type="text" name="codigo" placeholder="Código" required>

    <input type="text" name="nombre" placeholder="Nombre" required>

    <input type="text" name="descripcion" placeholder="Descripción">

    <input type="number" name="stock" placeholder="Stock" required min="0">

    <input type="number" name="precio" placeholder="Precio" required min="0" step="0.01">

    <input type="text" name="imagen" placeholder="Nombre imagen (ej: teclado.png)">

    <select name="categoria_id" required>
        <option value="">Seleccione categoría</option>
        @foreach($categorias as $cat)
            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
        @endforeach
    </select>

    <button type="submit">Guardar</button>

</form>

</div>

</body>
</html>