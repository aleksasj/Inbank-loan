<?php

namespace App\Src;

class LoanTypes
{
    const TYPE_PDF = 'pdf';
    const TYPE_HTML = 'html';
    const TYPE_JSON = 'json';

    static public $availableTypes = [
        self::TYPE_PDF,
        self::TYPE_HTML,
        self::TYPE_JSON,
    ];
}
