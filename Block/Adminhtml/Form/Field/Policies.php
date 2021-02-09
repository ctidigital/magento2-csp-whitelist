<?php

namespace CtiDigital\CspWhitelist\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\BlockInterface;

class Policies extends AbstractFieldArray
{
    /** @var BlockInterface */
    private $typeRenderer;

    /**
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _prepareToRender()
    {
        $this->addColumn('policy', [
            'label' => __('Policy Type'),
            'class' => 'required-entry',
            'renderer' => $this->getTypeRenderer(),
        ]);
        $this->addColumn('value', ['label' => __('Value'), 'class' => 'required-entry']);

        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }

    /**
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     * @param DataObject $row
     */
    protected function _prepareArrayRow(DataObject $row)
    {
        $options = [];
        $policy = $row->getPolicy();
        if ($policy !== null) {
            $options['option_' . $this->getTypeRenderer()->calcOptionHash($policy)] = 'selected="selected"';
        }
        $row->setData('option_extra_attrs', $options);
    }

    /**
     * @return BlockInterface
     */
    private function getTypeRenderer(): BlockInterface
    {
        if (!$this->typeRenderer) {
            try {
                $this->typeRenderer = $this->getLayout()->createBlock(
                    TypeColumn::class,
                    '',
                    ['data' => ['is_render_to_js_template' => true]]
                );
            } catch (LocalizedException $e) {
                return $this->typeRenderer;
            }
        }
        return $this->typeRenderer;
    }
}
