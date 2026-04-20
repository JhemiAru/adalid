<form action="/productos/{{ $producto->id }}" method="POST">
    <h2>Editar Producto</h2>

<form action="/productos/{{ $producto->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>Código:</label>
    <input type="text" name="codigo" value="{{ $producto->codigo }}">

    <label>Nombre:</label>
    <input type="text" name="nombre" value="{{ $producto->nombre }}" placeholder="Ej: Teclado mecánico">

    <label>Descripción:</label>
    <textarea name="descripcion">{{ $producto->descripcion }}</textarea>

    <label>Stock:</label>
    <input type="number" name="stock" value="{{ $producto->stock }}">

    <label>Imagen actual:</label><br>
    <img src="/imagenes/{{ $producto->imagen ?? 'default.png' }}" width="100"><br>

    <label>Nombre de imagen:</label>
    <input type="text" name="imagen" value="{{ $producto->imagen }}">

    <label>Categoría:</label>
    <select name="categoria_id">
        @foreach($categorias as $cat)
            <option value="{{ $cat->id }}"
            {{ $producto->categoria_id == $cat->id ? 'selected' : '' }}>
                {{ $cat->nombre }}
            </option>
        @endforeach
    </select>

    <br><br>

    <button type="submit">Actualizar</button>

    <a href="/productos">
        <button type="button">Cancelar</button>
    </a>
</form>