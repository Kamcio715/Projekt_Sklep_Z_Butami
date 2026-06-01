===================================================================

Sklep z butami - dokumentacja

===================================================================

Spis treści:

1. Wstęp
2. Wymagania
3. Architektura systemu
4. Baza Danych
5. Opis funckjonalności
6. Testy
7. Instrukcja użytkownika
8. Podsumowanie

===================================================================

1. Wstęp

===================================================================
1.1 Nazwa Aplikacji

Sklep z butami – internetowy sklep obuwniczy

===================================================================

1.2 Cel projektu

Celem aplikacji jest umożliwienie klientom zakupu obuwia online poprzez intuicyjny interfejs webowy. System pozwala na przeglądanie produktów, składanie zamówień, zarządzanie kontem użytkownika oraz obsługę płatności internetowych.

===================================================================

1.3 Zakres projektu

Aplikacja umożliwia:

- rejestrację i logowanie użytkowników,
- przeglądanie katalogu produktów,
- filtrowanie i wyszukiwanie obuwia,
- zarządzanie koszykiem zakupowym,
- składanie zamówień,
- realizację płatności online,
- śledzenie historii zamówień,
- zarządzanie produktami przez administratora.

===================================================================

1.4 Twórcy aplikacji

Mikołaj Andrzejak
Jakbub Jankowiak
Oliwier Kubacki
Mateusz Spławski
Kamil Stachowiak

===================================================================

2. Wymagania

===================================================================

2.1 Wymagania systemowe

Urządzenie z dostępem do internetu i zainstalowaną przeglądarką

===================================================================

2.2 Obsługiwane przeglądarki

Aplikacja działa na wszystkich przeglądarkach dostępnych na systemach Windows

===================================================================

3. Architektura systemu

===================================================================

3.1 Architektura

Aplikacja została zaprojektowana w modelu trójwarstwowym:

Frontend -> Backend -> Baza danych

Frontend:
- HTML5
- CSS3
- JavaScript

Backend:
- PHP

Baza danych:
- MySQL

===================================================================

4. Bazy danych

===================================================================

4.1 Tabela users

Tabela przechowuje dane użytkowników systemu.

Pole	            Typ danych	        Opis
-------------------------------------------------------------------
id	                BIGINT UNSIGNED	    Identyfikator użytkownika
name	            VARCHAR(255)	    Imię i nazwisko użytkownika
email	            VARCHAR(255)	    Adres e-mail
is_admin	        TINYINT(1)	        Flaga administratora (0 – użytkownik, 1 – administrator)
email_verified_at	TIMESTAMP	        Data weryfikacji adresu e-mail
password	        VARCHAR(255)	    Zaszyfrowane hasło
remember_token	    VARCHAR(100)	    Token zapamiętania sesji
created_at	        TIMESTAMP	        Data utworzenia konta
updated_at	        TIMESTAMP	        Data ostatniej modyfikacji
-------------------------------------------------------------------

===================================================================

4.2 Tabela shoes

Tabela przechowuje informacje o produktach dostępnych w sklepie.

Pole	            Typ danych	        Opis
-------------------------------------------------------------------
id	                BIGINT UNSIGNED	    Identyfikator produktu
name	            VARCHAR(255)	    Nazwa produktu
brand	            VARCHAR(255)	    Marka obuwia
category	        VARCHAR(255)	    Kategoria produktu
type	            VARCHAR(255)	    Typ obuwia
size	            DECIMAL(4,1)	    Rozmiar
price	            DECIMAL(8,2)	    Cena produktu
kolor	            VARCHAR(255)	    Kolor produktu
description	        TEXT	            Opis produktu
image	            VARCHAR(255)	    Ścieżka do zdjęcia produktu
created_at	        TIMESTAMP	        Data dodania produktu
updated_at	        TIMESTAMP	        Data aktualizacji produktu
-------------------------------------------------------------------

===================================================================

4.3 Tabela orders

Tabela przechowuje informacje o zamówieniach klientów.

Pole	            Typ danych	        Opis
-------------------------------------------------------------------
id	                BIGINT UNSIGNED	    Identyfikator zamówienia
user_id	            BIGINT UNSIGNED	    Identyfikator użytkownika
customer_name	    VARCHAR(255)	    Imię i nazwisko klienta
customer_email	    VARCHAR(255)	    Adres e-mail klienta
customer_phone	    VARCHAR(255)	    Numer telefonu
address	            VARCHAR(255)	    Adres dostawy
total_amount	    DECIMAL(10,2)	    Łączna wartość zamówienia
items	            LONGTEXT	        Lista zamówionych produktów
created_at	        TIMESTAMP	        Data utworzenia zamówienia
updated_at	        TIMESTAMP	        Data aktualizacji zamówienia
-------------------------------------------------------------------
Relacja

users (1) ---- (N) orders

Jeden użytkownik może posiadać wiele zamówień.

===================================================================

4.4 Tabela sessions

Tabela przechowuje aktywne sesje użytkowników.

Pole	            Typ danych	        Opis
-------------------------------------------------------------------
id	                VARCHAR(255)	    Identyfikator sesji
user_id	            BIGINT UNSIGNED	    Identyfikator użytkownika
ip_address	        VARCHAR(45)	        Adres IP
user_agent	        TEXT	            Informacje o przeglądarce
payload	            LONGTEXT	        Dane sesji
last_activity	    INT	                Ostatnia aktywność użytkownika
-------------------------------------------------------------------

===================================================================

4.5 Tabela password_reset_tokens

Tabela przechowuje tokeny resetowania haseł.

Pole	            Typ danych	        Opis
-------------------------------------------------------------------
email	            VARCHAR(255)	    Adres e-mail użytkownika
token	            VARCHAR(255)	    Token resetowania hasła
created_at	        TIMESTAMP	        Data utworzenia tokenu
-------------------------------------------------------------------

===================================================================

4.6 Tabela cache

Tabela przechowuje dane pamięci podręcznej aplikacji.

Pole	            Typ danych	        Opis
-------------------------------------------------------------------
key	                VARCHAR(255)	    Klucz pamięci podręcznej
value	            MEDIUMTEXT	        Przechowywana wartość
expiration	        INT	                Czas wygaśnięcia
-------------------------------------------------------------------

===================================================================

4.7 Tabela cache_locks

Tabela przechowuje blokady pamięci podręcznej.

Pole	            Typ danych	        Opis
-------------------------------------------------------------------
key	                VARCHAR(255)	    Klucz blokady
owner	            VARCHAR(255)	    Właściciel blokady
expiration	        INT	                Czas wygaśnięcia blokady
-------------------------------------------------------------------

===================================================================

4.8 Tabela jobs

Tabela przechowuje zadania wykonywane asynchronicznie przez system.

Pole	            Typ danych	        Opis
-------------------------------------------------------------------
id	                BIGINT UNSIGNED	    Identyfikator zadania
queue	            VARCHAR(255)	    Nazwa kolejki
payload	            LONGTEXT	        Dane zadania
attempts	        TINYINT UNSIGNED	Liczba prób wykonania
reserved_at	        INT UNSIGNED	    Czas rezerwacji zadania
available_at	    INT UNSIGNED	    Czas dostępności zadania
created_at	        INT UNSIGNED	    Data utworzenia
-------------------------------------------------------------------

===================================================================

4.9 Tabela job_batches

Tabela przechowuje grupy zadań wykonywanych w tle.

Pole	            Typ danych	        Opis
-------------------------------------------------------------------
id	                VARCHAR(255)	    Identyfikator grupy
name	            VARCHAR(255)	    Nazwa grupy
total_jobs	        INT	                Liczba wszystkich zadań
pending_jobs	    INT	                Liczba oczekujących zadań
failed_jobs	        INT	                Liczba nieudanych zadań
failed_job_ids	    LONGTEXT	        Identyfikatory nieudanych zadań
options	            MEDIUMTEXT	        Opcje konfiguracji
cancelled_at	    INT	                Data anulowania
created_at	        INT	                Data utworzenia
finished_at	        INT	                Data zakończenia
-------------------------------------------------------------------

===================================================================

4.10 Tabela failed_jobs

Tabela przechowuje informacje o nieudanych zadaniach.

Pole	            Typ danych	        Opis
-------------------------------------------------------------------
id	                BIGINT UNSIGNED	    Identyfikator błędu
uuid	            VARCHAR(255)	    Unikalny identyfikator
connection	        TEXT	            Nazwa połączenia
queue	            TEXT	            Nazwa kolejki
payload	            LONGTEXT	        Dane zadania
exception	        LONGTEXT	        Treść wyjątku
failed_at	        TIMESTAMP	        Data wystąpienia błędu
-------------------------------------------------------------------

===================================================================

4.11 Tabela migrations

Tabela przechowuje historię migracji bazy danych.

Pole	            Typ danych	        Opis
-------------------------------------------------------------------
id	                INT UNSIGNED	    Identyfikator migracji
migration	        VARCHAR(255)	    Nazwa migracji
batch	            INT	                Numer paczki migracji
-------------------------------------------------------------------

===================================================================

5. Opis funkcjonalności

===================================================================

5.1 Rejestracja użytkownika

Opis

Użytkownik zakłada nowe konto w systemie.

Dane wejściowe
- imię,
- nazwisko,
- adres e-mail,
- adres zamieszkania,
- numer telefonu,
- hasło.

Warunki poprawności
poprawny format adresu e-mail,
hasło minimum 8 znaków.

Wynik
utworzenie konta użytkownika.

===================================================================

5.2 Logowanie

Opis
Użytkownik uzyskuje dostęp do swojego konta.

Dane wejściowe
- e-mail,
- hasło.

Wynik
wygenerowanie sesji użytkownika.

===================================================================

5.3 Dodawanie produktu do koszyka

Opis
Klient wybiera produkt i dodaje go do koszyka.

Dane wejściowe
- identyfikator produktu,
- rozmiar,
- ilość.

Wynik
aktualizacja zawartości koszyka.

===================================================================

5.4 Składanie zamówienia

Opis
Klient finalizuje zakup.

Kroki
- Przejście do koszyka.
- Wprowadzenie adresu dostawy.
- Wybór metody płatności.
- Potwierdzenie zamówienia.

Wynik
utworzenie rekordu zamówienia.

===================================================================

6. Testy

===================================================================

Testy przeglądarkowe strony BUTY.PL

Główna strona działa poprawnie. Po dodaniu butów do bazy danych przez plik "insert buty.sql" na stronie pojawiły się zdjęcia oraz strony dla każdego buta.

Strona rejestracji sprawuje się bez błędów. Po potwierdzeniu adresu E-mail profil się w pełni pokazuje oraz można zmienić jego dane.
Dodawanie recenzji oraz ich edycja działa bez błędów.
Dodawanie, usuwanie oraz zmiana ilości butów w koszyku bez błędów. Buty nie posiadane w magazynie nie zostaną dodane. Można wybrać rozmiar buta.
Składanie zamówień działa bez błędów. Złożone zamówienia można zobaczyć pod menu użytkownika.

===================================================================

7. Instrukcja użytkownika

===================================================================

7.1 Rejestracja

- Na stronie głównej kliknąć ikonę użytkownika (prawy górny róg strony).
- Kliknąć przycisk "Rejestracja".
- Na stronie do rejestracji uzupełnić dane.
- Potwierdzić e-mail.

===================================================================

7.2 Logowanie

- Po rejestracji kliknąć w ikonę użytkownika.
- Kliknąć przycisk "Logowanie".
- Wypełnić dane do logowanie.

===================================================================

7.3 Edycja danych

- Po zalogowaniu kliknąć w ikonę użytkownika.
- Kliknąć "Profil".
- Wpisać nowe dane w pola.
- Kliknąć "zapisz zmiany".

===================================================================

7.4 Dodawanie przedmiotów do koszyka

- Wybranie przedmiotu.
- Wybranie ilości i rozmiaru.
- Kliknięcie "Dodaj do koszyka".

===================================================================

7.5 Zamawianie przedmiotów

- Wejść w koszyk.
- Upewnić się, czy wybrane produkty są poprawne.
- 

===================================================================

8. Podsumowanie

===================================================================

Strona umożliwia zamawianie produktów dzięki prostemu systemowi działania oraz intuicyjnemu intetrfejsu użytkownika. Aplikacja obsługuje tworzenie i zarządzanie użytkownikami. Dokumentacja stanowi podstawę do dalszego rozwoju i utrzymania systemu.