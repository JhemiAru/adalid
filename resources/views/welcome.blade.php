<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #e6f2f7; /* celeste suave */
    }

    .sidebar {
        width: 220px;
        height: 100vh;
        position: fixed;
        background: #0f172a; /* azul petróleo oscuro */
        color: white;
        padding: 20px;
    }

    .sidebar h2 {
        text-align: center;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar ul li {
        padding: 10px;
        cursor: pointer;
    }

    .sidebar ul li:hover {
        background: #1e3a5f; /* azul petróleo claro */
    }

    .main {
        margin-left: 240px;
        padding: 20px;
    }

    .header {
        background: white;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        color: #0f172a;
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

    .ingresos { background: #0ea5e9; } /* celeste fuerte */
    .egresos { background: #1e40af; } /* azul petróleo medio */
    .caja { background: #0f172a; } /* azul petróleo oscuro */

    .card h3 {
        margin: 0;
    }

    .card p {
        font-size: 22px;
        margin-top: 10px;
    }

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
        border-bottom: 1px solid #cbd5f5;
        text-align: center;
    }

    th {
        background: #bae6fd; /* celeste claro */
        color: #0f172a;
    }

    button {
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        background: #0284c7; /* azul celeste */
        color: white;
        cursor: pointer;
    }

    button:hover {
        background: #0369a1;
    }
</style>