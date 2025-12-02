document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('registerForm');
    const loginForm = document.getElementById('loginForm');

    if (registerForm) validarRegistro(registerForm);
    if (loginForm) validarLogin(loginForm);
});

/* 🚨 VALIDACIÓN REGISTRO (pixel retro) */
function validarRegistro(form) {
    const errorBox = document.getElementById('msg-error');
    const username = form.querySelector("input[name='username']");
    const email = form.querySelector("input[name='email']");
    const password = form.querySelector("input[name='password']");

    form.addEventListener('submit', (e) => {
        let errores = [];

        limpiarErrores([username, email, password]);

        if (username.value.trim().length < 3) {
            errores.push('Usuario mínimo 3 caracteres');
            marcarError(username);
        }
        if (!validarEmail(email.value.trim())) {
            errores.push('Email no válido');
            marcarError(email);
        }
        if (password.value.trim().length < 6) {
            errores.push('Contraseña mínimo 6 caracteres');
            marcarError(password);
        }

        if (errores.length > 0) {
            e.preventDefault();
            mostrarErrores(errorBox, errores);
        }
    });
}

/* 🔑 VALIDACIÓN LOGIN */
function validarLogin(form) {
    const errorBox = document.getElementById('msg-error');
    const username = form.querySelector("input[name='username']");
    const password = form.querySelector("input[name='password']");

    form.addEventListener('submit', (e) => {
        limpiarErrores([username, password]);
        if (username.value.trim() === '' || password.value.trim() === '') {
            e.preventDefault();
            mostrarErrores(errorBox, ['Debes completar todos los campos']);
            username.value.trim() === '' && marcarError(username);
            password.value.trim() === '' && marcarError(password);
        }
    });
}

/* 📌 Funciones comunes */
function mostrarErrores(box, errores) {
    box.style.display = 'block';
    box.innerHTML = errores.join('<br>');
}

function marcarError(input) {
    input.classList.add('input-error');
}

function limpiarErrores(inputs) {
    document.getElementById('msg-error').style.display = 'none';
    inputs.forEach((i) => i.classList.remove('input-error'));
}

function validarEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}
