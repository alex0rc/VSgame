# Alexandru Dascalu, Sergi Casiano, Jordi Fornés

# VSGAME – Juego de Cartas

VSGAME es un juego de cartas por rondas desarrollado en **JavaScript (frontend)** y **PHP (backend/API)**.  
El jugador inicia sesión, registra su cuenta, comienza una partida y al finalizar puede guardar su puntuación.

Incluye:

-   Sistema de usuarios (login, registro, logout)
-   Inicio de partida mediante API
-   Guardado de puntuaciones
-   Carga de cartas desde servidor
-   HUD dinámico y combate por turnos

---

## 📌 Descripción

El juego funciona combinando un frontend en JavaScript y una API REST improvisada en PHP:

-   El usuario se registra o inicia sesión mediante `/api/login.php` y `/api/register.php`.
-   El backend genera sesión segura y devuelve JSON con el estado.
-   Cuando el jugador pulsa “Start Game”, el frontend llama a `/api/start_game.php`.
-   Al terminar el combate, la puntuación se envía a `/api/save_score.php`.

Toda la comunicación se realiza mediante **fetch()** y respuestas JSON.

---

## 📦 Requisitos

### Frontend

-   Navegador moderno con soporte ES6+
-   Servidor local (Live Server, XAMPP)

### Backend (API)

-   PHP 8+
-   Servidor con soporte para PHP (Apache, Nginx, XAMPP, WAMP…)
-   Base de datos MySQL/MariaDB

### Archivos backend necesarios:

api/
│── login.php
│── logout.php
│── register.php
│── save_score.php
│── start_game.php
└── assets/

---

## 🔧 Instalación

1. Clonar el proyecto:

```bash
git clone https://github.com/usuario/VSGAME.git
```

2. Mover la carpeta del proyecto a tu servidor PHP
3. Iniciar Apache/MySQL si usas XAMPP o WAMP.

4. Abrir el juego en el navegador:
   http://localhost/VSGAME/

5. Probar el backend visitando:
   http://localhost/VSGAME/api/login.php

6. Jugar normalmente desde el frontend.
