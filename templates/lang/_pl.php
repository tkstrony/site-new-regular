<?php namespace ProcessWire;

/**
 * podstawowe tłumaczenia
 *
 */

return [
    // podstawowe
    'htmlLang' => __('pl'),
    'ogLocale' => __('pl_PL'),
    'share' => __('Udostępnij to'),
    'edit' => __('Edytuj'),
    'alsoLike' => __('Może Cię również zainteresować'),
    'next' => __('następny'),
    'prev' => __('poprzedni'),
    'visitMore' => __('Odwiedź więcej stron'),
    'copied' => __('Skopiowano'),
    'copyToClipboard' => __('Skopiuj do schowka'),
    'copyToClipboardRaw' => __('Kopiuj surowy tekst do schowka'),
    
    // PWA
    'sorryOffline' => __('Przeprasamy ale jesteś offline - być może problemy z siecią :('),

    // RSS
    'latestUpdates' => __('Najnowsze aktualizacje'),
    'mostUpdates' => __('Zobacz najnowsze artykuły, które zostały zaktualizowane na naszej stronie'),

    // tryb kolorów
    'lightTheme' => __('Jasny'),
    'cyberPunkTheme' => __('Cyberpunk'),
    'darkTheme' => __('Ciemny'),
    'coolTheme' => __('Chłodny'),
    'systemTheme' => __('Systemowy'),
    'selectColor' => __('Wybierz kolor strony'),

    // wyszukiwanie
    'search' => __('Szukaj'),
    'searchResults' => __('Wyniki wyszukiwania dla: %s'),
    'noResults' => __('Niestety, nie znaleziono wyników.'),

    // Linki
    'socialProfiles' => __('Profile Społecznościowe'),
    'contactUs' => __('Skontaktuj się z nami'),
    'companyMap' => __('Mapa firmy'),
    'usefLinks' => __('Przydatne linki'),
        
    // czcionki
    'manageFonts' => __('Zarządzaj czcionkami'),

    // Tryb konserwacji
    'disabled' => __('Nasza strona jest obecnie wyłączona.'),
    'maintenance' => __('Tryb konserwacji.'),

    // Hooki
    'pagePublished' => __('Strona zostanie opublikowana za %s'),
    'pageAlreadyPublished' => __('Strona została już opublikowana %s'),

    // etykiety formularza
    'formLegend' => __('Formularz kontaktowy'),
    'name' => __('Imię'),
    'email' => __('E-mail'),
    'phone' => __('Telefon'),
    'address' => __('Adres'),
    'message' => __('Wiadomość'),
    'files' => __('Wybierz pliki'),
    'personalDataAccept' => __('Zaakceptuj dane osobowe'),
    'submit' => __('Wyślij'),
    'errors' => __('Wypełnij poprawnie pola'),
    'companyEmailWarning' => __('Ustaw firmowy adres e-mail'),
    'placeholderName' => __('Jan Kowalski'),
    'placeholderEmail' => __('podaj-adres-email@mail.com'),
    'placeholderMessage' => __('Napisz wiadomość'),
    'placeholderSubmit' => __('Wypełnij wszystkie pola (*) przed wysłaniem formularza'),

    // proces formularza
    'form_succesMessage' => __('Formularz został pomyślnie wysłany.'),
    'form_errorMessage' => __('Formularz nie został poprawnie przesłany.'),
    'form_thanksMesage' => __('Dziękujemy za wiadomość, postaramy się odpowiedzieć jak najszybciej. Poniżej treść Twojej wiadomości.'),
    'form_submitAgain' => __('Prześlij ponownie'),
    'form_failedResponse' => __('Form submission failed !!!'),
    'form_autoresponderThank' => __('Dziękujemy, że jesteś z nami.'),
    'form_autoresponderContent' => __('Otrzymaliśmy wiadomość i po jej sprawdzeniu skontaktujemy się z Tobą tak szybko, jak to możliwe.'),
    'form_blackList' => __('Jesteś na czarnej liście `%s` i nie możesz wysłać nam wiadomości za pomocą formularza :('),
    'form_attempts' => __('Przepraszamy - zbyt wiele prób kontaktu i system zablokował możliwość wysyłania kolejnych wiadomości poprzez formularz.'),

    // zgody na pliki cookie
    'weUseCookies' => __('Ta strona korzysta z plików cookie w celu usprawnienia korzystania z niej.'),
    'cookieManage' => __('Zarządzaj ustawieniami plików cookie'),
    'cookieCloseBanner' => __('Zamknij baner dotyczący plików cookie'),
    'cookieShowBanner' => __('Pokaż baner plików cookie'),
    'cookieHideBanner' => __('Baner został ukryty'),
    'cookieInformation' => __('W przypadku pytań dotyczących naszej polityki plików cookie, Twoich wyborów lub sposobu, w jaki przetwarzamy Twoje dane osobowe, zapoznaj się z naszą %s Polityką.'),
    'cookieNecessary' => __('Niezbędne pliki cookie'),
    'cookieAnalytics' => __('Pliki cookie analityczne'),
    'cookieMarketing' => __('Pliki cookie marketingowe'),
    'cookieAcceptAll' => __('Akceptuj wszystkie pliki cookie'),
    'cookieRejectAll' => __('Odrzuć wszystkie pliki cookie'),
    'cookieSettingsSaved' => __('Zaktualizuj ustawienia plików cookie'),
    'cookieSaveSelected' => __('Zapisz wybrane ustawienia'),

    // blog
    'onBlog' => __('Na blogu'),
    'more' => __('Więcej'),
    'readMore' => __('Czytaj więcej'),
    'nextParts' => __('Następna część wpisu'),
    'nextPost' => __('Następny wpis'),
    'lastMod' => __('Ostatnia modyfikacja'),
    'published' => __('Opublikowano'),
    'by' => __('przez %s'),
    'lastPost' => __('Ostatni wpis'),
    'share' => __('Udostępnij to'),
    'entryNotFound' => __('Nie znaleziono wpisu'),

    // komentarze
    'showCommets' => __('Pokaż komentarze'),
    'HideComments' => __('Ukryj komentarze'),
    'comment' => __('Komentarz'),
    'comments' => __('Komentarze'),
    'commentsList' => __('Lista komentarzy'),
    'noComments' => __('Brak komentarzy'),
    'commentsClosed' => __('Komentarze są zamknięte'),
    'header' => __('Dodane przez {cite} dnia {created}'),
    'successMessage' => __('Dziękujemy, Twój komentarz został opublikowany.'),
    'pendingMessage' => __('Twój komentarz został przesłany i pojawi się po zatwierdzeniu przez moderatora.'),
    'errorMessage' => __('Twój komentarz nie został zapisany z powodu jednego lub więcej błędów. Sprawdź, czy wypełniłeś wszystkie pola przed ponownym wysłaniem.'),
    'postComment' => __('Dodaj komentarz'),
    'commentCite' => __('Twoje imię'),
    'commentEmail' => __('Twój e-mail'),
    'commentWebsite' => __('Strona internetowa'),
    'commentStars' => __('Twoja ocena'),
    'starsRequired' => __('Wybierz ocenę w gwiazdkach'),
    'reply' => __('Odpowiedz'),
    'replyTo' => __('( %s ) Odpowiadasz na komentarz użytkownika %s, w którym napisał: %s'),

    // strefa użytkownika
    'notPremissions' => __('Nie masz uprawnień do przeglądania tej strony'),
    'deleteTodo' => __('Usuń zadanie'),
    'errorCreating' => __('Problem z tworzeniem nowej strony'),
    'createNew' => __('Utwórz nowe zadanie'),
    'todoLimit' => __('Przepraszamy, limit zadań został osiągnięty'),
    'loggedIn' => __('Zostałeś pomyślnie zalogowany'),
    'loggedOut' => __('Zostałeś pomyślnie wylogowany'),
    'update' => __('Aktualizuj'),
    'delete' => __('Usuń'),
    'backTo' => __('Powruć do'),

    // copyright
    'allRights' => __('Wszelkie prawa zastrzeżone.'),
    'copyright' => __('%s. Stworzone przez %s - to jest to!'),
];
