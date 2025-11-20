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
