<?php
define('SUCCESS_CODE',200);
define('BAD_REQUEST_CODE', 400);
define('UNAUTHENTICATED_CODE', 401);
define('SERVER_ERROR_CODE', 500);

define('REGISTER_SUCCEED_MESSAGE','Rejestracja przebiegła prawidłowo. Sprawdź swoją skrzynkę e-mail, aby aktywować konto.');
define('FORGOTPASSWORD_SUCCEED_MESSAGE','Sprawdź pocztę, aby ustawić nowe hasło.');
define('VERIFICATION_SUCCEED','Twoje konto jest zweryfikowane.');
define('RESETPASSWORD_SUCCEED','Hasło do konta zostało pomyślnie ustanowione jako nowe.');
define('LOGIN_SUCCEED_MESSAGE', 'Zostałeś zalogowany pomyślnie.');
define('ALREADY_EXIST_MESSAGE', 'Konto o podanym adresie e-mail już istnieje.');
define('NOT_CONFIRMED_MESSAGE', 'Konto nie zostało potwierdzone. Sprawdź pocztę e-mail, aby potwierdzić konto.');
define('NOT_EXIST_MESSAGE', 'E-mail lub Hasło jest niepoprawne.');
define('PASSWORD_INCORRECT_MESSAGE', 'Hasło jest nieprawidłowe.');
define('PASSWORD_SUCCESS_UPDATE_MESSAGE', 'Hasło zostało pomyślnie zaktualizowane.');
define('CREATE_SERIES_SUCCSES', 'Zmienna egzogeniczna została dodana.');
define('CREATE_SCENARIOS_SUCCSES', 'Symulacja została uruchomiona. Możesz wykonać jej analizę po jej przeliczeniu.');
define('CREATE_ANALYZE_SUCCESS', 'Twoja analiza została zapisana');
define('UPDATE_ANALYZE_SUCCSES', 'Twoja analiza została zaktualizowana');
define('DELETE_ANALYZE_SUCCESS', 'Analiza została usnięta');
define('UPDATE_BLOCK_SUCCSESFUL', 'Treść została zaktualizowana');
define('NOT_EXIST_ACCOUNT_MESSAGE', 'Konto o podanym adresie e-mail nie istnieje.');
define('FAILED_SEND_MESSAGE', 'Sorry, the confirmation email is not sent. Please try again to register.');
define('SERVER_ERROR_MESSAGE','An Error is occured on the server.');
define('EXIST_QUALIFICATION_POINT', 'Punkt kwalifikacyjny istnieje.');
define('CREATE_QUALIFICATION_POINT_SUCCESS', 'Twój punkt kwalifikacji został zapisany.');
define('UPDATE_QUALIFICATION_POINT_SUCCESS', 'Twój punkt kwalifikacji został zaktualizowany.');
define('DELETE_QUALIFICATION_POINT_SUCCESS', 'Twój punkt kwalifikacyjny został usunięty.');

define('CREATE_SPECIALIST_POINT_SUCCESS', 'Twój specjalista został zapisany.');
define('UPDATE_SPECIALIST_POINT_SUCCESS', 'Twój specjalista został zaktualizowany.');
define('DELETE_SPECIALIST_POINT_SUCCESS', 'Twój specjalista został usunięty.');

define('JWT_TOKEN_INVALID', 'Token is Invalid');
define('JWT_TOKEN_EXPIRED', 'Token is Expired');
define('JWT_TOKEN_NOTFOUND', 'Authorization Token not found');

define('SUCCESS_MESSAGE', 'The success response has been received');
