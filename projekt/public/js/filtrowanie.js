document.addEventListener('DOMContentLoaded', function()
{
    // Zmienne do przechowywania elementów DOM

    const filtr = document.getElementById('searchinput');
    const lista = document.querySelectorAll('.card');
    const nazwa = document.querySelectorAll('.nazwa');
    const marka = document.getElementById('marka');
    const kat = document.getElementById('kat');
    const rodz = document.getElementById('rodz');
    const rozmiar = document.getElementById('rozmiar');
    const cena = document.querySelectorAll('.cena');
    const min = document.getElementById('min');
    const max = document.getElementById('max');
    const reset = document.getElementById('reset');

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
        const filtrujmarki = marka.value;
        const filtrujkat = kat.value;
        const filtrujrodz = rodz.value;
        const filtrujrozmiar = rozmiar.value;
        const minValue = min && min.value.trim() !== '' ? parseFloat(min.value) : null;
        const maxValue = max && max.value.trim() !== '' ? parseFloat(max.value) : null;

        lista.forEach(item =>
        {
            const text = item.textContent.toLowerCase();
            const priceEl = item.querySelector('.cena');
            let itemPrice = 0;
            if (priceEl) {
                const priceText = priceEl.textContent.replace(/[^0-9.,]/g, '').replace(',', '.');
                itemPrice = parseFloat(priceText) || 0;
            }

            const matchesBrand = !filtrujmarki || text.includes(filtrujmarki.toLowerCase());
            const matchesCategory = !filtrujkat || text.includes(filtrujkat.toLowerCase());
            const matchesType = !filtrujrodz || text.includes(filtrujrodz.toLowerCase());
            const matchesSize = !filtrujrozmiar || text.includes(filtrujrozmiar.toLowerCase());
            const matchesMinPrice = minValue === null || itemPrice >= minValue;
            const matchesMaxPrice = maxValue === null || itemPrice <= maxValue;

            const shouldShow = matchesBrand && matchesCategory && matchesType && matchesSize && matchesMinPrice && matchesMaxPrice;
            item.classList.toggle('hidden', !shouldShow);
        });
    }

     function resetFilters() {
            marka.value = '';
            kat.value = '';
            rodz.value = '';
            min.value = '';
            max.value = '';
            filtr.value = '';
            lista.forEach(item => item.classList.remove('hidden'));
        }

    // Nasłuchiwanie na zmianę w filtrach

    marka.addEventListener('input', filtrowanie);
    kat.addEventListener('input', filtrowanie);
    rodz.addEventListener('input', filtrowanie);
    rozmiar.addEventListener('input', filtrowanie);
    min.addEventListener('input', filtrowanie);
    max.addEventListener('input', filtrowanie);
    reset.addEventListener('click', resetFilters);
});