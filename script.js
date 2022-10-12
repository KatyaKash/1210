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
            localStorage.setItem('token', otvet.user.token)
            localStorage.setItem('expired', otvet.user.expired)
            window.location.replace("get.pokupki.php?token="+localStorage.getItem('token'))
        }
        else {
            alert('Непредвиденная ошибка')
            console.log(data)
        }
    })
}

function register() {
    let log = $('#login').val()
    let pas1 = $('#passw1').val()
    let pas2 = $('#passw2').val()
    if (pas1==pas2){
        $.get('register.php', {login: log, password: pas1}, function(data) {
            let otvet = JSON.parse(data)
            if ('error' in otvet) {
                alert(otvet['error']['text'])
            }
            else if ('user' in otvet) {
                alert('Вы успешно зарегистрировались')
                window.location.replace("login.html")
            }
            else {
                alert('Непредвиденная ошибка')
                console.log(data)
            }
        })
} else {
    alert('Пароли не совпадают');
}
}

