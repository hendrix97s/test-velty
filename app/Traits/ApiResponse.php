<?php

namespace App\Traits;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

Trait ApiResponse
{

    private function content(string $message, array $data, bool $success, $statusCode = null, $errorCode = null): array
    {
        $content = [
            'status'  => ($success)?true: false,
            'message' => $message,
            'data'    => $data,
        ];

        switch (true) {
            case $statusCode === null:
                $headerCode = ($success) ? 200 : 400;
                break;
            default:
                $headerCode = $statusCode;
                break;
        }

        if(!$success) $content['errorCode'] = $errorCode;

        return compact('headerCode', 'content');
    }

    /**
     *
     * @param string $message Filename of setting and index (example: organization.create)
     * @param array|bool|object $data Required data [] or false to return error message
     * @param null $statusCode
     * @param null $errorCode
     * @return Response|Application|ResponseFactory
     */
    protected function response(string $message, array|bool|object $data = [], $forceFail = false, $statusCode = null, $errorCode = null): Response|Application|ResponseFactory
    {
        if(!$data or $forceFail) {
            $data = $forceFail? $data: [];
            $message  = __($message . '.fail');
            $response = $this->content($message, $data, false, $statusCode, $errorCode);
        }else{
            if(!is_array($data) and is_bool($data)) $data = [];
            if(is_object($data)) $data = $data->toArray();
            $message  = __($message.'.success');
            $response = $this->content($message, $data, true, $statusCode);
        }

        return response($response['content'], $response['headerCode']);
    }
}
