document.addEventListener('DOMContentLoaded', function()
{
    // Zmienne do przechowywania elementów DOM

    const filtr = document.getElementById('szukajinput');
    const lista = document.querySelectorAll('.lista li');
    const nazwa = document.querySelectorAll('.nazwa');
    const marka = document.getElementById('marka');
    const kat = document.getElementById('kat');
    const rodz = document.getElementById('rodz');

    // Nasłuchiwanie na wpisywanie tekstu w filtrze

    filtr.addEventListener('input', function ()
    {
        const filtrujtekst = this.value.trim().toLowerCase();

        nazwa.forEach(item =>
        {
            const text = item.textContent.toLowerCase();
            const li = item.closest('li');  // Znajdź najbliższy element li
            li.classList.toggle('hidden', !text.includes(filtrujtekst));
        });
    });

    // Funkcja do filtrowania

    function filtrowanie()
    {
        const filtrujmarki = document.getElementById('marka').value;
        const filtrujkat = document.getElementById('kat').value;
        const filtrujrodz = document.getElementById('rodz').value;
        lista.forEach(item =>
        {
            const text = item.textContent;
            if(text.includes(filtrujmarki) && text.includes(filtrujkat) && text.includes(filtrujrodz))
            {
                item.classList.remove('hidden');
            }
            else
            {
                item.classList.add('hidden');
            }
        });
    }

    // Nasłuchiwanie na zmianę w filtrach

    marka.addEventListener('input', filtrowanie);
    kat.addEventListener('input', filtrowanie);
    rodz.addEventListener('input', filtrowanie);
    // rozmiar.addEventListener('input', filtrowanie);
});