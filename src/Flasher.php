<?php

namespace Ngomory;

class Flasher
{

    static $msgFlash = 'MsgFlash_26523365';

    static function danger(string $msg, string $title = 'Oups!')
    {
        return self::base('danger', $title, $msg);
    }

    static function success(string $msg, string $title = 'Super!')
    {
        return self::base('success', $title, $msg);
    }

    static function info(string $msg, string $title = 'Info!')
    {
        return self::base('info', $title, $msg);
    }

    static function warning(string $msg, string $title = 'Warning')
    {
        return self::base('warning', $title, $msg);
    }

    static function base(string $type, string $title, string $msg)
    {
        session()->flash(self::$msgFlash, [
            'type' => $type,
            'title' => $title,
            'msg' => $msg,
        ]);
    }
}
