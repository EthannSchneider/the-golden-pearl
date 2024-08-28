<?php 

class ResponseUtils {
    public static function response(string $message, int $responseCode = 200, string $contentType = 'application/json') {
        header('Content-Type: ' . $contentType, true, $responseCode);

        echo '{"message": "' . $message . '"}';
    }

    public static function unauthorized() {
        ResponseUtils::response('Unauthorized', 401);
    }

    public static function badRequest() {
        ResponseUtils::response('Malformed request', 400);
    }
}