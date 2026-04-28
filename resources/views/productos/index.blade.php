<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Catálogo Maestro</title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
*{box-sizing:border-box;margin:0;padding:0;}

:root{
    --bg:#f8fafc;
    --surface:#ffffff;
    --surface2:#f1f5f9;
    --border:#e2e8f0;
    --text:#0f172a;
    --muted:#64748b;
    --hint:#94a3b8;
    --dark:#0f172a;
    --dark2:#1e293b;
    --blue:#2563eb;
    --blue-bg:#eff6ff;
    --blue-text:#1d4ed8;
    --green:#16a34a;
    --green-bg:#f0fdf4;
    --green-text:#15803d;
    --amber-bg:#fffbeb;
    --amber-text:#b45309;
    --amber-border:#fcd34d;
    --red-bg:#fef2f2;
    --red-text:#dc2626;
    --red-border:#fca5a5;
    --radius:8px;
    --radius-lg:12px;
    --radius-xl:16px;
    --shadow:0 1px 3px rgba(0,0,0,.06),0 1px 2px rgba(0,0,0,.04);
    --shadow-md:0 4px 12px rgba(0,0,0,.08);
}

body{
    font-family:'DM Sans',sans-serif;
    background:var(--bg);
    color:var(--text);
    min-height:100vh;
    display:flex;
}

/* ── SIDEBAR ── */
.sidebar{
    width:240px;
    min-height:100vh;
    position:fixed;
    top:0;left:0;
    background:var(--dark);
    display:flex;
    flex-direction:column;
    padding:0;
    z-index:100;
}

.sidebar-brand{
    padding:24px 20px 20px;
    border-bottom:1px solid rgba(255,255,255,.07);
}

.sidebar-brand .label{
    font-size:10px;
    font-weight:600;
    letter-spacing:.1em;
    text-transform:uppercase;
    color:#475569;
    margin-bottom:4px;
}

.sidebar-brand .title{
    font-size:18px;
    font-weight:600;
    color:#ffffff;
}

.sidebar-nav{
    padding:16px 12px;
    flex:1;
    display:flex;
    flex-direction:column;
    gap:2px;
}

.nav-section-label{
    font-size:10px;
    font-weight:600;
    letter-spacing:.1em;
    text-transform:uppercase;
    color:#334155;
    padding:10px 8px 6px;
}

.nav-item{
    display:flex;
    align-items:center;
    gap:10px;
    padding:9px 10px;
    border-radius:var(--radius);
    color:#94a3b8;
    font-size:13.5px;
    font-weight:500;
    cursor:pointer;
    text-decoration:none;
    transition:background .15s,color .15s;
}

.nav-item:hover{background:rgba(255,255,255,.06);color:#e2e8f0;}

.nav-item.active{
    background:rgba(37,99,235,.18);
    color:#93c5fd;
}

.nav-icon{
    width:16px;height:16px;
    opacity:.7;
    flex-shrink:0;
}

.nav-item.active .nav-icon{opacity:1;}

/* ── MAIN ── */
.main{
    margin-left:240px;
    flex:1;
    padding:32px 28px;
    min-height:100vh;
}

/* ── TOPBAR ── */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:24px;
    gap:16px;
    flex-wrap:wrap;
}

.topbar-left h1{
    font-size:22px;
    font-weight:600;
    color:var(--text);
    letter-spacing:-.02em;
}

.topbar-left p{
    font-size:13px;
    color:var(--muted);
    margin-top:3px;
}

.btn-primary{
    background:var(--dark);
    color:#fff;
    border:none;
    padding:9px 18px;
    border-radius:var(--radius);
    font-size:13.5px;
    font-family:'DM Sans',sans-serif;
    font-weight:500;
    cursor:pointer;
    display:inline-flex;
    align-items:center;
    gap:7px;
    transition:background .15s,transform .1s;
    text-decoration:none;
}

.btn-primary:hover{background:var(--dark2);transform:translateY(-1px);}
.btn-primary:active{transform:scale(.98);}

/* ── MÉTRICAS ── */
.metrics{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:14px;
    margin-bottom:24px;
}

.metric{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:var(--radius-lg);
    padding:18px 20px;
    box-shadow:var(--shadow);
}

.metric-label{
    font-size:11px;
    font-weight:600;
    letter-spacing:.07em;
    text-transform:uppercase;
    color:var(--muted);
    margin-bottom:10px;
}

.metric-value{
    font-size:28px;
    font-weight:600;
    color:var(--text);
    letter-spacing:-.03em;
    line-height:1;
    margin-bottom:8px;
}

.badge{
    display:inline-flex;
    align-items:center;
    gap:4px;
    padding:3px 9px;
    border-radius:20px;
    font-size:11.5px;
    font-weight:500;
}

.badge-blue{background:var(--blue-bg);color:var(--blue-text);}
.badge-green{background:var(--green-bg);color:var(--green-text);}
.badge-amber{background:var(--amber-bg);color:var(--amber-text);}
.badge-red{background:var(--red-bg);color:var(--red-text);}

/* ── CONTADOR +/- ── */
.stock-counter{display:flex;align-items:center;gap:10px;margin-bottom:14px;}
.counter-btn{width:32px;height:32px;border-radius:var(--radius);border:1px solid var(--border);background:var(--surface);color:var(--text);font-size:20px;line-height:1;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .15s,border-color .15s;font-family:'DM Sans',sans-serif;font-weight:400;flex-shrink:0;}
.counter-btn:hover{background:var(--surface2);border-color:#94a3b8;}
.counter-btn.plus:hover{border-color:#86efac;background:var(--green-bg);color:var(--green-text);}
.counter-btn.minus:hover{border-color:var(--red-border);background:var(--red-bg);color:var(--red-text);}
.counter-display{font-size:20px;font-weight:600;color:var(--text);min-width:36px;text-align:center;font-family:'DM Mono',monospace;}

/* ── TABLA SECTION ── */
.section{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:var(--radius-xl);
    overflow:hidden;
    box-shadow:var(--shadow);
}

.section-header{
    padding:16px 20px;
    border-bottom:1px solid var(--border);
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:12px;
    flex-wrap:wrap;
}

.section-title{
    font-size:14.5px;
    font-weight:600;
    color:var(--text);
}

.filters{
    display:flex;
    gap:6px;
    flex-wrap:wrap;
    align-items:center;
}

.filter-btn{
    background:transparent;
    border:1px solid var(--border);
    color:var(--muted);
    padding:5px 14px;
    border-radius:20px;
    font-size:12.5px;
    font-family:'DM Sans',sans-serif;
    cursor:pointer;
    transition:all .15s;
    text-decoration:none;
    display:inline-block;
}

.filter-btn:hover{border-color:#94a3b8;color:var(--text);}
.filter-btn.active{background:var(--dark);color:#fff;border-color:var(--dark);}

/* ── TABLA ── */
.table-wrap{overflow-x:auto;}

table{width:100%;border-collapse:collapse;}

thead th{
    padding:11px 16px;
    text-align:left;
    font-size:11px;
    font-weight:600;
    letter-spacing:.07em;
    text-transform:uppercase;
    color:var(--muted);
    border-bottom:1px solid var(--border);
    white-space:nowrap;
}

th.th-center,td.td-center{text-align:center;}

tbody tr.fila-producto{
    cursor:pointer;
    transition:background .1s;
}

tbody tr.fila-producto:hover{background:var(--surface2);}
tbody tr.fila-producto.is-open{background:#f8fafc;}

td{
    padding:13px 16px;
    font-size:14px;
    color:var(--text);
    border-bottom:1px solid var(--border);
    vertical-align:middle;
}

td.td-id{
    font-family:'DM Mono',monospace;
    font-size:12px;
    color:var(--hint);
}

.product-cell{
    display:flex;
    align-items:center;
    gap:12px;
}

.product-thumb{
    width:40px;height:40px;
    border-radius:var(--radius);
    object-fit:cover;
    border:1px solid var(--border);
    background:var(--surface2);
    flex-shrink:0;
}

.product-name{
    font-weight:500;
    font-size:14px;
}

.stock-pill{
    display:inline-block;
    padding:3px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:500;
    white-space:nowrap;
}

.stock-ok{background:var(--green-bg);color:var(--green-text);}
.stock-low{background:var(--amber-bg);color:var(--amber-text);}
.stock-out{background:var(--red-bg);color:var(--red-text);}

.td-price{
    font-weight:600;
    font-family:'DM Mono',monospace;
    font-size:13.5px;
}

.chevron{
    display:inline-block;
    font-size:13px;
    color:var(--hint);
    transition:transform .2s ease;
    user-select:none;
}

.chevron.open{transform:rotate(90deg);}

/* ── DETALLE ── */
tr.fila-detalle td{padding:0;}

.detalle-panel{
    padding:22px 24px;
    background:#fafbfc;
    border-bottom:1px solid var(--border);
    animation:slideDown .18s ease;
}

@keyframes slideDown{
    from{opacity:0;transform:translateY(-6px);}
    to{opacity:1;transform:translateY(0);}
}

.detalle-inner{
    display:flex;
    gap:24px;
    align-items:flex-start;
    flex-wrap:wrap;
}

.detalle-img{
    width:100px;height:100px;
    border-radius:var(--radius-lg);
    object-fit:cover;
    border:1px solid var(--border);
    background:var(--surface);
    flex-shrink:0;
}

.detalle-body{flex:1;min-width:280px;}

.detalle-nombre{
    font-size:16px;
    font-weight:600;
    color:var(--text);
    margin-bottom:16px;
    letter-spacing:-.01em;
}

.detalle-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:16px;
    margin-bottom:16px;
}

.detalle-field label{
    display:block;
    font-size:10.5px;
    font-weight:600;
    letter-spacing:.07em;
    text-transform:uppercase;
    color:var(--muted);
    margin-bottom:5px;
}

.field-display{
    font-size:15px;
    font-weight:600;
    color:var(--text);
}

.field-input,
.field-select,
.field-textarea{
    width:100%;
    padding:7px 10px;
    border:1px solid var(--border);
    border-radius:var(--radius);
    font-size:14px;
    font-family:'DM Sans',sans-serif;
    background:var(--surface);
    color:var(--text);
    transition:border-color .15s;
    outline:none;
}

.field-input:focus,
.field-select:focus,
.field-textarea:focus{
    border-color:#93c5fd;
    box-shadow:0 0 0 3px rgba(37,99,235,.08);
}

.field-textarea{resize:vertical;}

.detalle-desc{margin-bottom:16px;}
.detalle-desc label{
    display:block;
    font-size:10.5px;
    font-weight:600;
    letter-spacing:.07em;
    text-transform:uppercase;
    color:var(--muted);
    margin-bottom:5px;
}

.desc-display{
    font-size:13.5px;
    color:var(--muted);
    line-height:1.6;
}

.detalle-acciones{
    display:flex;
    gap:8px;
    flex-wrap:wrap;
}

.btn-accion{
    padding:7px 15px;
    border-radius:var(--radius);
    font-size:13px;
    font-family:'DM Sans',sans-serif;
    font-weight:500;
    cursor:pointer;
    border:1px solid var(--border);
    background:var(--surface);
    color:var(--text);
    transition:all .15s;
}

.btn-accion:hover{background:var(--surface2);}

.btn-edit{
    border-color:#fbbf24;
    background:var(--amber-bg);
    color:var(--amber-text);
}

.btn-edit:hover{background:#fef3c7;}

.btn-save{
    border-color:#6ee7b7;
    background:var(--green-bg);
    color:var(--green-text);
}

.btn-save:hover{background:#dcfce7;}

.btn-delete{
    border-color:var(--red-border);
    background:var(--red-bg);
    color:var(--red-text);
}

.btn-delete:hover{background:#fee2e2;}

.btn-cancel{
    border-color:var(--border);
    background:var(--surface);
    color:var(--muted);
}

.btn-cancel:hover{color:var(--text);}

/* ── RESPONSIVE ── */
@media(max-width:768px){
    .sidebar{display:none;}
    .main{margin-left:0;padding:20px 16px;}
    .metrics{grid-template-columns:1fr 1fr;}
    .detalle-grid{grid-template-columns:1fr 1fr;}
}
</style>
</head>
<body>

<!-- ── SIDEBAR ── -->
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="label">Sistema</div>
        <div class="title">Inventario</div>
    </div>
    <nav class="sidebar-nav">
        <a href="/productos" class="nav-item active">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 3H8a2 2 0 00-2 2v2h12V5a2 2 0 00-2-2z"/></svg>
            Catálogo
        </a>
    </nav>
</div>

<!-- ── MAIN ── -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="topbar-left">
            <h1>Catálogo maestro</h1>
            <p>Gestiona tus productos, stock y precios</p>
        </div>
        <a href="/productos/create" class="btn-primary">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
            Nuevo producto
        </a>
    </div>

    <!-- MÉTRICAS -->
    <div class="metrics">
        <div class="metric">
            <div class="metric-label">Total productos</div>
            <div class="metric-value">{{ $productos->count() }}</div>
            <span class="badge badge-blue">en catálogo</span>
        </div>
        <div class="metric">
            <div class="metric-label">Stock total</div>
            <div class="metric-value">{{ number_format($productos->sum('stock')) }}</div>
            <span class="badge badge-green">unidades</span>
        </div>
        <div class="metric">
            <div class="metric-label">Poco stock</div>
            <div class="metric-value">{{ $productos->filter(fn($p) => $p->stock > 0 && $p->stock <= 10)->count() }}</div>
            <span class="badge badge-amber">≤ 10 unidades</span>
        </div>
        <div class="metric">
            <div class="metric-label">Sin stock</div>
            <div class="metric-value">{{ $productos->where('stock', 0)->count() }}</div>
            <span class="badge badge-red">sin unidades</span>
        </div>
    </div>

    <!-- TABLA -->
    <div class="section">

        <div class="section-header">
            <span class="section-title">Productos</span>
            <div class="filters">
                <a href="/productos" class="filter-btn {{ !request('categoria_id') ? 'active' : '' }}">Todos</a>
                @foreach($categorias as $cat)
                <a href="/productos?categoria_id={{ $cat->id }}" class="filter-btn {{ request('categoria_id') == $cat->id ? 'active' : '' }}">
                    {{ $cat->nombre }}
                </a>
                @endforeach
            </div>
        </div>

        <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:56px;" class="th-center">#</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th style="width:50px;"></th>
                </tr>
            </thead>
            <tbody>

            @foreach($productos as $producto)

            <!-- FILA PRINCIPAL -->
            <tr class="fila-producto" id="fila-{{ $producto->id }}"
                onclick="toggleDetalle({{ $producto->id }})">

                <td class="td-id td-center">{{ str_pad($producto->id, 3, '0', STR_PAD_LEFT) }}</td>

                <td>
                    <div class="product-cell">
                        <img class="product-thumb"
                             src="/imagenes/{{ $producto->imagen ?? 'default.png' }}"
                             alt="{{ $producto->nombre }}">
                        <span class="product-name">{{ $producto->nombre }}</span>
                    </div>
                </td>

                <td style="color:var(--muted);font-size:13.5px;">
                    {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                </td>

                <td>
                    @if($producto->stock == 0)
                        <span class="stock-pill stock-out">Sin stock</span>
                    @elseif($producto->stock < 10)
                        <span class="stock-pill stock-low">{{ $producto->stock }} uds</span>
                    @else
                        <span class="stock-pill stock-ok">{{ $producto->stock }} uds</span>
                    @endif
                </td>

                <td class="td-price">{{ number_format($producto->precio, 2) }} Bs</td>

                <td class="td-center">
                    <span class="chevron" id="chevron-{{ $producto->id }}">›</span>
                </td>
            </tr>

            <!-- FILA DETALLE -->
            <tr class="fila-detalle" id="detalle-{{ $producto->id }}" style="display:none;">
                <td colspan="6">
                    <div class="detalle-panel">
                        <div class="detalle-inner">

                            <!-- Imagen -->
                            <img class="detalle-img"
                                 src="/imagenes/{{ $producto->imagen ?? 'default.png' }}"
                                 alt="{{ $producto->nombre }}">

                            <!-- Info -->
                            <div class="detalle-body">

                                <div class="detalle-nombre">{{ $producto->nombre }}</div>

                                <form action="/productos/{{ $producto->id }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Campos -->
                                <div class="detalle-grid">

                                    <div class="detalle-field">
                                        <label>Stock</label>
                                        <div class="field-display" id="text-stock-{{ $producto->id }}">
                                            {{ $producto->stock }} uds
                                        </div>
                                        <input class="field-input"
                                               type="number" name="stock" min="0"
                                               value="{{ $producto->stock }}"
                                               id="input-stock-{{ $producto->id }}"
                                               style="display:none;">
                                    </div>

                                    <div class="detalle-field">
                                        <label>Precio</label>
                                        <div class="field-display" id="text-precio-{{ $producto->id }}">
                                            {{ number_format($producto->precio, 2) }} Bs
                                        </div>
                                        <input class="field-input"
                                               type="number" name="precio" min="0" step="0.01"
                                               value="{{ $producto->precio }}"
                                               id="input-precio-{{ $producto->id }}"
                                               style="display:none;">
                                    </div>

                                    <div class="detalle-field">
                                        <label>Categoría</label>
                                        <div class="field-display" id="text-cat-{{ $producto->id }}">
                                            {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                                        </div>
                                        <select class="field-select"
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

                                <!-- Descripción -->
                                <div class="detalle-desc">
                                    <label>Descripción</label>
                                    <div class="desc-display" id="text-desc-{{ $producto->id }}">
                                        {{ $producto->descripcion ?? '—' }}
                                    </div>
                                    <textarea class="field-textarea"
                                              name="descripcion" rows="3"
                                              id="input-desc-{{ $producto->id }}"
                                              style="display:none;">{{ $producto->descripcion }}</textarea>
                                </div>

                                <!-- Contador rápido de stock -->
                                <div class="stock-counter" id="contador-{{ $producto->id }}">
                                    <button type="button" class="counter-btn minus"
                                            onclick="cambiarStock({{ $producto->id }}, -1)">−</button>
                                    <span class="counter-display" id="contador-val-{{ $producto->id }}">{{ $producto->stock }}</span>
                                    <button type="button" class="counter-btn plus"
                                            onclick="cambiarStock({{ $producto->id }}, 1)">+</button>
                                    <form action="/productos/{{ $producto->id }}" method="POST"
                                          id="form-contador-{{ $producto->id }}" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="stock" id="hidden-stock-{{ $producto->id }}" value="{{ $producto->stock }}">
                                        <input type="hidden" name="precio" value="{{ $producto->precio }}">
                                        <input type="hidden" name="categoria_id" value="{{ $producto->categoria_id }}">
                                        <input type="hidden" name="descripcion" value="{{ $producto->descripcion }}">
                                        <button type="submit" class="btn-accion btn-save" style="padding:6px 12px;font-size:12px;">
                                            Aplicar
                                        </button>
                                    </form>
                                </div>

                                <!-- Acciones -->
                                <div class="detalle-acciones">

                                    <button type="button"
                                            class="btn-accion btn-edit"
                                            id="btn-editar-{{ $producto->id }}"
                                            onclick="activarEdicion({{ $producto->id }})">
                                        Editar
                                    </button>

                                    <button type="submit"
                                            class="btn-accion btn-save"
                                            id="btn-guardar-{{ $producto->id }}"
                                            style="display:none;">
                                        Guardar cambios
                                    </button>

                                    <button type="button"
                                            class="btn-accion btn-cancel"
                                            id="btn-cancelar-{{ $producto->id }}"
                                            style="display:none;"
                                            onclick="cancelarEdicion({{ $producto->id }})">
                                        Cancelar
                                    </button>

                                </form>

                                <form action="/productos/{{ $producto->id }}" method="POST"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-accion btn-delete"
                                            id="btn-eliminar-{{ $producto->id }}">
                                        Eliminar
                                    </button>
                                </form>

                                    <button type="button"
                                            class="btn-accion"
                                            onclick="cerrarDetalle({{ $producto->id }})">
                                        Cerrar
                                    </button>

                                </div>

                            </div>
                        </div>
                    </div>
                </td>
            </tr>

            @endforeach
            </tbody>
        </table>
        </div>

    </div><!-- /section -->

</div><!-- /main -->

<script>
function cambiarStock(id, delta){
    const display = document.getElementById('contador-val-' + id);
    const hidden  = document.getElementById('hidden-stock-' + id);
    let val = parseInt(display.textContent) + delta;
    if(val < 0) val = 0;
    display.textContent = val;
    hidden.value = val;
}

function toggleDetalle(id){
    const detalle = document.getElementById('detalle-' + id);
    const fila    = document.getElementById('fila-' + id);
    const isOpen  = detalle.style.display !== 'none';

    // Cerrar todos los demás y restaurar sus filas
    document.querySelectorAll('.fila-detalle').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.fila-producto').forEach(el => {
        el.classList.remove('is-open');
        el.style.display = 'table-row';
    });

    if(!isOpen){
        detalle.style.display = 'table-row';
        fila.style.display = 'none'; // ocultar fila original
        fila.classList.add('is-open');
    }
}

function cerrarDetalle(id){
    document.getElementById('detalle-' + id).style.display = 'none';
    const fila = document.getElementById('fila-' + id);
    fila.style.display = 'table-row'; // restaurar fila original
    fila.classList.remove('is-open');
    cancelarEdicion(id);
}

function activarEdicion(id){
    ['stock','precio','cat','desc'].forEach(f => {
        document.getElementById('text-'  + f + '-' + id).style.display = 'none';
        document.getElementById('input-' + f + '-' + id).style.display = f === 'desc' ? 'block' : 'block';
    });
    document.getElementById('btn-editar-'   + id).style.display = 'none';
    document.getElementById('btn-eliminar-' + id).style.display = 'none';
    document.getElementById('btn-guardar-'  + id).style.display = 'inline-flex';
    document.getElementById('btn-cancelar-' + id).style.display = 'inline-flex';
}

function cancelarEdicion(id){
    ['stock','precio','cat','desc'].forEach(f => {
        document.getElementById('text-'  + f + '-' + id).style.display = 'block';
        document.getElementById('input-' + f + '-' + id).style.display = 'none';
    });
    document.getElementById('btn-editar-'   + id).style.display = 'inline-flex';
    document.getElementById('btn-eliminar-' + id).style.display = 'inline-flex';
    document.getElementById('btn-guardar-'  + id).style.display = 'none';
    document.getElementById('btn-cancelar-' + id).style.display = 'none';
}
</script>

</body>
</html>
