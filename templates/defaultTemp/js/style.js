
function check(a,n) {
    if(a=='') {
        document.getElementById(n).innerHTML='Это обязательное поле';
    } else {
        document.getElementById(n).innerHTML='';
    }
}

function reg(a,t) {
    for(i=0;i<8;i++) {
        if(a.elements[i].value=='') {
            //alert("Вы не заполнили форму");
            document.getElementById(t).innerHTML='Вы не заполнили форму';
            a.elements[i].focus();
            return false;
        }

        var lastNamePatter=/^[а-яА-Я]+$/;
        if(!lastNamePatter.test(a.lastName.value)) {
            document.getElementById(t).innerHTML='Должны быть только русские буквы';
            a.lastName.focus();
            return false;
        }

        var firstNamePatter=/^[а-яА-Я]+$/;
        if(!firstNamePatter.test(a.firstName.value)) {
            document.getElementById(t).innerHTML='Должны быть только русские буквы';
            a.firstName.focus();
            return false;
        }

        var loginPatter=/^[a-zA-Z0-9]+$/;
        if(!loginPatter.test(a.login.value)) {
            document.getElementById(t).innerHTML='Должны быть только цыфры и латынские буквы';
            a.login.focus();
            return false;
        }

        if(a.inputPassword.value.length<6||a.inputPassword.value.length>16) {
                    document.getElementById(t).innerHTML='Пароль должен быть не меньше 6 и не более 16 символов';
                    a.inputPassword.focus();
                    return false;
        }

        if(a.inputPassword.value!=a.confirmPassword.value) {
            document.getElementById(t).innerHTML='Пароли не совпадают';
            a.inputPassword.focus();
            return false;
        }

        var emailPatter=/^([\w\d\-\_\.]+)\@([\w\d\-\_\.]+)\.([\w\d]{2,4})$/;
        if(!emailPatter.test(a.inputEmail.value)) {
            document.getElementById(t).innerHTML='Адрес почты неверный';
            a.inputEmail.focus();
            return false;
        }

        var dataPatter=/^(((0[1-9]|[12]\d|3[01])\.(0[13578]|1[02])\.((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\.(0[13456789]|1[012])\.((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\.02\.((19|[2-9]\d)\d{2}))|(29\.02\.((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/;
        if(!dataPatter.test(a.datar.value)) {
            document.getElementById(t).innerHTML='Формат даты рождения введен неверно';
            a.datar.focus();
            return false;
        }

        var phoneNumberPatter=/^[0-9]{3}-[0-9]{7}$/;
        if(!phoneNumberPatter.test(a.phoneNumber.value)) {
            document.getElementById(t).innerHTML='Неверно указан номер телефона';
            a.phoneNumber.focus();
            return false;
        }
    }
    document.form.submit();
}

function del()
{
    if (confirm("Вы действительно хотите удалить запись?"))
    {
        location.href="?option=delete";
    }
}