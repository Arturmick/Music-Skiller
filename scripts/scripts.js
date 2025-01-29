document.addEventListener('DOMContentLoaded', () => {
    eventosClick();
    submitLogin();
});

function submitLogin() {

    const registroForm = document.getElementById('registroForm');

    if (registroForm) {
        registroForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            fetch('new_user.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    var textoDiv = document.getElementById('texto');
                    if (data.status === 'success') {
                        textoDiv.textContent = data.message;
                        window.location.href = 'index.html'; // Redirect to index.html
                    } else {
                        textoDiv.textContent = data.message;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    }
}

function eventosClick() {
    const nivelDiv = document.getElementById('nivel');
    const ejercicios = document.querySelector('.ejercicios');

    nivelDiv.addEventListener('click', (event) => {
        if (event.target !== nivelDiv && event.target.tagName === 'DIV') {
            if (event.target.classList.contains('pulsado')) {
                event.target.classList.remove('pulsado');
            } else {
                const currentlyPulsado = nivelDiv.querySelector('.pulsado');
                if (currentlyPulsado) {
                    currentlyPulsado.classList.remove('pulsado');
                }
                event.target.classList.add('pulsado');
            }
        }
    });

    ejercicios.addEventListener('click', (event) => {
        if (event.target !== ejercicios && event.target.tagName === 'DIV') {
            if (event.target.classList.contains('pulsado')) {
                event.target.classList.remove('pulsado');
            } else {
                const currentlyPulsado = ejercicios.querySelector('.pulsado');
                if (currentlyPulsado) {
                    currentlyPulsado.classList.remove('pulsado');
                }
                event.target.classList.add('pulsado');
            }
        }
    });
}