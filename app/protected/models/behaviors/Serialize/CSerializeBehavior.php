<?php
/**
 * CSerializeBehavior class file.
 *
 * @author samokspv <samokpsv@yandex.ru>
 * @license http://www.yiiframework.com/license/
 */

abstract class CSerializeBehavior extends CActiveRecordBehavior
{
    /**
     * @var array The name of the attribute(s) to serialize/unserialize
     */
    public $serialAttributes = array();
}