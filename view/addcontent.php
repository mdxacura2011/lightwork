<?php

class addcontent {
    public function addData() {

        $result = "
                    <form method='post' class='form-horizontal'>
                        <div class='form-group'>
                            <label for='specialty' class='control-label col-sm-2'>Специальность</label>
                            <div class='col-sm-5'>
                                <input name='specialty' type='text' class='form-control' id='specialty' placeholder='Введите свою специальность' />
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='salary' class='control-label col-sm-2'>Зарплата</label>
                            <div class='col-sm-5'>
                                <input name='salary' type='text' class='form-control' id='salary' placeholder='За какие деньги вы готовы работать' />
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='city' class='control-label col-sm-2'>Город</label>
                            <div class='col-sm-5'>
                                <input name='city' type='text' class='form-control' id='city' placeholder='В каком городе живете' />
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='experience' class='col-sm-2 control-label'>Опыт работы</label>
                            <div class='col-sm-5'>
                                <textarea class='form-control' rows='5' name='experience' id='experience' placeholder='Введите все Ваши места работы'></textarea>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='education' class='col-sm-2 control-label'>Место учебы</label>
                            <div class='col-sm-5'>
                                <textarea class='form-control' rows='5' name='education' id='education' placeholder='Введите место Вашей учебы'></textarea>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='additionally' class='col-sm-2 control-label'>Дополнительная информация</label>
                            <div class='col-sm-5'>
                                <textarea class='form-control' rows='5' name='additionally' id='additionally' placeholder='Введите все Ваши навыки'></textarea>
                            </div>
                        </div>
                        <div class='form-group'>
                            <div class='col-sm-offset-2 col-sm-10'>
                                <input class='btn btn-default' type='submit' name='addresume' value='Добавить резюме' />
                            </div>
                        </div>
                    </form>
        ";
        return $result;
    }
}