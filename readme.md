## Opis działania danego programu - dane wejściowe i wyjściowe, tryb interfejsu użytkownika.
Program został napisany w języku php z wykorzystaniem elementów obiektowości. Program
wykorzystuje interfejs graficzny HTML5 + css, działający w oknie większości najpopularniejszych
przeglądarek internetowych.
Żeby skorzystać w programu konieczna jest uprzednia rejestracja użytkownika. Rejestracja polega na
podaniu swojego adresu email oraz hasła. Po udanej rejestracji, będzie możliwość zalogowania się do
programu. Do potrzeb rejestracji i logowania, program wykorzystuje bazę danych opartą o silnik
MySQL.
Interfejs graficzny składa się z kilku elementów. Pierwszym elementem jest plansza rejestracji
użytkownika, która posiada dwa przyciski: REJESTRACJA I LOGOWANIE.
Kolejnym elementem jest plansza logowania. Plansza logowanie zawiera dwa pola umożliwiające
wprowadzenie danych użytkownika (adres email oraz hasło) i przycisk zaloguj.
Następnym elementem jest właściwe okno programu. Główne okno programu informuje o
zalogowanym użytkowniku. Posiada także dwa pola danych, w których wpisujemy wzrost oraz wagę.
Przycisk OBLICZ, po naciśnięciu obliczy nam indeks BMI. Dodatkowym elementem jest przycisk
POWRÓT DO FORMULARZA, który umożliwia cofnięcie się do wcześniejszego ekranu, i zmianę
wpisanych danych liczbowych, bez konieczności ponownego logowania.
Program umożliwia zapisywanie historii wykonanych obliczeń dla każdego zarejestrowanego
użytkownika. Historia jest zapisywana w bazie danych MySQL.
Program generuje także wykres z danymi, na którym znajduje się nasz obliczony indeks BMI. Wykres
informuje po porównaniu danych, w jakim przedziale zdrowotnym znajduje się jego indeks BMI.
Wykres rysowany jest za pomocą biblioteki canvasjs w wersji trial.

## Konfiguracja bazy danych 
    
   
    
    
        what  | variable
------------- | -------------
      server  | private  $server = "mysql:host=localhost; dbname=bmiDb";
    username  |  private  $userDb = "registerUser";
    password  |  private  $passDb = "registerPwd1
