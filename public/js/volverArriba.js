document.addEventListener("DOMContentLoaded", function () {
    let btnVolverArriba = document.getElementById("volverArriba");

    btnVolverArriba.addEventListener("click", function () {
        document.documentElement.scrollIntoView({ behavior: "smooth" });
    });
});
