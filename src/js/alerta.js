function eliminarTodasAlertas() {
    
    const alertas = document.querySelectorAll('.alerta');

    alertas.forEach(alerta => {
        alerta.remove();
    });

}

setTimeout(eliminarTodasAlertas, 6000);
