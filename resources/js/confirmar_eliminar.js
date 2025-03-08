import Swal from "sweetalert2";

window.confirmarEliminacion = function (event) {
    event.preventDefault(); // Evita el envío del formulario por defecto
    const form = event.target; // Obtiene el formulario que se intenta enviar

    Swal.fire({
        // Ya no necesitas importar Swal
        title: "¿Estás seguro?",
        text: "Esta acción no se puede deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            // Envía el formulario si el usuario confirma
            form.submit();
        }
    });
};
