<?php

namespace CtiDigital\CspWhitelist\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Type extends AbstractSource
{
    const SOURCE_DEFAULT = 'default-src';
    const SOURCE_BASE = 'base-uri';
    const SOURCE_CHILD = 'child-src';
    const SOURCE_CONNECT = 'connect-src';
    const SOURCE_FONT = 'font-src';
    const SOURCE_FORM = 'form-action';
    const SOURCE_FRAME_ANCESTORS = 'frame-ancestors';
    const SOURCE_FRAME = 'frame-src';
    const SOURCE_IMG = 'img-src';
    const SOURCE_MANIFEST = 'manifest-src';
    const SOURCE_MEDIA = 'media-src';
    const SOURCE_OBJECT = 'object-src';
    const SOURCE_SCRIPT = 'script-src';
    const SOURCE_STYLE = 'style-src';

    /**
     * @return array[]|null
     */
    public function getAllOptions(): ?array
    {
        if ($this->_options === null) {
            $this->_options = [
                ['label' => __('default-src') , 'value' => self::SOURCE_DEFAULT],
                ['label' => __('base-uri') , 'value' => self::SOURCE_BASE],
                ['label' => __('child-src') , 'value' => self::SOURCE_CHILD],
                ['label' => __('connect-src') , 'value' => self::SOURCE_CONNECT],
                ['label' => __('font-src') , 'value' => self::SOURCE_FONT],
                ['label' => __('form-action') , 'value' => self::SOURCE_FORM],
                ['label' => __('frame-ancestors') , 'value' => self::SOURCE_FRAME_ANCESTORS],
                ['label' => __('frame-src') , 'value' => self::SOURCE_FRAME],
                ['label' => __('img-src') , 'value' => self::SOURCE_IMG],
                ['label' => __('manifest-src') , 'value' => self::SOURCE_MANIFEST],
                ['label' => __('media-src') , 'value' => self::SOURCE_MEDIA],
                ['label' => __('object-src') , 'value' => self::SOURCE_OBJECT],
                ['label' => __('script-src') , 'value' => self::SOURCE_SCRIPT],
                ['label' => __('style-src') , 'value' => self::SOURCE_STYLE]
            ];
        }
        return $this->_options;
    }
}
