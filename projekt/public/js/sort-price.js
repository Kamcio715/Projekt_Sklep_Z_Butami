document.addEventListener('DOMContentLoaded', function() {
    const sortSelect = document.getElementById('sortPrice');
    const defaultOrder = Array.from(document.querySelectorAll('.lista li, .grid li')).map(li => li);
    let lista = document.querySelector('.lista');
    if (!lista) lista = document.querySelector('.grid');
    if (!sortSelect || !lista) return;

    function parsePriceFromText(text) {
        if (!text) return 0;
        // Remove non-numeric except dot and comma and minus
        const cleaned = text.replace(/\u00A0/g, ' ').replace(/[^0-9,.-]+/g, '').trim();
        if (!cleaned) return 0;
        const normalized = cleaned.replace(',', '.');
        const num = parseFloat(normalized);
        return isNaN(num) ? 0 : num;
    }

    function parsePrice(li) {
        const priceEl = li.querySelector('.cena');
        const text = priceEl ? priceEl.textContent : li.textContent;
        return parsePriceFromText(text);
    }

    let observer = null;

    function sortList(order) {
        if (!order) return;
        const items = Array.from(lista.querySelectorAll('li'));
        const visible = items.filter(i => !i.classList.contains('hidden'));
        const hidden = items.filter(i => i.classList.contains('hidden'));

        visible.sort((a, b) => {
            const pa = parsePrice(a);
            const pb = parsePrice(b);
            return order === 'asc' ? pa - pb : pb - pa;
        });

        // Prevent observer from reacting to our DOM changes
        if (observer) observer.disconnect();

        // Re-append in sorted order
        visible.forEach(i => lista.appendChild(i));
        hidden.forEach(i => lista.appendChild(i));

        // Reconnect observer after changes
        if (observer) observer.observe(lista, { childList: true, subtree: true, attributes: true, attributeFilter: ['class'] });
    }

    function currentOrder() {
        return sortSelect.value || '';
    }

    function Default() {
        defaultOrder.forEach(item => {
            if (lista.contains(item)) {
                lista.appendChild(item);
            }
        });
    }

    sortSelect.addEventListener('change', function() {
        const val = this.value;
        if (val === '') {
            Default();
            return;
        }
        sortList(val);
    });

    // Auto-resort when items or classes change (so sorting persists after filtering)
    observer = new MutationObserver(mutations => {
        const order = currentOrder();
        if (order) {
            // debounce a bit to coalesce rapid mutations
            if (observer._timer) clearTimeout(observer._timer);
            observer._timer = setTimeout(() => sortList(order), 50);
        }
    });

    observer.observe(lista, { childList: true, subtree: true, attributes: true, attributeFilter: ['class'] });
});
