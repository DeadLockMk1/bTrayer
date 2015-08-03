<?php
/**
 * CBase64Behavior class file.
 *
 * @author samokspv <samokpsv@yandex.ru>
 * @license http://www.yiiframework.com/license/
 */

/**
 * CBase64Behavior allows a model to specify some attributes to be
 * string and base64_encode upon save and base64_decode after a Find() function
 * is called on the model.
 *
 *<pre>
 * public function behaviors()
 *  {
 *      return array(
 *          'CBase64Behavior' => array(
 *              'class' => 'application.behaviors.CBase64Behavior',
 *              'serialAttributes' => array('validator_options'),
 *          )
 *      );
 *  }
 * </pre>
 */
class CBase64Behavior extends CSerializeBehavior
{
    /**
     * {@inheritdoc}
     */
    public function beforeSave($event)
    {
        if (count($this->serialAttributes)) {
            foreach ($this->serialAttributes as $attribute) {
                $_att = $this->getOwner()->$attribute;
                $this->getOwner()->$attribute = base64_encode($_att);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function afterSave($event)
    {
        if (count($this->serialAttributes)) {
            foreach ($this->serialAttributes as $attribute) {
                $_att = $this->getOwner()->$attribute;
                if (!empty($_att)) {
                    $a = base64_decode($_att);
                    if ($a !== false) {
                        $this->getOwner()->$attribute = $a;
                    } else {
                        $this->getOwner()->$attribute = '';
                    }
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function afterFind($event)
    {
        if (count($this->serialAttributes)) {
            foreach ($this->serialAttributes as $attribute) {
                $_att = $this->getOwner()->$attribute;
                if (!empty($_att)) {
                    $a = base64_decode($_att);
                    if ($a !== false) {
                        $this->getOwner()->$attribute = $a;
                    } else {
                        $this->getOwner()->$attribute = '';
                    }
                }
            }
        }
    }
}
