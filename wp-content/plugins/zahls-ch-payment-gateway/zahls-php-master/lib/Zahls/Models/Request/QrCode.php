<?php

namespace Zahls\Models\Request;


class QrCode extends \Zahls\Models\Base
{
    /**
     * mandatory
     *
     * @access  protected
     * @var     string
     */
    protected $webshopUrl;

    /**
     * @access  public
     * @return  string
     */
    public function getWebshopUrl(): string
    {
        return $this->webshopUrl;
    }

    /**
     * @access  public
     * @param   string   $webshopUrl
     * @return  void
     */
    public function setWebshopUrl(string $webshopUrl): void
    {
        $this->webshopUrl = $webshopUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function getResponseModel()
    {
        return new \Zahls\Models\Response\QrCode();
    }
}