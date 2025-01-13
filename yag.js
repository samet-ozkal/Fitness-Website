document.addEventListener("DOMContentLoaded", function() {
    const ekipmanliBtn = document.getElementById("ekipmanli-btn");
    const ekipmansizBtn = document.getElementById("ekipmansiz-btn");
    const antrenmanlarContainer = document.getElementById("antrenmanlar-container");

    ekipmanliBtn.addEventListener("click", function() {
        // Ekipmanlı antrenmanları göster
        antrenmanlarContainer.innerHTML = "";
        antrenmanlarContainer.classList.remove("hidden");
        window.location.assign("yag.html");
    });

    ekipmansizBtn.addEventListener("click", function() {
        // Ekipmansız antrenmanları göster
        antrenmanlarContainer.innerHTML = "";
        antrenmanlarContainer.classList.remove("hidden");
        window.location.assign("yag2.html");

       
    });
});