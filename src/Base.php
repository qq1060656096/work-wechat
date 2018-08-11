<?php
namespace Zwei\WorkWechat;


class Base
{
    /**
     * 获取所有属性
     *
     * @return array
     */
    public function getAttributes() {
        return [
        ];
    }


    /**
     * 获取所有属性值
     *
     * @return array
     */
    public function getAttributesValues() {
        $attributes = $this->getAttributes();
        $values = [];
        foreach ($attributes as $attribute => $label) {
            $values[$attribute] = isset($this->$attributes) ? $this->$attribute: null;
        }
        return $values;
    }
}