<?php

namespace App\Classes;

class Notify
{
    public function Info(string $message) {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
            const toast = new ZephyrToast();
            const message = "' . $message . '";
            toast.info(message, {
                "position": "top-center",
                "type": "info",
                "duration": 5000,
                "title": "",
                "showProgress": true,
                "showClose": true,
                "newestOnTop": true,
                "enableIcon": true,
                "animation": {
                    "in": "zoomIn",
                    "out": "zoomOut"
                },
                "pauseOnHover": true,
                "allowHtml": false,
                "isIcon": false,
                "icon": "fas fa-check-circle",
            });
        });
    </script>';
    }

    public function Error(string $message) {
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
        const toast = new ZephyrToast();
        const message = "' . $message . '";
            toast.error(message, {
                "position": "top-center",
                "type": "error",
                "duration": 5000,
                "title": "",
                "showProgress": true,
                "showClose": true,
                "newestOnTop": true,
                "enableIcon": true,
                "animation": {
                    "in": "zoomIn",
                    "out": "zoomOut"
                },
                "pauseOnHover": true,
                "allowHtml": false
            });
        });
    </script>';
    }
}