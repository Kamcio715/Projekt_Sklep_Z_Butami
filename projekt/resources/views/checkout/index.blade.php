<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Podsumowanie zamówienia</title>
</head>
<body>

  <header>
    <h1>Podsumowanie zamówienia</h1>
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
    <table width="100%" cellpadding="0" cellspacing="0">
      <tr>

        <!-- ===================== LEWA KOLUMNA — FORMULARZ ===================== -->
        <td valign="top" width="65%">

          <!-- ——— SEKCJA 1: DANE DO DOSTAWY ——— -->
          <form action="#" method="post">

            <fieldset>
              <legend><strong>1. Dane do dostawy</strong></legend>

              <table cellpadding="6" cellspacing="0" width="100%">
                <tr>
                  <td width="50%">
                    <label for="imie">Imię *</label><br>
                    <input type="text" id="imie" name="imie" placeholder="Jan" required size="30">
                  </td>
                  <td width="50%">
                    <label for="nazwisko">Nazwisko *</label><br>
                    <input type="text" id="nazwisko" name="nazwisko" placeholder="Kowalski" required size="30">
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <label for="email">Adres e-mail *</label><br>
                    <input type="email" id="email" name="email" placeholder="jan.kowalski@email.pl" required size="50">
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <label for="telefon">Numer telefonu *</label><br>
                    <input type="tel" id="telefon" name="telefon" placeholder="+48 123 456 789" required size="30">
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <label for="ulica">Ulica i numer domu / mieszkania *</label><br>
                    <input type="text" id="ulica" name="ulica" placeholder="ul. Przykładowa 12/4" required size="50">
                  </td>
                </tr>
                <tr>
                  <td width="50%">
                    <label for="kod_pocztowy">Kod pocztowy *</label><br>
                    <input type="text" id="kod_pocztowy" name="kod_pocztowy" placeholder="00-000" required size="10">
                  </td>
                  <td width="50%">
                    <label for="miasto">Miasto *</label><br>
                    <input type="text" id="miasto" name="miasto" placeholder="Warszawa" required size="30">
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <label for="kraj">Kraj</label><br>
                    <select id="kraj" name="kraj">
                      <option value="PL" selected>Polska</option>
                      <option value="DE">Niemcy</option>
                      <option value="CZ">Czechy</option>
                      <option value="SK">Słowacja</option>
                      <option value="LT">Litwa</option>
                      <option value="UA">Ukraina</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <label for="uwagi">Uwagi do zamówienia</label><br>
                    <textarea id="uwagi" name="uwagi" rows="3" cols="55" placeholder="Np. kod do domofonu, piętro..."></textarea>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <label>
                      <input type="checkbox" name="faktura" value="tak">
                      Chcę otrzymać fakturę VAT
                    </label>
                  </td>
                </tr>
              </table>

              <!-- Dane do faktury (widoczne gdy checkbox zaznaczony) -->
              <fieldset>
                <legend>Dane do faktury</legend>
                <table cellpadding="6" cellspacing="0" width="100%">
                  <tr>
                    <td>
                      <label for="nazwa_firmy">Nazwa firmy</label><br>
                      <input type="text" id="nazwa_firmy" name="nazwa_firmy" placeholder="Firma Sp. z o.o." size="50">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label for="nip">NIP</label><br>
                      <input type="text" id="nip" name="nip" placeholder="0000000000" size="20">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label for="adres_firmy">Adres firmy</label><br>
                      <input type="text" id="adres_firmy" name="adres_firmy" placeholder="ul. Firmowa 1, 00-000 Warszawa" size="50">
                    </td>
                  </tr>
                </table>
              </fieldset>
            </fieldset>

            <br>

            <!-- ——— SEKCJA 2: METODA DOSTAWY ——— -->
            <fieldset>
              <legend><strong>2. Metoda dostawy</strong></legend>

              <table cellpadding="8" cellspacing="0" width="100%">
                <tr>
                  <td>
                    <label>
                      <input type="radio" name="dostawa" value="kurier_dpd" checked>
                      <strong>Kurier DPD</strong> — 14,99 zł
                      <br>
                      <small>Przewidywana dostawa: 1–2 dni robocze</small>
                    </label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>
                      <input type="radio" name="dostawa" value="kurier_inpost">
                      <strong>Kurier InPost</strong> — 12,99 zł
                      <br>
                      <small>Przewidywana dostawa: 1–2 dni robocze</small>
                    </label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>
                      <input type="radio" name="dostawa" value="paczkomat">
                      <strong>Paczkomat InPost</strong> — 9,99 zł
                      <br>
                      <small>Przewidywana dostawa: 1–3 dni robocze</small>
                    </label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>
                      <input type="radio" name="dostawa" value="poczta">
                      <strong>Poczta Polska</strong> — 10,99 zł
                      <br>
                      <small>Przewidywana dostawa: 3–5 dni roboczych</small>
                    </label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>
                      <input type="radio" name="dostawa" value="odbior_osobisty">
                      <strong>Odbiór osobisty</strong> — 0,00 zł
                      <br>
                      <small>Punkt odbioru: ul. Sklepowa 5, Warszawa (pon–pt 9:00–17:00)</small>
                    </label>
                  </td>
                </tr>
              </table>

              <!-- Wybór paczkomatu (widoczne gdy wybrany paczkomat) -->
              <fieldset>
                <legend>Wybierz paczkomat</legend>
                <label for="paczkomat_id">Numer / adres paczkomatu:</label><br>
                <input type="text" id="paczkomat_id" name="paczkomat_id" placeholder="Np. WAW123M" size="30">
                <button type="button">Wybierz na mapie</button>
              </fieldset>
            </fieldset>

            <br>

            <!-- ——— SEKCJA 3: METODA PŁATNOŚCI ——— -->
            <fieldset>
              <legend><strong>3. Metoda płatności</strong></legend>

              <table cellpadding="8" cellspacing="0" width="100%">
                <tr>
                  <td>
                    <label>
                      <input type="radio" name="platnosc" value="blik" checked>
                      <strong>BLIK</strong>
                      <br>
                      <small>Szybka płatność kodem BLIK</small>
                    </label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>
                      <input type="radio" name="platnosc" value="karta">
                      <strong>Karta płatnicza</strong>
                      <br>
                      <small>Visa, Mastercard, Maestro</small>
                    </label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>
                      <input type="radio" name="platnosc" value="przelew_online">
                      <strong>Przelew online</strong>
                      <br>
                      <small>Szybki przelew przez Twój bank (Przelewy24)</small>
                    </label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>
                      <input type="radio" name="platnosc" value="przelew_tradycyjny">
                      <strong>Przelew tradycyjny</strong>
                      <br>
                      <small>Realizacja po zaksięgowaniu wpłaty (1–2 dni robocze)</small>
                    </label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>
                      <input type="radio" name="platnosc" value="za_pobraniem">
                      <strong>Za pobraniem</strong> — dodatkowe 5,00 zł
                      <br>
                      <small>Płatność przy odbiorze przesyłki</small>
                    </label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>
                      <input type="radio" name="platnosc" value="google_pay">
                      <strong>Google Pay</strong>
                    </label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>
                      <input type="radio" name="platnosc" value="apple_pay">
                      <strong>Apple Pay</strong>
                    </label>
                  </td>
                </tr>
              </table>

              <!-- Dane karty (widoczne gdy wybrana karta) -->
              <fieldset>
                <legend>Dane karty płatniczej</legend>
                <table cellpadding="6" cellspacing="0">
                  <tr>
                    <td>
                      <label for="numer_karty">Numer karty</label><br>
                      <input type="text" id="numer_karty" name="numer_karty" placeholder="0000 0000 0000 0000" size="25">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label for="waznosc_karty">Data ważności</label><br>
                      <input type="text" id="waznosc_karty" name="waznosc_karty" placeholder="MM/RR" size="8">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label for="cvv">CVV</label><br>
                      <input type="text" id="cvv" name="cvv" placeholder="000" size="5">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label for="imie_karty">Imię i nazwisko na karcie</label><br>
                      <input type="text" id="imie_karty" name="imie_karty" placeholder="Jan Kowalski" size="30">
                    </td>
                  </tr>
                </table>
              </fieldset>

              <!-- Kod BLIK (widoczny gdy wybrany BLIK) -->
              <fieldset>
                <legend>Kod BLIK</legend>
                <label for="kod_blik">Wpisz 6-cyfrowy kod BLIK:</label><br>
                <input type="text" id="kod_blik" name="kod_blik" placeholder="000 000" size="10" maxlength="7">
              </fieldset>
            </fieldset>

            <br>

            <!-- ——— SEKCJA 4: ZGODY I REGULAMIN ——— -->
            <fieldset>
              <legend><strong>4. Zgody</strong></legend>
              <table cellpadding="6" cellspacing="0">
                <tr>
                  <td>
                    <label>
                      <input type="checkbox" name="regulamin" required>
                      Akceptuję <a href="#">regulamin sklepu</a> oraz <a href="#">politykę prywatności</a> *
                    </label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>
                      <input type="checkbox" name="newsletter">
                      Chcę otrzymywać newsletter z informacjami o promocjach
                    </label>
                  </td>
                </tr>
              </table>
            </fieldset>

          </form>
        </td>


        <!-- ===== ODSTĘP MIĘDZY KOLUMNAMI ===== -->
        <td width="3%">&nbsp;</td>


        <!-- ===================== PRAWA KOLUMNA — PANEL BOCZNY ===================== -->
        <td valign="top" width="32%">

          <!-- Lista produktów w koszyku -->
          <fieldset>
            <legend><strong>Twoje zamówienie</strong></legend>

            <table border="1" cellpadding="6" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Produkt</th>
                  <th>Ilość</th>
                  <th>Cena</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <img src="https://placehold.co/40x40?text=1" alt="Produkt 1" width="40" height="40"><br>
                    <small>Słuchawki bezprzewodowe Bluetooth</small>
                  </td>
                  <td align="center">1</td>
                  <td align="right" nowrap>149,00 zł</td>
                </tr>
                <tr>
                  <td>
                    <img src="https://placehold.co/40x40?text=2" alt="Produkt 2" width="40" height="40"><br>
                    <small>Koszulka bawełniana męska</small>
                  </td>
                  <td align="center">2</td>
                  <td align="right" nowrap>119,98 zł</td>
                </tr>
                <tr>
                  <td>
                    <img src="https://placehold.co/40x40?text=3" alt="Produkt 3" width="40" height="40"><br>
                    <small>Plecak sportowy 25L</small>
                  </td>
                  <td align="center">1</td>
                  <td align="right" nowrap>89,00 zł</td>
                </tr>
                <tr>
                  <td>
                    <img src="https://placehold.co/40x40?text=4" alt="Produkt 4" width="40" height="40"><br>
                    <small>Kubek termiczny 450ml</small>
                  </td>
                  <td align="center">1</td>
                  <td align="right" nowrap>45,00 zł</td>
                </tr>
              </tbody>
            </table>

            <p><a href="koszyk.html">← Edytuj koszyk</a></p>
          </fieldset>

          <br>

          <!-- Kod rabatowy -->
          <fieldset>
            <legend><strong>Kod rabatowy</strong></legend>
            <label for="kod_rabatowy">Wpisz kod:</label><br>
            <input type="text" id="kod_rabatowy" name="kod_rabatowy" placeholder="Np. RABAT10" size="18">
            <button type="button">Zastosuj</button>
            <br><br>
            <small>Kod rabatowy zostanie uwzględniony w podsumowaniu.</small>
          </fieldset>

          <br>

          <!-- Wartość zamówienia -->
          <fieldset>
            <legend><strong>Wartość zamówienia</strong></legend>
            <table cellpadding="6" cellspacing="0" width="100%">
              <tr>
                <td>Wartość produktów:</td>
                <td align="right">402,98 zł</td>
              </tr>
              <tr>
                <td>Dostawa (Kurier DPD):</td>
                <td align="right">14,99 zł</td>
              </tr>
              <tr>
                <td>Rabat:</td>
                <td align="right">0,00 zł</td>
              </tr>
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td><strong>Razem do zapłaty:</strong></td>
                <td align="right"><strong>417,97 zł</strong></td>
              </tr>
              <tr>
                <td colspan="2">
                  <small>w tym VAT: 78,14 zł</small>
                </td>
              </tr>
            </table>
          </fieldset>

          <br>

          <!-- Przycisk finalizacji -->
          <table width="100%">
            <tr>
              <td align="center">
                <button type="submit" form="formularz_zamowienia">
                  Zamawiam i płacę — 417,97 zł
                </button>
              </td>
            </tr>
            <tr>
              <td align="center">
                <br>
                <small>
                  Klikając „Zamawiam i płacę" potwierdzasz zamówienie z obowiązkiem zapłaty.
                </small>
              </td>
            </tr>
          </table>

          <br>

          <!-- Informacje dodatkowe -->
          <fieldset>
            <legend>Informacje</legend>
            <ul>
              <li>Darmowa dostawa od 200 zł</li>
              <li>30 dni na zwrot</li>
              <li>Bezpieczne płatności</li>
              <li>Pomoc: <a href="mailto:pomoc@sklep.pl">pomoc@sklep.pl</a></li>
            </ul>
          </fieldset>

        </td>

      </tr>
    </table>
  </main>

  <footer>
    <hr>
    <p>&copy; 2025 Sklep internetowy. Wszelkie prawa zastrzeżone.</p>
  </footer>

</body>
</html>
