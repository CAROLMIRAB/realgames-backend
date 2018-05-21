<?php

namespace App\Core;

class Utils
{
    /**
     * Create the response
     *
     * @param string $status    Response status
     * @param string $code      Status code
     * @param array  $data      Response data
     * @return \Symfony\Component\HttpFoundation\Response
     * @author  Arniel Serrano
     * @author  Eborio Linarez
     * @author  Elio Martins
     * @author  Luis Suarez
     */
    public static function createResponse($status, $code, $data)
    {
        $response = [
            'status' => $status,
            'code' => $code,
            'data' => $data
        ];
        return response()->json($response);
    }
}
