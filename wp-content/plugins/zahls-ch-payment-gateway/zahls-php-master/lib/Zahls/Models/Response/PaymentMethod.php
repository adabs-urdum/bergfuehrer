<?php

/**
 * PaymentMethod response model
 *
 * @copyright   Zahls AG
 * @author      Zahls Development Team <info@zahls.com>
 */
namespace Zahls\Models\Response;

/**
 * PaymentMethod class
 *
 * @package Zahls\Models\Response
 */
class PaymentMethod extends \Zahls\Models\Request\PaymentMethod
{
    /** @var string */
    protected $name;

    /** @var array */
    protected $label;

    /** @var array */
    protected $logo;

    /** @var array */
    protected $options_by_psp;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getLabel(): array
    {
        return $this->label;
    }

    /**
     * @param array $label
     */
    public function setLabel(array $label): void
    {
        $this->label = $label;
    }

    /**
     * @return array
     */
    public function getLogo(): array
    {
        return $this->logo;
    }

    /**
     * @param array $logo
     */
    public function setLogo(array $logo): void
    {
        $this->logo = $logo;
    }

    /**
     * @return array
     */
    public function getoptions_by_psp(): array
    {
        return $this->options_by_psp;
    }

    /**
     * @param array $options_by_psp
     */
    public function setoptions_by_psp(array $options_by_psp): void
    {
        $this->options_by_psp = $options_by_psp;
    }
}
