<?php
class viewContacts {
    public function contact() {
        $result = "
                    <address>
                      <strong>Добавь резюме</strong><br>
                      г. Запорожье<br>
                      проспект Ленина<br>
                      <abbr title='Phone'>Телефон:</abbr> (055) 555-8888
                    </address>

                    <address>
                      <strong>Электрпонная почта</strong><br>
                      first.last@example.com
                    </address>
        ";
        return $result;
    }
}