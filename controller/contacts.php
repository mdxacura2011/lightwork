<?php

class contacts extends core {
    function getTitle() {
        return 'Контакты';
    }

    function getContent() {
        $object = new viewContacts();
        return $object->contact();
    }
}