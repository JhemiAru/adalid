<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nuevo Producto</title>

<style>
body {
    font-family: Arial;
    background: #f1f5f9;
    padding: 30px;
}

.form {
    max-width: 400px;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
}

input, select {
    width: 100%;
    padding: 8px;
    margin: 10px 0;
}

button {
    background: #0f172a;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 6px;
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

    <input type="number" name="stock" placeholder="Stock" required>

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