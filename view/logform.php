<?php

class logform {
    public function viewLogForm() {
        $result = <<<H
                    <form method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label" id="left">Login</label>
                            <div class="col-sm-10">
                                <input name="login" type="text" class="form-control" id="inputEmail3" placeholder="Login">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label" id="left">Password</label>
                            <div class="col-sm-10">
                                <input name="password" type="password" class="form-control" id="inputPassword3" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <div class="checkbox">
                                    <a href="?option=registration">Регистрация</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input class="btn btn-default" type="submit" name="login-user" value="Войти!" />
                            </div>
                        </div>
                    </form>
H;
        return $result;
    }
}