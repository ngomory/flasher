<?php

namespace Ngomory;

class Flasher
{

    static $msgFlash = 'Flasher26523365';

    static function danger(string $msg, string $title = 'Notification', string $position = 'top-right')
    {
        return self::base('danger', $title, $msg, $position);
    }

    static function success(string $msg, string $title = 'Notification', string $position = 'top-right')
    {
        return self::base('success', $title, $msg, $position);
    }

    static function info(string $msg, string $title = 'Notification', string $position = 'top-right')
    {
        return self::base('info', $title, $msg, $position);
    }

    static function warning(string $msg, string $title = 'Notification', string $position = 'top-right')
    {
        return self::base('warning', $title, $msg, $position);
    }

    static function base(string $type, string $title, string $msg, string $position = 'top-right')
    {
        session()->flash(self::$msgFlash, [
            'type' => $type,
            'title' => $title,
            'msg' => $msg,
            'position' => $position
        ]);
    }

    static function assetCss($template)
    {

        $msgFlash = session(self::$msgFlash);

        if (!empty($msgFlash)) {
        }
    }

    static function assetJs($template)
    {

        $msgFlash = session(self::$msgFlash);

        /**
         * flush session key
         */
        session([self::$msgFlash => null]);

        if (!empty($msgFlash)) {

            if ($template == 'bootstrap-5') {

                $position = [
                    'top-left' => 'top-0 start-0',
                    'top-center' => 'top-0 start-50 translate-middle-x',
                    'top-right' => 'top-0 end-0',
                    'bottom-left' => 'bottom-0 start-0',
                    'bottom-center' => 'bottom-0 start-50 translate-middle-x',
                    'bottom-right' => 'bottom-0 end-0',
                ][$msgFlash['position']] ?? 'top-0 end-0';

                return '
                    <div class="position-fixed ' . $position . ' p-2" style="z-index: 1030">
                        <div id="flasherToast"
                            class="toast bg-' . $msgFlash['type'] . ' text-white text-center border border-2 border-white opacity-93"
                            role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <svg  class="me-1" style="width:18px; height:18px;" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M10 21H14C14 22.1 13.1 23 12 23S10 22.1 10 21M21 19V20H3V19L5 17V11C5 7.9 7 5.2 10 4.3V4C10 2.9 10.9 2 12 2S14 2.9 14 4V4.3C17 5.2 19 7.9 19 11V17L21 19M17 11C17 8.2 14.8 6 12 6S7 8.2 7 11V18H17V11Z" />
                                </svg>
                                <strong class="me-auto">' . $msgFlash['title'] . '</strong>
                                <small>maintenant</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body fw-bold">
                                ' . $msgFlash['msg'] . '
                            </div>
                        </div>
                    </div>
                    <script>
                        var flasherToast = document.getElementById("flasherToast");
                        flasherToast = new bootstrap.Toast(flasherToast);
                        flasherToast.show();
                    </script>
                ';
            }
        }
    }
}
