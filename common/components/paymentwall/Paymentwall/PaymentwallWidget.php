<?php
namespace common\components\paymentwall\Paymentwall;

use common\components\paymentwall\Paymentwall\Signature\PaymentwallSignatureAbstract;
use common\components\paymentwall\Paymentwall\Signature\PaymentwallSignatureWidget;

class PaymentwallWidget extends PaymentwallInstance
{
    const CONTROLLER_PAYMENT_VIRTUAL_CURRENCY = 'ps';
    const CONTROLLER_PAYMENT_DIGITAL_GOODS = 'subscription';
    const CONTROLLER_PAYMENT_CART = 'cart';

    protected $userId;
    protected $widgetCode;
    protected $products;
    protected $extraParams;

    public function __construct($userId, $widgetCode = '', $products = array(), $extraParams = array())
    {
        $this->userId = $userId;
        $this->widgetCode = $widgetCode;
        $this->products = $products;
        $this->extraParams = $extraParams;
    }

    public function getUrl()
    {
        $params = array(
            'key' => $this->getPublicKey(),
            'uid' => $this->userId,
            'widget' => $this->widgetCode
        );

        $productsNumber = count($this->products);

        if ($this->getApiType() == PaymentwallConfig::API_GOODS) {

            if (!empty($this->products)) {

                if ($productsNumber == 1) {

                    $product = current($this->products);

                    if ($product->getTrialProduct() instanceof PaymentwallProduct) {
                        $postTrialProduct = $product;
                        $product = $product->getTrialProduct();
                    }

                    $params['amount'] = $product->getAmount();
                    $params['currencyCode'] = $product->getCurrencyCode();
                    $params['ag_name'] = $product->getName();
                    $params['ag_external_id'] = $product->getId();
                    $params['ag_type'] = $product->getType();

                    if ($product->getType() == PaymentwallProduct::TYPE_SUBSCRIPTION) {
                        $params['ag_period_length'] = $product->getPeriodLength();
                        $params['ag_period_type'] = $product->getPeriodType();
                        if ($product->isRecurring()) {

                            $params['ag_recurring'] = intval($product->isRecurring());

                            if (isset($postTrialProduct)) {
                                $params['ag_trial'] = 1;
                                $params['ag_post_trial_external_id'] = $postTrialProduct->getId();
                                $params['ag_post_trial_period_length'] = $postTrialProduct->getPeriodLength();
                                $params['ag_post_trial_period_type'] = $postTrialProduct->getPeriodType();
                                $params['ag_post_trial_name'] = $postTrialProduct->getName();
                                $params['post_trial_amount'] = $postTrialProduct->getAmount();
                                $params['post_trial_currencyCode'] = $postTrialProduct->getCurrencyCode();
                            }

                        }
                    }

                } else {
                    //TODO: $this->appendToErrors('Only 1 product is allowed in flexible widget call');
                }

            }

        } else {
            if ($this->getApiType() == PaymentwallConfig::API_CART) {

                $index = 0;
                foreach ($this->products as $product) {
                    $params['external_ids[' . $index . ']'] = $product->getId();

                    if (isset($product->amount)) {
                        $params['prices[' . $index . ']'] = $product->getAmount();
                    }
                    if (isset($product->currencyCode)) {
                        $params['currencies[' . $index . ']'] = $product->getCurrencyCode();
                    }

                    $index++;
                }
                unset($index);
            }
        }

        $params['sign_version'] = $signatureVersion = $this->getDefaultSignatureVersion();

        if (!empty($this->extraParams['sign_version'])) {
            $signatureVersion = $params['sign_version'] = $this->extraParams['sign_version'];
        }

        $params = array_merge($params, $this->extraParams);

        $widgetSignatureModel = new PaymentwallSignatureWidget();
        $params['sign'] = $widgetSignatureModel->calculate(
            $params,
            $signatureVersion
        );

        return $this->getApiBaseUrl() . '/' . $this->buildController($this->widgetCode) . '?' . http_build_query($params);
    }

    public function getHtmlCode($attributes = array())
    {
        $defaultAttributes = array(
            'frameborder' => '0',
            'width' => '750',
            'height' => '800'
        );

        $attributes = array_merge($defaultAttributes, $attributes);

        $attributesQuery = '';
        foreach ($attributes as $attr => $value) {
            $attributesQuery .= ' ' . $attr . '="' . $value . '"';
        }

        return '<iframe src="' . $this->getUrl() . '" ' . $attributesQuery . '></iframe>';

    }

    protected function getDefaultSignatureVersion()
    {
        return $this->getApiType() != PaymentwallConfig::API_CART ? PaymentwallSignatureAbstract::DEFAULT_VERSION : PaymentwallSignatureAbstract::VERSION_TWO;
    }

    protected function buildController($widget = '')
    {
        $controller = null;
        $isPaymentWidget = !preg_match('/^w|s|mw/', $widget);

        if ($this->getApiType() == PaymentwallConfig::API_VC) {
            if ($isPaymentWidget) {
                $controller = self::CONTROLLER_PAYMENT_VIRTUAL_CURRENCY;
            }
        } else {
            if ($this->getApiType() == PaymentwallConfig::API_GOODS) {
                /**
                 * @todo cover case with offer widget for digital goods for non-flexible widget call
                 */
                $controller = self::CONTROLLER_PAYMENT_DIGITAL_GOODS;
            } else {
                $controller = self::CONTROLLER_PAYMENT_CART;
            }
        }

        return $controller;
    }
}
