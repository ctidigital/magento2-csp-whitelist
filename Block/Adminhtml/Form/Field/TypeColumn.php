<?php

namespace CtiDigital\CspWhitelist\Block\Adminhtml\Form\Field;

use CtiDigital\CspWhitelist\Model\Source\Type;
use Magento\Framework\View\Element\Context;
use Magento\Framework\View\Element\Html\Select;

class TypeColumn extends Select
{

    /** @var Type */
    private $type;

    /**
     * @param Context $context
     * @param Type $type
     * @param array $data
     */
    public function __construct(
        Context $context,
        Type $type,
        array $data = []
    ) {
        $this->type = $type;
        parent::__construct($context, $data);
    }

    /**
     * Set "name" for <select> element
     *
     * @param string $value
     * @return $this
     */
    public function setInputName(string $value): TypeColumn
    {
        return $this->setName($value);
    }

    /**
     * Set "id" for <select> element
     *
     * @param $value
     * @return $this
     */
    public function setInputId($value): TypeColumn
    {
        return $this->setId($value);
    }

    /**
     * Render block HTML
     *
     * @return string
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    public function _toHtml(): string
    {
        if (!$this->getOptions()) {
            $this->setOptions($this->type->toOptionArray());
        }
        return parent::_toHtml();
    }
}
