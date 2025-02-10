import JustValidate from 'just-validate';
import { registerUser } from './register'
(function() {
    const validation = new JustValidate('#formData');
    validation
        .addField('#name', [
            {
                rule: 'required',
                errorMessage: 'El nombre es obligatorio'
            },
            {
                rule: 'minLength',
                value: 3,
                errorMessage: 'El nombre debe tener al menos 3 caracteres'
            }
        ])
        .addField('#email', [
            {
                rule: 'required',
                errorMessage: 'El correo electrónico es obligatorio'
            },
            {
                rule: 'email',
                errorMessage: 'Por favor, ingresa un correo válido'
            }
        ])
        .addField('#phone', [
            {
                rule: 'required',
                errorMessage: 'El teléfono es obligatorio'
            },
            {
                rule: 'minLength',
                value: 9,
                errorMessage: 'El teléfono debe tener al menos 9 dígitos'
            },
            {
                rule: 'maxLength',
                value: 9,
                errorMessage: 'El teléfono no puede exceder los 9 dígitos'
            },
            {
                rule: 'custom',
                validator: (value) => /^\d+$/.test(value),
                errorMessage: 'El teléfono solo puede contener números'
            }
        ])
        .onSuccess((event) => {
            event.preventDefault(); 
            registerUser()
        })
})();
