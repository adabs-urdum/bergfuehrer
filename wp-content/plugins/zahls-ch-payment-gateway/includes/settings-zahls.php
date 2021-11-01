<?php
$settings = array(
  'enabled' => array(
    'title' => __('Activate', 'zahls-ch-payment-gateway'),
    'type' => 'checkbox',
    'label' => __('Activate zahls.ch', 'zahls-ch-payment-gateway'),
    'default' => 'no',
  ),
  'title' => array(
    'title' => __('Title', 'zahls-ch-payment-gateway'),
    'type' => 'text',
    'custom_attributes' => array('required' => 'required'),
    'description' => __('This controls the title which the user sees during checkout.', 'woocommerce'),
    'default' => __('Credit Cards / TWINT', 'zahls-ch-payment-gateway'),
    'desc_tip' => true,
  ),
  'description' => array(
    'title' => __('Description', 'woocommerce'),
    'type' => 'textarea',
    'css'  => 'width:400px;',
    'description' => __('This controls the description which the user sees during checkout.', 'woocommerce'),
    'default' => __(get_option("woocommerce_zahls_description"), 'woocommerce'),
    'desc_tip' => true,
  ),
  'instance' => array(
    'title' => __('Instance', 'zahls-ch-payment-gateway'),
    'type' => 'text',
    'custom_attributes' => array('required' => 'required'),
    'description' => __('Enter your INSTANCE, without .zahls.ch (INSTANCE.zahls.ch).', 'zahls-ch-payment-gateway'),
    'default' => __(str_replace(".zahls.ch", "", get_option("woocommerce_zahls_instance")), 'zahls-ch-payment-gateway'),
    'desc_tip' => true,
  ),
  'sid' => array(
    'title' => __('API key', 'zahls-ch-payment-gateway'),
    'type' => 'text',
    'custom_attributes' => array('required' => 'required'),
    'description' => __('Copy your API key from the backend of zahls.ch.', 'zahls-ch-payment-gateway'),
    'default' => __(get_option("woocommerce_zahls_sid"), 'zahls-ch-payment-gateway'),
    'desc_tip' => true,
  ),
  'lookAndFeelId' => array(
    'title' => __('Look&Feel ID', 'zahls-ch-payment-gateway'),
    'type' => 'text',

    'description' => __('Enter the Look&Feel ID from the backend of zahls.ch to customise the appearance of zahls.ch.', 'zahls-ch-payment-gateway'),
    'default' => __(get_option("woocommerce_zahls_sid"), 'zahls-ch-payment-gateway'),
    'desc_tip' => true,
  ),
  'prefix' => array(
    'title' => __('Prefix', 'zahls-ch-payment-gateway'),
    'type' => 'text',
    'custom_attributes' => array(),
    'description' => __('Enter a prefix to distinguish payments via this shop from other shops.', 'zahls-ch-payment-gateway'),
    'default' => __(get_option("woocommerce_zahls_prefix"), 'zahls-ch-payment-gateway'),
    'desc_tip' => true,
  ),
  'logos' => array(
    'title' => __('Logos', 'zahls-ch-payment-gateway'),
    'type' => 'multiselect',
    'css'  => 'height: 400px;width:400px;',
    'description' => __('Logos of payment providers to be displayed to the customer.', 'zahls-ch-payment-gateway'),
    'default' => __(get_option("woocommerce_zahls_logos"), 'zahls-ch-payment-gateway'),
    'desc_tip' => true,
    'options' => array(
      'twint' => 'TWINT',
      'mastercard' => 'Mastercard',
      'visa' => 'Visa',
      'apple_pay' => 'Apple Pay',
    'google_pay' => 'Google Pay',    
      'maestro' => 'Maestro',
      'jcb' => 'JCB',
      'american_express' => 'American Express',
      'wirpay' => 'WIRpay',
      'paypal' => 'PayPal',
      'bitcoin' => 'Bitcoin',
      'sofortueberweisung_de' => 'Sofort Überweisung',
      'airplus' => 'Airplus',
      'billpay' => 'Billpay',
      'bonuscard' => 'Bonus card',
      'cashu' => 'CashU',
      'cb' => 'Carte Bleue',
      'diners_club' => 'Diners Club',
      'direct_debit' => 'Direct Debit',
      'discover' => 'Discover',
      'elv' => 'ELV',
      'ideal' => 'iDEAL',
      'invoice' => 'Invoice',
      'myone' => 'My One',
      'paysafecard' => 'Paysafe Card',
      'postfinance_card' => 'PostFinance Card',
      'postfinance_efinance' => 'PostFinance E-Finance',
      'swissbilling' => 'SwissBilling',
      'barzahlen' => 'Barzahlen/Viacash',
      'bancontact' => 'Bancontact',
      'giropay' => 'GiroPay',
      'eps' => 'EPS',      
      'antepay' => 'AntePay',
      'paysafecash' => 'Paysafe Cash',
     'masterpass' => 'Masterpass',
      'bob-invoice' => 'Kauf auf Rechnung',
    )
  )
);

if (class_exists('\WC_Subscriptions')) {
  $settings = array_merge($settings, array(
    'subscriptions_enabled' => array(
      'title' => __('Enable/Disable Subscriptions', 'zahls-ch-payment-gateway'),
      'type' => 'checkbox',
      'label' => __('Enable recurring payments for customers when subscriptions are purchased', 'zahls-ch-payment-gateway'),
      'default' => 'no',
    ),
    'subscriptions_user_desc' => array(
      'title' => __('Description Checkbox', 'woocommerce'),
      'type' => 'textarea',
      'css'  => 'width:400px;',
      'description' => __('This controls the description which the user sees besides the checkbox to activate recurring payments for a subscription. Checkbox shows only if the feature is active and a subscription is purchased.', 'woocommerce'),
      'default' =>  __(get_option("woocommerce_zahls_subscriptions_user_desc"), 'zahls-ch-payment-gateway'),
      'desc_tip' => true,
    ),
    'subscription_logos' => array(
      'title' => __('Recurring payment logo', 'zahls-ch-payment-gateway'),
      'type' => 'multiselect',
      'css'  => 'height: 100px;width:400px;',
      'description' => __('This controls the payment method logos for recurring payments.', 'zahls-ch-payment-gateway'),
      'default' => __(get_option("woocommerce_zahls_subscription_logos"), 'zahls-ch-payment-gateway'),
      'desc_tip' => true,
      'options' => array(
        'mastercard' => 'Mastercard',
        'visa' => 'Visa',
        'american_express' => 'American Express',
        'postfinance_card' => 'PostFinance Card'
      )
    )
  ));
}
return apply_filters('wc_offline_form_fields', $settings);
