<?php

namespace Zahls\Models\Response;

class QrCode extends \Zahls\Models\Request\QrCode
{
    /** @var string */
    protected $qrCode;

    /**
     * @return string
     */
    public function getQrCode(): string
    {
        return $this->qrCode;
    }

    /**
     * @param string $qrCode
     * @return void
     */
    public function setQrCode(string $qrCode): void
    {
        $this->qrCode = $qrCode;
    }
}
