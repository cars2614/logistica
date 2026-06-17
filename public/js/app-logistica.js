/**
 * LogisticaValidator — Helper centralizado de validación de inputs en frontend.
 *
 * Arquitectura: Utiliza 'keypress' para bloquear caracteres prohibidos en tiempo
 * real, y 'blur' para sanitizar texto pegado desde el portapapeles.
 * Esto evita el problema de salto de cursor que causa el enfoque agresivo con
 * replace en el evento 'input'.
 *
 * @see implementation_plan.md — Fase 3: Frontend JS Centralizado No Invasivo
 */
const LogisticaValidator = {

    /**
     * Solo letras (con tildes), espacios, puntos y apóstrofes.
     * Uso: Nombres de personas, ciudades, sectores, zonas.
     */
    initNameInput(selector) {
        const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s.']$/;
        const cleanRegex = /[^a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s.']/g;

        $(selector).on('keypress', function (e) {
            const char = String.fromCharCode(e.which);
            if (!regex.test(char)) {
                e.preventDefault();
            }
        }).on('blur', function () {
            this.value = this.value.replace(cleanRegex, '');
        });
    },

    /**
     * Solo dígitos enteros (0-9).
     * Uso: Cédulas, teléfonos, códigos postales, cantidades.
     */
    initIntegerInput(selector) {
        $(selector).on('keypress', function (e) {
            if (e.which < 48 || e.which > 57) {
                e.preventDefault();
            }
        }).on('blur', function () {
            this.value = this.value.replace(/\D/g, '');
        });
    },

    /**
     * Números de punto flotante (un solo punto decimal).
     * Uso: Pesos (kg), valores monetarios.
     */
    initFloatInput(selector) {
        $(selector).on('keypress', function (e) {
            const charCode = e.which;
            const currentValue = $(this).val();

            // Permitir dígitos
            if (charCode >= 48 && charCode <= 57) return true;

            // Permitir un solo punto decimal (si hay al menos un dígito antes)
            if (charCode === 46) {
                if (currentValue.indexOf('.') === -1 && currentValue.length > 0) {
                    return true;
                }
            }

            e.preventDefault();
        }).on('blur', function () {
            this.value = this.value.replace(/[^0-9.]/g, '');
            var parts = this.value.split('.');
            if (parts.length > 2) {
                this.value = parts[0] + '.' + parts.slice(1).join('');
            }
        });
    },

    /**
     * Placas vehiculares: letras, números y guiones. Fuerza mayúsculas en blur.
     * Uso: Campo de placa vehicular.
     */
    initPlateInput(selector) {
        $(selector).on('keypress', function (e) {
            var char = String.fromCharCode(e.which);
            if (!/^[A-Za-z0-9\-]$/.test(char)) {
                e.preventDefault();
            }
        }).on('blur', function () {
            this.value = this.value.toUpperCase().replace(/[^A-Z0-9\-]/g, '');
        });
    },

    /**
     * Alfanumérico estándar con tildes, espacios y guiones.
     * Uso: Marcas, modelos, tipos de vehículo, roles.
     */
    initAlphanumericInput(selector) {
        var regex = /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ\s\-]$/;
        var cleanRegex = /[^a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ\s\-]/g;

        $(selector).on('keypress', function (e) {
            var char = String.fromCharCode(e.which);
            if (!regex.test(char)) {
                e.preventDefault();
            }
        }).on('blur', function () {
            this.value = this.value.replace(cleanRegex, '');
        });
    },

    /**
     * Direcciones: letras, números, tildes, espacios, #, -, ., /, coma.
     * Uso: Campos de dirección.
     */
    initAddressInput(selector) {
        var regex = /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ\s#\-\.\/,]$/;
        var cleanRegex = /[^a-zA-Z0-9áéíóúÁÉÍÓÚñÑüÜ\s#\-\.\/,]/g;

        $(selector).on('keypress', function (e) {
            var char = String.fromCharCode(e.which);
            if (!regex.test(char)) {
                e.preventDefault();
            }
        }).on('blur', function () {
            this.value = this.value.replace(cleanRegex, '');
        });
    },

    /**
     * Código de guía: letras, números, guiones y guiones bajos.
     * Uso: Identificadores de guía en rutas.
     */
    initCodeInput(selector) {
        var regex = /^[a-zA-Z0-9\-_]$/;
        var cleanRegex = /[^a-zA-Z0-9\-_]/g;

        $(selector).on('keypress', function (e) {
            var char = String.fromCharCode(e.which);
            if (!regex.test(char)) {
                e.preventDefault();
            }
        }).on('blur', function () {
            this.value = this.value.replace(cleanRegex, '');
        });
    }
};
