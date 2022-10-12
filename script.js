function login() {
    let log = $('#login').val()
    let pas = $('#passw').val()

    $.get('auth.php', {login: log, password: pas}, function(data) {
        let otvet = JSON.parse(data)
        if ('error' in otvet) {
            alert(otvet['error']['text'])
        }
        else if ('user' in otvet) {
            alert('Вы успешно авторизовались')
            localStorage.setItem('token', otvet['token'])
            localStorage.setItem('expired', otvet['expired'])
        }
        else {
            alert('Непредвиденная ошибка')
            console.log(data)
        }
    })
}