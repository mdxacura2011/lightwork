<?php

class regform {
    public function registrForm() {
        $result = <<<H
           <form name="form" method="post" class="form-horizontal" enctype="multipart/form-data">
           <div id="er">
                <span id="ort"></span>
           </div>

                <div class="form-group">
                    <label for="lastName" class="col-sm-2 control-label">Фамилия</label>
                    <div class="col-sm-3">
                        <input name="lastName" type="text" class="form-control" id="lastName" placeholder="Введите фамилию" onblur="check(this.value,'last')"><span id="last"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="firstName" class="col-sm-2 control-label">Имя</label>
                    <div class="col-sm-3">
                        <input name="firstName" type="text" class="form-control" id="firstName" placeholder="Введите имя" onblur="check(this.value,'first')"><span id="first"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="login" class="col-sm-2 control-label">Логин</label>
                    <div class="col-sm-3">
                        <input name="login" type="text" class="form-control" id="login" placeholder="Введите логин" onblur="check(this.value,'log')"><span id="log"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Пароль</label>
                    <div class="col-sm-3">
                        <input name="inputPassword" type="password" class="form-control" id="inputPassword" placeholder="Введите пароль" onblur="check(this.value,'pass')"><span id="pass"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirmPassword" class="col-sm-2 control-label">Подтвердите пароль</label>
                    <div class="col-sm-3">
                        <input name="confirmPassword" type="password" class="form-control" id="confirmPassword" placeholder="Введите пароль" onblur="check(this.value,'cpass')"><span id="cpass"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-3">
                        <input name="inputEmail" type="email" class="form-control" id="inputEmail" placeholder="Электронная почта" onblur="check(this.value,'eml')"><span id="eml"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="idata" class="control-label col-sm-2">Дата рождения:</label>
                    <div class="col-sm-3">
                        <input name="datar" type="text" id="idata" class="form-control" placeholder="дд.мм.гггг" onblur="check(this.value,'data')"><span id="data"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phoneNumber" class="col-sm-2 control-label">Телефон</label>
                    <div class="col-sm-3">
                        <input name="phoneNumber" type="text" class="form-control" id="phoneNumber" placeholder="***-*******" onblur="check(this.value,'tel')"><span id="tel"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputFile" class="control-label col-sm-2">Загрузить лого</label>
                    <div class="col-sm-3">
                        <input name="fupload" type="file" class="form-control" id="inputFile">
                    </div>
                </div>

                <div class="form-group">
                    <label for="captcha" class="control-label col-sm-2">Код с картинки</label>
                    <div class="col-sm-3">
                        <p><img src="code/my_codegen.php"></p>
                        <input name="code" type="text" class="form-control" id="captcha" placeholder="Код с картинки" onblur="check(this.value,'cap')"><span id="cap"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-3 col-sm-offset-2">
                        <input class="btn btn-default" name="registration-user" value="Зарегистрироваться" onClick="reg(this.form,'ort')">
                    </div>
                </div>
            </form>
H;
        return $result;
    }
}