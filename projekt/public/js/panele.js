document.addEventListener('DOMContentLoaded', function()
{
    // Zmienne do przechowywania elementów DOM

    const logo = document.getElementById("searchlogo");
    const search = document.getElementById("filtr");
    const filtrbtn = document.getElementById("filtrbtn");
    const panel = document.getElementById("filtrpanel");
    const usericon=document.querySelector(".usericon");
    const usermenu=document.getElementById("usermenu");

    // Obsługa kliknięcia w logo

    logo.addEventListener("click", (e) => {
        e.preventDefault();
        search.classList.toggle("active");
        search.focus();
    });

    // Przełączanie menu użytkownika

    usericon.addEventListener("click", () => {
        usermenu.classList.toggle("active");
    });

    // Ukrywanie paneli po kliknięciu poza nimi

    document.addEventListener("click", (e) => {
        if (!logo.contains(e.target) && !search.contains(e.target) && !filtrbtn.contains(e.target)) {
            search.classList.remove("active");
        }
    });

    document.addEventListener("click", (e) => {
        if (!filtrbtn.contains(e.target) && !panel.contains(e.target) && !logo.contains(e.target)) {
            panel.classList.remove("active");
        }
    });

    document.addEventListener("click", (e) => {
        if (!usericon.contains(e.target) && !usermenu.contains(e.target)) {
            usermenu.classList.remove("active");
        }
    });

    // Przełączanie panelu filtrów

    function PanelActivation()
    {
        if (panel.classList.contains("active"))
        {
            panel.classList.remove("active");
        }
        else
        {
            panel.classList.add("active");
        }
    }
    
    // Obsługa kliknięcia w przycisk i ikonę filtra

    filtrbtn.addEventListener("click", PanelActivation);

});