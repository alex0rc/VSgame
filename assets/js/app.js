/* Lista de Tareas por Rol (ChekList)
FRONT-END (FE) - Lógica de Juego y Experiencia del Usuario
Arquitectura y Lógica
– Crear clase/objeto global.
– Implementar Lógica del Juego (JS): Generar mazo, comparación de valores,
gestión de rondas.
– Implementar el flujo de la partida (iniciar, jugar, fin de juego).
Autenticación
– Crear formulario de login (HTML + CSS)
– Crear formulario de registro (HTML + CSS)
– Validación de Datos Avanzada en Cliente (JS) (email, fortaleza de contraseña)
– Conectar formularios con API de login/registro
– Mostrar mensajes de error
– Gestionar visibilidad de formularios (login vs registro)
Interfaz del Juego
– Crear estructura HTML del tablero de juego
– Mostrar información del jugador (nombre, puntuación)
– Mostrar información de la máquina (puntuación)
– Mostrar carta actual del jugador (nombre, ataque, defensa)
– Mostrar carta de la máquina (nombre, ataque, defensa)
– Crear select oculto para elegir acción (ataque/defensa)
– Crear botón para enviar acción (ejecuta lógica local)
– Mostrar resultado de la ronda (ganador, valores comparados)
– Crear botón para siguiente ronda
– Mostrar historial de rondas jugadas
Comunicación con APIs (Persistencia)
– Hacer fetch a /api/login.php (POST)
– Hacer fetch a /api/register.php (POST)
– Hacer fetch a /api/check_login.php (GET)
– Hacer fetch a /api/start_game.php (GET) - Para obtener datos de cartas
– Hacer fetch a /api/save_score.php (POST) - Para guardar el resultado final
– Hacer fetch a /api/logout.php (POST)
Estilos y Diseño
– Crear CSS para formularios
– Crear CSS para interfaz del juego
– Crear CSS para cartas
– Hacer diseño responsive (mobile-friendly)

 */

// Clase base para la gestión del estado del juego
class GameState {
    constructor() {
        this.playerScore = 0;
        this.cpuScore = 0;
        this.round = 0;
        this.maxRounds = 5;
        this.cards = [];
    }

    // Método para inicializar el juego (se llenará en Sprint 4)
    startGame() {
        console.log('Iniciando juego...');
    }
}

const game = new GameState();
