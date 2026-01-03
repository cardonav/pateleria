// Validaciones del formulario
document.addEventListener('DOMContentLoaded', function() {
    const formularios = document.querySelectorAll('form');
    
    formularios.forEach(form => {
        form.addEventListener('submit', function(e) {
            const inputsCantidad = form.querySelectorAll('input[type="number"]');
            let totalPasteles = 0;
            
            inputsCantidad.forEach(input => {
                totalPasteles += parseInt(input.value) || 0;
            });
            
            if (totalPasteles === 0) {
                e.preventDefault();
                alert('Debe ingresar al menos un pastel para crear el pedido.');
            }
        });
    });
    
    // Cálculo automático del total (opcional)
    const calcularTotal = () => {
        const basico = parseInt(document.getElementById('pastel_basico')?.value) || 0;
        const mediano = parseInt(document.getElementById('pastel_mediano')?.value) || 0;
        const grande = parseInt(document.getElementById('pastel_grande')?.value) || 0;
        
        // Obtener precios desde variables globales definidas en la plantilla PHP (ej: <script>window.PRECIO_BASICO = 10;</script>)
        // o usar 0 como valor por defecto si no están disponibles.
        const precioBasico = Number(window.PRECIO_BASICO ?? 0);
        const precioMediano = Number(window.PRECIO_MEDIANO ?? 0);
        const precioGrande = Number(window.PRECIO_GRANDE ?? 0);
        
        const total = (basico * precioBasico) + (mediano * precioMediano) + (grande * precioGrande);
        
        const totalElement = document.getElementById('total-calculado');
        if (totalElement) {
            totalElement.textContent = '$' + total.toFixed(2);
        }
    };
    
    // Agregar eventos a los campos de cantidad
    const camposCantidad = document.querySelectorAll('input[type="number"]');
    camposCantidad.forEach(campo => {
        campo.addEventListener('input', calcularTotal);
    });
    
    // Ejecutar cálculo inicial
    calcularTotal();
});