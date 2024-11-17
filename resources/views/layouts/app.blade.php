<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

{{--    <link rel="dns-prefetch" href="//fonts.bunny.net">--}}
{{--    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">--}}

{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">--}}
{{--    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>--}}
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>--}}

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body>
    <div id="app" class="p-5">
        @yield('content')
    </div>

    <footer>
        <div class="footer-elements">
            <div class="footer-content">
                <div class="footer-mobile">
                    <div class="footer-content__list">
                        <div class="list__items footer-list__items">
                            <img src="emojies/location.svg" alt="location">
                            <div class="email-adress">
                                <span>Adress:</span>
                            </div>
                        </div>
                        <div class="list__items footer-list__items">
                            <img src="emojies/Call.svg" alt="call">
                            <span>Tel : +9229341037</span>
                        </div>
                        <div class="list__items footer-list__items">
                            <img src="emojies/email.svg" alt="email">
                            <span>Email: info@onlearn.com</span>
                        </div>
                    </div>
                    <div class="footer-additionally">
                        <div class="footer-additionally__items">
                            <p>Categories</p>
                            <a href="#">Відгуки</a>
                        </div>
                        <div class="footer-additionally__items">
                            <p>Links</p>
                            <a href="#">Про нас</a>
                            <a href="#">Блог</a>
                        </div>
                    </div>
                </div>
                <div class="footer-content__search">
                    <input class="input-search" placeholder="Email" type="search">
                    <a href="" class="button footer-content__button">Send</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Модальне вікно авторизації -->
    <div id="login" class="modal" data-modal="login">
        <div class="modal-content">
            <span class="close" onclick="closeModal('login')"><ion-icon name="close-outline"></ion-icon></span>
            <h2>Вхід</h2>
            <div class="modal-inputs">
                <input type="email" placeholder="Email" required>
                <input type="password" placeholder="Пароль" required>
            </div>
            <div class="modal__bottom-section">
                <a href="#">Відновити пароль?</a>
                <a href="" class="button">Увійти</a>
            </div>
            <div class="modal-some-information">
                <p>Або увійдіть через</p>
                <div class="buttons">
                    <button class="icon-btn"><img src="icons/apple.png" alt="Apple" width="14"></button>
                    <button class="icon-btn google-btn"><img src="icons/google.png" alt="Google" width="14"></button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/index.js') }}"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
