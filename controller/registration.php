<?php

class registration extends core {

    function getTitle() {
        return 'Регистрация';
    }

    function getContent() {
        $result = "";
        if(isset($_SESSION['name'])) {
            header("Location: ?option=indexclass");
            exit;
        }

        if(isset($_POST['registration-user'])) {
            $lastName = $this->sift($this->clearString($_POST['lastName']));
            $firstNam = $this->sift($this->clearString($_POST['firstName']));
            $login = $this->sift($this->clearString($_POST['login']));
            $inputPassword = $this->sift($this->clearString($_POST['inputPassword']));
            $confirmPassword = $this->sift($this->clearString($_POST['confirmPassword']));
            $inputEmail = $this->sift($this->clearString($_POST['inputEmail']));
            $datar = $this->sift($this->clearString($_POST['datar']));
            $phoneNumber = $this->sift($this->clearString($_POST['phoneNumber']));
            $code = $this->sift($this->clearString($_POST['code']));


            if ($inputPassword == $confirmPassword) {
                if (strlen($inputPassword) < 6 or strlen($inputPassword) > 16) {
                    exit ('Пароль должен быть не меньше 6 и не более 16 символов');
                }
                if (preg_match("/^([\w\d\-\_\.]+)\@([\w\d\-\_\.]+)\.([\w\d]{2,4})$/", $inputEmail)) {
                    if (preg_match("/[а-яА-Я]+$/", $lastName)) {
                        if (preg_match("/[а-яА-Я]+$/", $firstNam)) {
                            if (preg_match("/^[a-zA-Z0-9]+$/", $login)) {
                                if (preg_match("/^(((0[1-9]|[12]\d|3[01])\.(0[13578]|1[02])\.((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\.(0[13456789]|1[012])\.((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\.02\.((19|[2-9]\d)\d{2}))|(29\.02\.((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/
 ", $datar)) {
                                    if (preg_match("/^[0-9]{3}-[0-9]{7}$/", $phoneNumber)) {

                                        if(!empty($this->hereBase->checkLogin($login))) {
                                            exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
                                        } else {

                                            if(!$this->chec_code($code)) {
                                                exit ("Вы ввели неверно код с картинки");
                                            } else {

                                                $path = 'templates/defaultTemp/image/';
                                                $refLogo = $this->logoType();
                                                $logo =  $path . $refLogo;
                                                $images = $path .'foto'. $refLogo;
                                                $date = date("Y-m-d G:i:s");
                                                $pass = strrev(md5($inputPassword));
                                                $cpass = strrev(md5($confirmPassword));

                                                $this->hereBase->allData($lastName, $firstNam, $login, $pass, $cpass, $inputEmail, $datar, $phoneNumber, $images, $logo,  $date);

                                                $subject = "Подтверждение регистрации";//тема сообщения
                                                $message = "Здравствуйте! Спасибо за регистрацию на уважением, Администрация citename.ru";//содержание сообщение
                                                mail($inputEmail, $subject, $message, "Content-type:text/plane; Charset=windows-1251\r\n");//отправляем сообщение

                                                exit ("Ву успешно зарегестрированны перейдите на <a href='?option=indexclass'>главную страницу</a> и войдите под своим логином и паролем ");
                                            }

                                        }

                                    } else {
                                        $result .= '<p>Телефонный номер введен неверно</p>';
                                    }
                                } else {
                                    $result .= '<p>Дата рождения введенна неверно</p>';
                                }
                            } else {
                                $result .= '<p>Логин введен неверно</p>';
                            }
                        } else {
                            $result .= '<p>Фамилия введенна неверно</p>';
                        }
                    } else {
                        $result .= '<p>Имя введенно неверно</p>';
                    }
                } else {
                    $result .= '<p>Почта введена неверно</p>';
                }
            } else {
                $result .= '<p>Пароли не совпадают</p>';
            }
        }
        $object = new regform();
        $result .= $object->registrForm();
        return $result;
    }

    public function logoType() {
        $fupload = $_FILES['fupload']['name']; //исходное имя файла, такое, каким его видел пользователь, выбирая файл

        if(!isset($fupload) or empty($fupload) or $fupload=='') {
            $avatar = 'photo_default.jpg'; //аватар по умолчанию
        } else {
            $path_to_avatar = ROOT . '/templates/defaultTemp/image/'; //куда будет загружаться картинка пользователя
            if(preg_match('/[.](JPG)|(jpg)|(gif)|(GIF)|(png)|(PNG)$/', $fupload)) { //проверяем формат файла

                $source = $_FILES['fupload']['tmp_name']; //полный путь к временному файлу на диске
                $target = $path_to_avatar . $fupload;

                move_uploaded_file($source, $target); //Перемещает загруженный файл в новое место

                if(preg_match('/[.](GIF)|(gif)$/', $fupload)) { //если оригинал в формате gif то создаем такое же изображение
                    $im = imagecreatefromgif($path_to_avatar.$fupload);
                }
                if(preg_match('/[.](PNG)|(png)$/', $fupload)) {
                    $im = imagecreatefrompng($path_to_avatar.$fupload);
                }

                if(preg_match('/[.](JPG)|(jpg)|(jpeg)|(JPEG)$/', $fupload)) {
                    $im = imagecreatefromjpeg($path_to_avatar.$fupload);
                }

                $w = 90;
                $y  = 350;
                $w_src = imagesx($im); //вычисляем ширину
                $h_src = imagesy($im); //вычисляем высоту изображения
                $dest = imagecreatetruecolor($w,$w); //создаем пустую картинку
                $dester = imagecreatetruecolor($y,$y);

                //вырезаем квадратную серединку по x, если фото горизонтальное
                if    ($w_src>$h_src) {
                    imagecopyresampled($dest, $im, 0, 0, round((max($w_src,$h_src)-min($w_src,$h_src))/2), 0, $w, $w, min($w_src,$h_src), min($w_src,$h_src));
                }

                // вырезаем квадратную верхушку по y, если фото вертикальное
                if    ($w_src<$h_src) {
                    imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, min($w_src,$h_src), min($w_src,$h_src));
                }

                // квадратная картинка масштабируется без вырезок
                if ($w_src==$h_src) {
                    imagecopyresampled($dest, $im, 0, 0, 0, 0, $w, $w, $w_src, $w_src);
                }

                //для картинки 350
                if    ($w_src>$h_src) {
                    imagecopyresampled($dester, $im, 0, 0, round((max($w_src,$h_src)-min($w_src,$h_src))/2), 0, $y, $y, min($w_src,$h_src), min($w_src,$h_src));
                }

                if    ($w_src<$h_src) {
                    imagecopyresampled($dester, $im, 0, 0, 0, 0, $y, $y, min($w_src,$h_src), min($w_src,$h_src));
                }

                if ($w_src==$h_src) {
                    imagecopyresampled($dester, $im, 0, 0, 0, 0, $y, $y, $w_src, $w_src);
                }

                $date=time();//вычисляем время в настоящий момент.
                imagejpeg($dest, $path_to_avatar.$date.'.jpg');//сохраняем изображение в формате jpg в нужную папку, именем будет текущее время
                imagejpeg($dester, $path_to_avatar.'foto'.$date.'.jpg');
                $avatar = $date.'.jpg';//заносим в переменную путь до аватара.

                $delfull    = $path_to_avatar.$fupload;
                unlink($delfull);//удаляем оригинал загруженногo изображения.

            } else {
               exit ("<b>Аватар должен быть в формате JPG,GIF или PNG</b>");
            }
        }
        return $avatar;
    }

    protected function generate_code() {
        //запускаем функцию, генерирующую код

            $hours = date("H"); // час
            $minuts = substr(date("H"), 0, 1);// минута
            $mouns = date("m");    // месяц
            $year_day = date("z"); // день в году
            $str = $hours . $minuts . $mouns . $year_day; //создаем строку
            $str = md5(md5($str)); //дважды шифруем в md5
            $str = strrev($str);// реверс строки
            $str = substr($str, 3, 6); // извлекаем 6 символов,    начиная с 3

            $array_mix = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
            srand ((float)microtime()*1000000);
            shuffle ($array_mix);
            return implode("", $array_mix);
    }

    protected function chec_code($code) {
        $array_mix = preg_split ('//', $this->generate_code(), -1, PREG_SPLIT_NO_EMPTY);
        $m_code = preg_split ('//', $code, -1, PREG_SPLIT_NO_EMPTY);
        $result = array_intersect ($array_mix, $m_code);
        if(strlen($this->generate_code())!=strlen($code)) {
            return FALSE;
        }
        if(sizeof($result) == sizeof($array_mix)) {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

}
