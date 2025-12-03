<main class="main-content">
    <h1>Crear carta</h1>

<form action="?controller=card&action=store" method="POST">
    <label>Nombre:</label>
    <br>
    <input type="text" name="name" required>

    <br><br>

    <label>Ataque:</label>
    <br>
    <input type="number" name="attack" required>

    <br><br>   

    <label>Defensa:</label>
    <br>
    <input type="number" name="defense" required>

    <br><br>
    
    <label>Imagen:</label>
    <br>
    <input type="text" name="image" required>

    <br><br>
    
    <button type="submit">Crear carta</button>
</form>

<br>
<a href="?controller=card&action=list">Volver al listado</a>
</main>