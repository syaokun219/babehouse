<?php

class index {
    const TPL = "setting";
    const DB_NAME = "test";

    public function execute() {
        $db = Storage_Mongo::getDb(self::DB_NAME);
        $res = $db->textcode->findOne();
        Page::assign('pagedata', $res);
        Page::setTpl(self::TPL);
    }
}
