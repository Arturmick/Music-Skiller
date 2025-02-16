let pulsadoEjercicio = false;
let pulsadoNivel = false;
let pulsadoTonalidad = false;

document.addEventListener('DOMContentLoaded', () => {
    eventosClick();
    submitSignIn();
    submitLogin();
    //confirmLogin();
    checkLoginStatus();
});

function eventosClick() {
    const nivelDiv = document.getElementById('nivel');
    const ejercicios = document.querySelector('.ejercicios');
    const tonalidad = document.querySelector('.tonalidad');
    const controles = document.querySelector('.controles');
    const audio = document.getElementById("audioElement");
    const playButton = document.getElementById("play");

    if (nivelDiv) {
        nivelDiv.addEventListener('click', (event) => {
            if (event.target !== nivelDiv && event.target.tagName === 'DIV') {
                if (event.target.classList.contains('pulsado')) {
                    event.target.classList.remove('pulsado');
                    pulsadoNivel = false;
                } else {
                    const currentlyPulsado = nivelDiv.querySelector('.pulsado');
                    if (currentlyPulsado) {
                        currentlyPulsado.classList.remove('pulsado');
                        pulsadoNivel = false;
                    }
                    event.target.classList.add('pulsado');
                    pulsadoNivel = true;
                }
                identifyButtons();
            }
        });
    }

    if (ejercicios) {
        ejercicios.addEventListener('click', (event) => {
            if (event.target !== ejercicios && event.target.tagName === 'DIV') {
                if (event.target.classList.contains('pulsado')) {
                    event.target.classList.remove('pulsado');
                    pulsadoEjercicio = false;
                } else {
                    const currentlyPulsado = ejercicios.querySelector('.pulsado');
                    if (currentlyPulsado) {
                        currentlyPulsado.classList.remove('pulsado');
                        pulsadoEjercicio = false;
                    }
                    event.target.classList.add('pulsado');
                    pulsadoEjercicio = true;
                }
                identifyButtons();
            }
        });
    }
    if (tonalidad) {
        tonalidad.addEventListener('click', (event) => {
            if (event.target !== tonalidad && event.target.tagName === 'DIV') {
                if (event.target.classList.contains('pulsado')) {
                    event.target.classList.remove('pulsado');
                    pulsadoTonalidad = false;
                } else {
                    const currentlyPulsado = tonalidad.querySelector('.pulsado');
                    if (currentlyPulsado) {
                        currentlyPulsado.classList.remove('pulsado');
                        pulsadoTonalidad = false;
                    }
                    event.target.classList.add('pulsado');
                    pulsadoTonalidad = true;  
                }
                identifyButtonsTonalidad();
            }
        });
    }
    if (controles) {
        let audio = new Audio('../audios/Music Skiller Intervalos Avanzado 1.mp3'); 
        controles.addEventListener("click", () => {
            if (audio.paused) {
                playButton.innerHTML = '<img src="../imagenes/pausa.png" alt="Pause">';
                audio.play();
            } else {
                playButton.innerHTML = '<img src="../imagenes/jugar.png" alt="Play">';
                audio.pause();
                audio.currentTime = 0; 
            }
        });
    }

}
function submitSignIn() {
    const registroForm = document.getElementById('registroForm');

    if (registroForm) {
        registroForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            const mensajePass = document.getElementById("mensajeContraseña");
            if (mensajePass) {
                fetch("new_user.php", {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text()) // Get response as text
                .then(text => {
                    try {
                        return JSON.parse(text); // Try to parse JSON
                    } catch (error) {
                        console.error('Invalid JSON response:', text);
                        throw new Error('Invalid JSON response');
                    }
                })
                .then(data => {
                    if (data.status === 'success') {
                        //alert("Usuario registrado correctamente. Por favor, inicie sesión.");
                        window.location.href = 'registroCorrecto.php'; // Redirect                       
                    } else {
                        mensajePass.textContent = `${data.message}`;
                    }
                })
                .catch(error => {
                    mensajePass.textContent = "Error de conexión.";
                    console.error("Error en la petición:", error);
                });
            }
        });
    }
}

function submitLogin() {
    const registroForm = document.getElementById('loginForm');

    if (registroForm) {
        registroForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            const mensajeLogin = document.getElementById("mensajeLogin");
            if (mensajeLogin) {
                fetch("loginBack.php", {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json()) // Convertir la respuesta a JSON
                .then(data => {            
        
                    if (data.error) {
                        mensajeLogin.textContent = `${data.message}`;               
                    }else {
                        //mensajeLogin.textContent = `${data.message}`;
                        //alert(`${data.message}`);
                        window.location.href = 'loginCorrect.php'; // Redirect to index.html                        
                    }            
                })
                .catch(error => {
                    mensajeLogin.textContent = "Error de conexión";
                    console.error("Error en la petición:", error);
                });                
            }
        });
    }
}


function identifyButtonsTonalidad() {
    if (pulsadoTonalidad) {
        const tonalidadPulsado = document.querySelector('.tonalidad .pulsado');        
        
        if (tonalidadPulsado) {
            console.log(`Tonalidad pulsado: ${tonalidadPulsado.textContent}`); 
                if (tonalidadPulsado.textContent.includes('#')) {
                    tonalidadPulsado.textContent = tonalidadPulsado.textContent.replace('#', 'Sharp');
                }

            elegirTonalidad(tonalidadPulsado.textContent);
        }
    } else {
        console.log("No buttons are pressed");
    }
}

function identifyButtons() {
    if (pulsadoEjercicio && pulsadoNivel) {
        const nivelPulsado = document.querySelector('#nivel .pulsado');
        const ejercicioPulsado = document.querySelector('.ejercicios .pulsado');
        
        if (nivelPulsado && ejercicioPulsado) {
            console.log(`Nivel pulsado: ${nivelPulsado.textContent}`);
            console.log(`Ejercicio pulsado: ${ejercicioPulsado.textContent}`);            
            elegirEjercicio(nivelPulsado.textContent, ejercicioPulsado.textContent);
        }
    } else {
        console.log("No buttons are pressed");
    }
}

function elegirTonalidad(tonalidad) {

    console.log(tonalidad);
    fetch('elegirTonalidad.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            tonalidad: tonalidad
        })
    })
    .then(response => response.json())
    .then(data => {

        console.log("Respuesta del servidor:", data);

        if (data.error) {
            console.error(data.message);
            console.log(data);
        } else {
            const container = document.getElementById('partitura');
            console.log("Container:", container);
            if (container) {
                container.innerHTML = ''; 
                data.results.forEach(result => {

                    console.log("Imagen recibida:", result.imagenGrande);

                    const div = document.createElement('div');
                    const img = document.createElement('img');
                    img.src = result.imagenGrande; 
                    div.appendChild(img);
                    container.appendChild(div);
                });
                
            }
            console.log(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
function elegirEjercicio(nivel, ejercicio) {
    fetch('check_login.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('ejercicios');
            if (data.loggedIn) {
                fetch('elegirEjercicio.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        nivel: nivel,
                        ejercicio: ejercicio
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Respuesta del servidor:", data);
                    if (data.error) {
                        console.error(data.message);
                        console.log(data);
                    } else {
                        if (container) {
                            container.innerHTML = ''; // Clear previous results
                            data.results.forEach(result => {
                                console.log("Imagen recibida:", result.imagenPequena);
                                const div = document.createElement('div');
                                const img = document.createElement('img');
                                img.src = result.imagenPequena; // Assuming the result object has an imageUrl property
                                img.addEventListener('click', () => {
                                    console.log(`Imagen ${result.imagenPequena} clickeada`);
                                    window.location.href = `ejercicio.php?imagenGrande=${result.imagenGrande}&nivel=${nivel}&ejercicio=${ejercicio}`;
                                });
                                div.appendChild(img);
                                container.appendChild(div);
                            });
                        }
                        console.log(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            } else {
                fetch('elegirEjercicio.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        nivel: nivel,
                        ejercicio: ejercicio
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Respuesta del servidor:", data);
                    if (data.error) {
                        console.error(data.message);
                        console.log(data);
                    } else {
                        if (container) {
                            container.innerHTML = ''; // Clear previous results
                            if (data.results && data.results.length > 0) {
                                const result = data.results[0];
                                console.log("Imagen recibida:", result.imagenPequena);
                                const div = document.createElement('div');
                                const img = document.createElement('img');
                                img.src = result.imagenPequena; // Assuming the result object has an imageUrl property
                                img.addEventListener('click', () => {
                                    console.log(`Imagen ${result.imagenPequena} clickeada`);
                                    window.location.href = `ejercicio.php?imagenGrande=${result.imagenGrande}&nivel=${nivel}&ejercicio=${ejercicio}`;
                                });
                                div.appendChild(img);
                                container.appendChild(div);
                                console.log("entra");
                                if (data.results.length > 1) {
                                    const protector = document.createElement('div');
                                    protector.className = 'protector';
                                    protector.textContent = 'Log in para ver más ejercicios';
                                    container.appendChild(protector);
                                }
                            }
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        })
        .catch(error => {
            console.error('Error checking login status:', error);
        });
}

function confirmLogin() {
    fetch("login.php")
        .then(response => response.json()) // Convertir la respuesta a JSON
        .then(data => {
            if (data.error) {
                const mensajeLogin = document.getElementById("mensajeLogin");
                if (mensajeLogin) {
                    mensajeLogin.classList.remove("oculto");
                }
            }
        })
        .catch(error => {
            document.getElementById("mensajeLogin").textContent = "Error de conexión.";
            console.error("Error en la petición:", error);
        });
}

function confirmResgistro() {
        fetch('new_user.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text()) // Get response as text
            .then(text => {
                try {
                    return JSON.parse(text); // Try to parse JSON
                } catch (error) {
                    console.error('Invalid JSON response:', text);
                    throw new Error('Invalid JSON response');
                }
            })
            .then(data => {
                var textoDiv = document.getElementById('mensajeLogin');
                if (textoDiv) {
                    if (data.status === 'success') {
                        //textoDiv.textContent = data.message;
                        //window.location.href = 'index.html'; // Redirect to index.html
                    } else {
                        textoDiv.textContent = data.message;
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                var textoDiv = document.getElementById('mensajeContraseña');
                if (textoDiv) {
                    textoDiv.textContent = 'An error occurred. Please try again later.';
                }
            });
}

function checkLoginStatus() {
    const protector = document.querySelector('.protector');
    if (protector) {
        fetch('check_login.php')
            .then(response => response.json())
            .then(data => {
                if (data.loggedIn) {
                    protector.style.display = 'none';
                } else {
                    protector.style.display = 'flex';
                }
            })
            .catch(error => {
                console.error('Error checking login status:', error);
            });
    }
}