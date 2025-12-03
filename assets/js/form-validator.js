document.addEventListener('DOMContentLoaded', () => {
    const registerForm = document.getElementById('registerForm');
    const loginForm = document.getElementById('loginForm');

    if (registerForm) validarRegistro(registerForm);
    if (loginForm) validarLogin(loginForm);
});

function validarRegistro(form) {
    const errorBox = document.getElementById('msg-error');
    const username = form.querySelector("input[name='username']");
    const email = form.querySelector("input[name='email']");
    const password = form.querySelector("input[name='password']");

    const userReg = /^.{3,}$/;
    const emailReg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const passReg = /^.{6,}$/;

    form.addEventListener('submit', (e) => {
        let errores = [];

        limpiarErrores([username, email, password]);

        if (!userReg.test(username.value.trim())) {
            errores.push('Usuario mínimo 3 caracteres');
            marcarError(username);
        }
        if (!emailReg.test(email.value.trim())) {
            errores.push('Email no válido');
            marcarError(email);
        }
        if (!passReg.test(password.value.trim())) {
            errores.push('Contraseña mínimo 6 caracteres');
            marcarError(password);
        }

        if (errores.length > 0) {
            e.preventDefault();
            mostrarErrores(errorBox, errores);
        }
    });
}

function validarLogin(form) {
    const errorBox = document.getElementById('msg-error');
    const username = form.querySelector("input[name='username']");
    const password = form.querySelector("input[name='password']");

    const nonEmpty = /^.+$/;

    form.addEventListener('submit', (e) => {
        limpiarErrores([username, password]);
        let errores = [];

        if (!nonEmpty.test(username.value.trim())) {
            errores.push('Usuario requerido');
            marcarError(username);
        }

        if (!nonEmpty.test(password.value.trim())) {
            errores.push('Contraseña requerida');
            marcarError(password);
        }

        if (errores.length > 0) {
            e.preventDefault();
            mostrarErrores(errorBox, errores);
        }
    });
}

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
