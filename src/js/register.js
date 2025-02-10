import Swal from 'sweetalert2';

export function registerUser() {
    const nombre = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const telefono = document.getElementById('phone').value;

    // Validar los datos (puedes agregar más validaciones según sea necesario)
    if (!nombre || !email || !telefono) {
        Swal.fire({
            title: 'Error',
            text: 'Por favor completa todos los campos',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return;
    }

    // Crear objeto con los datos del formulario
    const dataUser = {
        name: nombre,
        email: email,
        phone: telefono
    };

    // Enviar los datos al servidor
    sendRegistrationData(dataUser);
}

async function sendRegistrationData(dataUser) {
    try {
        const result = await fetch('/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(dataUser)
        });

        const response = await result.json();

        // Verificar si la respuesta es exitosa
        if (response.status === 'success') {
            Swal.fire({
                title: 'Registro Exitoso',
                text: response.data,
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                document.getElementById('formData').reset();
                window.location.reload();
            });
        } else {
            // Extraer mensajes de error si la respuesta es un error
            let errorMessage = 'Hubo un error en el registro.';
            
            // Si hay errores en `resultado.data.error`, concatenarlos
            if (response.data && response.data.error) {
                errorMessage = response.data.error.join('\n'); // Unir los errores en un solo string
            } else if (typeof response.data === 'string') {
                errorMessage = response.data;
            }

            Swal.fire({
                title: 'Error',
                text: errorMessage,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    } catch (error) {
        console.error('Error en la petición de registro:', error);
        Swal.fire({
            title: 'Error',
            text: 'Hubo un problema al registrar el usuario. Intenta nuevamente.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
}