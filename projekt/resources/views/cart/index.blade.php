<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Koszyk</title>
</head>
<body>

  <header>
    <h1>Koszyk</h1>
    <nav>
      <ul>
        <li><a href="#">Strona główna</a></li>
        <li><a href="koszyk.html">Koszyk</a></li>
        <li><a href="podsumowanie.html">Podsumowanie</a></li>
      </ul>
    </nav>
    <hr>
  </header>

  <main>

    <h2>Produkty w koszyku</h2>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Lp.</th>
          <th>Zdjęcie</th>
          <th>Nazwa produktu</th>
          <th>Cena jednostkowa</th>
          <th>Ilość</th>
          <th>Wartość</th>
          <th>Akcje</th>
        </tr>
      </thead>
      <tbody>

        <tr>
          <td>1</td>
          <td><img src="https://placehold.co/80x80?text=Produkt+1" alt="Produkt 1" width="80" height="80"></td>
          <td>
            <strong>Słuchawki bezprzewodowe Bluetooth</strong>
            <br>
            <small>Kolor: czarny | Rozmiar: uniwersalny</small>
          </td>
          <td>149,00 zł</td>
          <td>
            <button type="button">−</button>
            <input type="number" value="1" min="1" max="99" size="3">
            <button type="button">+</button>
          </td>
          <td><strong>149,00 zł</strong></td>
          <td><button type="button">Usuń</button></td>
        </tr>

        <tr>
          <td>2</td>
          <td><img src="https://placehold.co/80x80?text=Produkt+2" alt="Produkt 2" width="80" height="80"></td>
          <td>
            <strong>Koszulka bawełniana męska</strong>
            <br>
            <small>Kolor: biały | Rozmiar: L</small>
          </td>
          <td>59,99 zł</td>
          <td>
            <button type="button">−</button>
            <input type="number" value="2" min="1" max="99" size="3">
            <button type="button">+</button>
          </td>
          <td><strong>119,98 zł</strong></td>
          <td><button type="button">Usuń</button></td>
        </tr>

        <tr>
          <td>3</td>
          <td><img src="https://placehold.co/80x80?text=Produkt+3" alt="Produkt 3" width="80" height="80"></td>
          <td>
            <strong>Plecak sportowy 25L</strong>
            <br>
            <small>Kolor: granatowy</small>
          </td>
          <td>89,00 zł</td>
          <td>
            <button type="button">−</button>
            <input type="number" value="1" min="1" max="99" size="3">
            <button type="button">+</button>
          </td>
          <td><strong>89,00 zł</strong></td>
          <td><button type="button">Usuń</button></td>
        </tr>

        <tr>
          <td>4</td>
          <td><img src="https://placehold.co/80x80?text=Produkt+4" alt="Produkt 4" width="80" height="80"></td>
          <td>
            <strong>Kubek termiczny 450ml</strong>
            <br>
            <small>Kolor: srebrny</small>
          </td>
          <td>45,00 zł</td>
          <td>
            <button type="button">−</button>
            <input type="number" value="1" min="1" max="99" size="3">
            <button type="button">+</button>
          </td>
          <td><strong>45,00 zł</strong></td>
          <td><button type="button">Usuń</button></td>
        </tr>

      </tbody>
    </table>

    <br>

    <!-- Podsumowanie wartości koszyka -->
    <table border="1" cellpadding="8" cellspacing="0" align="right" width="350">
      <thead>
        <tr>
          <th colspan="2">Podsumowanie koszyka</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Liczba produktów:</td>
          <td align="right"><strong>5 szt.</strong></td>
        </tr>
        <tr>
          <td>Wartość produktów:</td>
          <td align="right">402,98 zł</td>
        </tr>
        <tr>
          <td>Przewidywana dostawa od:</td>
          <td align="right">12,99 zł</td>
        </tr>
        <tr>
          <td><strong>Razem do zapłaty:</strong></td>
          <td align="right"><strong>415,97 zł</strong></td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2" align="right">
            <a href="podsumowanie.html">
              <button type="button">Przejdź do podsumowania →</button>
            </a>
          </td>
        </tr>
      </tfoot>
    </table>

    <br clear="all">
    <br>

    <hr>

    <p>
      <a href="#">← Kontynuuj zakupy</a>
    </p>

  </main>

  <footer>
    <hr>
    <p>&copy; 2025 Sklep internetowy. Wszelkie prawa zastrzeżone.</p>
  </footer>

</body>
</html>
