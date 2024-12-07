export const translateError = (message) => {
    switch (message) {
        case 'The name field is required.':
            return "Поле 'Ім'я' є обов'язковим.";
        case 'The email field is required.':
            return "Поле 'Email' є обов'язковим.";
        case 'The email has already been taken.':
            return 'Ця пошта вже використовується.'
        case 'The email must be a valid email address.':
            return 'Email має бути дійсною адресою.';
        case 'The password field is required.':
            return "Поле 'Пароль' є обов'язковим.";
        case 'The password field must be at least 6 characters.':
            return 'Пароль повинен містити в собі 6 або більше символів'
        case 'The password confirmation field is required.':
            return "Поле 'Підтвердження паролю' є обов'язковим"
        case 'The password field confirmation does not match.':
            return 'Поле підтвердження пароля не збігається.'
        case 'The password confirmation does not match.':
            return 'Підтвердження паролю не збігається.';
        case 'The password confirmation field must match password.':
            return 'Поле підтвердження пароля має відповідати паролю.'
        default:
            return 'Сталася помилка.';
    }
};
