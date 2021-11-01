<?php
/**
 * The signatureCheck request model
 * @author    Remo Siegenthaler <remo.siegenthaler@zahls.ch>
 * @copyright 2017 Zahls AG
 * @since     v1.0
 */
namespace Zahls\Models\Request;

/**
 * Class SignatureCheck
 * @package Zahls\Models\Request
 */
class SignatureCheck extends \Zahls\Models\Base
{
    /**
     * {@inheritdoc}
     */
    public function getResponseModel()
    {
        return new \Zahls\Models\Response\SignatureCheck();
    }
}
