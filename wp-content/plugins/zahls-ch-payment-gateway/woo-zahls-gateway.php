<?php
/**
 * Plugin Name: zahls.ch Credit Cards and TWINT for WooCommerce
 * Description: Integration of payment options from zahls.ch in WooCommerce
 * Author: siebenberge gmbh
 * Author URI: https://www.siebenberge.com
 * Text Domain: zahls-ch-payment-gateway
 * Version: 1.1.4
 * Requires at least: 4.6
 * Tested up to: 5.9
 * WC requires at least: 4.0
 * WC tested up to: 5.9
 */

if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) return;

add_action('plugins_loaded', 'WC_Zahls_offline_gateway_init', 11);

function WC_Zahls_offline_gateway_init()
{
    class WC_Zahls_Gateway extends WC_Payment_Gateway
    {
        public $enabled;
        public $title;
        public $description;
        public $instance;
        public $sid;
		public $platform;
        public $apiKey;
        public $prefix;
        public $logos;
        public $lang;

        public function __construct()
        {
            $this->lang = ['en', 'de', 'it', 'fr', 'nl', 'pt', 'tr'];
            $this->id = 'zahls';
            $this->method_title = __('zahls.ch', 'zahls-ch-payment-gateway');
            $this->method_description = __('Accept payments with zahls.ch.', 'zahls-ch-payment-gateway');


            // Add subscription support if activated
            if ($this->get_option('subscriptions_enabled') === 'yes') {
                $this->supports = array_merge($this->supports, array(
                    'subscriptions',
                    'subscription_cancellation',
                    'subscription_suspension',
                    'subscription_reactivation',
                    'subscription_amount_changes',
                    'subscription_date_changes',
                    'subscription_payment_method_change',
                    'subscription_payment_method_change_customer',
                    'subscription_payment_method_change_admin',
                    'multiple_subscriptions',
                ));
                // Filter to extend description with recurring payment checkbox
                add_filter('woocommerce_gateway_description', array($this, 'extend_subscriptions_checkbox'), 10, 2);
            }
            
            $this->init_form_fields();
            $this->init_settings();

            $this->enabled = $this->get_option('enabled');
            $this->title = $this->get_option('title');
            $this->description = $this->get_option('description');
            
            
            $this->instance  	= $this->get_option('instance');
			$this->platform = "zahls.ch";
            
            $this->instance = str_replace(".zahls.ch", "", $this->instance);
            $this->instance = str_replace(".ch", "", $this->instance);
            
            $this->sid = $this->get_option('sid');
			$this->apiKey = !empty($this->get_option('apiKey')) ? $this->get_option('apiKey') : $this->get_option('sid');
            $this->prefix = $this->get_option('prefix');
            $this->logos = $this->get_option('logos');
            $this->lookAndFeelId = $this->get_option('lookAndFeelId');

            if (isset($_GET['zahls_error'])) {
                wc_print_notice(__('Payment failed', 'zahls-ch-payment-gateway'), 'error');
            }



            add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
            add_action('woocommerce_api_wc_zahls_gateway', array($this, 'check_webhook_response'));
            add_action('woocommerce_scheduled_subscription_payment_' . $this->id, array($this, 'process_recurring_payment'), 10, 2);
        }
        
        
        
        
        
        	/**
	 * Admin Panel Options
	 * - Options for bits like 'title' and availability on a country-by-country basis
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function admin_options() {
        
            $urlparts = parse_url(home_url());
            $domain = $urlparts['host'];
        
		?>
		<h2><?php _e( 'zahls.ch Settings', 'zahls-ch-payment-gateway' ); wc_back_link( __( 'Return to payments', 'woocommerce' ), admin_url( 'admin.php?page=wc-settings&tab=checkout' ) ); ?></h2>
			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content">
						<table class="form-table">
							<?php $this->generate_settings_html();?>
	
						</table><!--/.form-table-->
						
						
							
						<div style="display: block; margin: 20px 0 0 0; padding: 10px; background-color: #3f245c; color: #fff;">
						
						<div style="font-size: 20px; padding: 10px 0 10px 0;"><i class="dashicons dashicons-arrow-right-alt"></i> <b><?php _e('Order status sync with zahls.ch', 'zahls-ch-payment-gateway'); ?></b></div>
							<p><?php _e('Please copy this Webhook URL to the section "Webhooks" in your zahls.ch backend to sync the payment status of your orders.', 'zahls-ch-payment-gateway'); ?> </p>
							<p><input style="background-color:  #fff; border: 1px solid #000; width: 100%; padding: 5px; font-size: 20px;" type="input" value="<?php echo get_site_url()."/?wc-api=wc_zahls_gateway"; ?>" readonly></p>
							<p><a href="https://login.zahls.ch" target="_blank" style="color: #fff;"><?php _e('Open your zahls.ch backend.', 'zahls-ch-payment-gateway'); ?></a></p>
					</div>
					</div>
					<div id="postbox-container-1" class="postbox-container">
	                        <div id="side-sortables" class="meta-box-sortables ui-sortable"> 
                                
                                
                                
                                        <div class="postbox">
	                                <h3 class="hndle"><span><i class="dashicons dashicons-superhero-alt"></i>&nbsp;&nbsp;<?php _e('zahls.ch for credit cards and TWINT', 'zahls-ch-payment-gateway'); ?></span></h3>
                                    <hr>
	                                <div class="inside">
	                                    <div class="support-widget">
	                                        <p><?php _e('Thank you for using zahls.ch. You need to have an account from zahls.ch to use this payment gateway for your transcations. You can get a free account on', 'zahls-ch-payment-gateway'); ?> <a href="https://www.zahls.ch" target="_blank">www.zahls.ch</a>.</p>                                        

	                                    </div>
	                                </div>
	                            </div>
								
							                          

	                            <div class="postbox">
	                                <h3 class="hndle"><span><i class="dashicons dashicons-editor-help"></i>&nbsp;&nbsp;<?php _e('Support', 'zahls-ch-payment-gateway'); ?></span></h3>
                                    <hr>
	                                <div class="inside">
	                                    <div class="support-widget">
	                                        <p>
	                                        <img style="width: 70%;margin: 0 auto;position: relative;display: inherit;" src="https://static.siebenberge.com/media/plugins/woocommerce/<?php echo $domain; ?>/zahls.svg">
	                                        <br/>
                                            <?php _e('Do you have a question, idea, problem or praise? Please feel free to contact us.', 'zahls-ch-payment-gateway'); ?>    
	                                        </p>
                                            <p><a href="mailto:info@zahls.ch" target="_blank">info@zahls.ch</a><br>
<a href="https://www.zahls.ch" target="_blank">www.zahls.ch</a></p>
                                            
                                            
	                                        <p style="margin-bottom: 0;"><?php _e('Please leave us a ', 'zahls-ch-payment-gateway'); ?>  <a target="_blank" href="https://wordpress.org/support/view/plugin-reviews/zahls-ch-payment-gateway?filter=5#postform">★★★★★</a> <?php _e('rating', 'zahls-ch-payment-gateway'); ?>.</p>

	                                    </div>
	                                </div>
	                            </div>
	                       
	    <?php /*   coming soon                      <div class="postbox rss-postbox">
	    								<h3 class="hndle"><span><i class="fa fa-wordpress"></i>&nbsp;&nbsp;sb_zahls Blog</span></h3>
                                        <hr>
	    								<div class="inside">
											<div class="rss-widget">
												<?php
	    											wp_widget_rss_output(array(
	    													'url' => 'https://www.zahls.ch/feed/',
	    													'title' => 'zahls.ch Blog',
	    													'items' => 3,
	    													'show_summary' => 0,
	    													'show_author' => 0,
	    													'show_date' => 1,
	    											));
	    										?>
	    									</div>
	    								</div>
	    						</div> */?>

	                        </div>
	                    </div>
                    </div>
				</div>
				<div class="clear"></div>
				<style type="text/css">
				.sb_zahls_button{
					background-color:#4CAF50 !important;
					border-color:#4CAF50 !important;
					color:#ffffff !important;
					width:100%;
					text-align:center;
					height:35px !important;
					font-size:12pt !important;
				}
                .sb_zahls_button .dashicons {
                    padding-top: 5px;
                }
				</style>
				<?php
	}
        
        
        
        
        
        

     /*    public function register_autoloader()
        {
            spl_autoload_register(function ($class) {
                $root = __DIR__ . '/zahls-php-master';
                $classFile = $root . '/lib/' . str_replace('\\', '/', $class) . '.php';
                if (file_exists($classFile)) {
                    require_once $classFile;
                }
            });
        } */

        public function get_icon()
        {
            $style = version_compare(WC()->version, '2.6', '>=') ? 'style="margin-left: 0.3em"' : '';

            $icon = '';
            if($this->logos){
            foreach ($this->logos as $logo) {
                $icon .= '<img src="' . WC_HTTPS::force_https_url(plugins_url('cardicons/card_' . $logo . '.svg', __FILE__)) . '" alt="' . $logo . '" id="' . $logo . '" width="32" ' . $style . ' />';
            }}

            // Add a wrapper around the images to allow styling
            return apply_filters('woocommerce_gateway_icon', '<span class="icon-wrapper">' . $icon . '</span>', $this->id);
        }
        
      

        /**
         * Initialize Gateway Settings Form Fields
         */
        public function init_form_fields()
        {
            $this->form_fields = include('includes/settings-zahls.php');
        }

        public function process_payment($order_id)
        {
            $order = wc_get_order($order_id);
            // Return thankyou redirect
            return array(
                'result' => 'success',
                'redirect' => $this->get_zahls_gateway($order)
            );
        }

        public function payment_scripts()
        {
            if (!is_cart() && !is_checkout() && !isset($_GET['pay_for_order']) && !is_add_payment_method_page()) {
                return;
            }
        }

        public function check_webhook_response()
        {
            try {
                $resp = add_magic_quotes($_REQUEST);
                $orderId = $resp['transaction']['invoice']['referenceId'];

                if (!empty($this->prefix) && strpos($orderId, $this->prefix) === false) {
                    return;
                }

                $arr = explode('_', $orderId);
                $orderId = end($arr);

                if (!isset($resp['transaction']['status'])) {
                    throw new \Exception('Missing transaction status');
                }


                $status = $this->get_zahls_status($resp['transaction']['id']);
                if ($status !== $resp['transaction']['status']) {
                    throw new \Exception('Fraudulent transaction status');
                }
                $order = new WC_Order($orderId);

                if (!$order) {
                    throw new \Exception('Fraudulent request');
                }
				
				$this->register_autoloader();
				
                switch ($status) {
                    case \Zahls\Models\Response\Transaction::WAITING:
                        $newTransactionsStatus = 'on-hold';
                        $newTransactionsStatus = $this->getCustomTransactionStatus($newTransactionsStatus);
                        if (!in_array($resp['transaction']['psp'], ['PrePayment', 'Invoice', 'Reka', 'Sofort'])
                            || substr($resp['transaction']['payment']['brand'], 0, 6) !== 'sofort') {
                            break;
                        }

                        if ($order->get_status() === $newTransactionsStatus) {
                            break;
                        }

                        $order->update_status($newTransactionsStatus, __('Awaiting payment', 'zahls-ch-payment-gateway'));
                        break;
                    case \Zahls\Models\Response\Transaction::CONFIRMED:
                        if ($order->has_status(['processing', 'completed'])) {
                            break;
                        }

                        $order->update_meta_data('zahls_payment_method', $resp['transaction']['payment']['brand']);
                        // Save the transaction id to the subscription object for eventual recurring use
                        if (isset($resp['transaction']['preAuthorizationId'])) {
                            $order->update_meta_data('zahls_auth_transaction_id', $resp['transaction']['preAuthorizationId']);
                        }

                        $order->payment_complete();
                        // Remove cart
                        WC()->cart->empty_cart();
                        break;
                    case \Zahls\Models\Response\Transaction::REFUNDED:
                        $newTransactionsStatus = 'refunded';
                        $newTransactionsStatus = $this->getCustomTransactionStatus($newTransactionsStatus);
                        if ($order->get_status() === $newTransactionsStatus) {
                            break;
                        }
                        $order->update_status($newTransactionsStatus, __('Payment was fully refunded', 'zahls-ch-payment-gateway'));
                        break;
//                    case \Zahls\Models\Response\Transaction::PARTIALLY_REFUNDED:
//                        if ($order->get_status() === 'refunded') {
//                            break;
//                        }
//                        $order->update_status('refunded', __('Payment was partially refunded', 'zahls-ch-payment-gateway'));
//                        break;
                    case \Zahls\Models\Response\Transaction::CANCELLED:
                    case \Zahls\Models\Response\Transaction::EXPIRED:
                    case \Zahls\Models\Response\Transaction::DECLINED:
                        $newTransactionsStatus = 'cancelled';
                        $newTransactionsStatus = $this->getCustomTransactionStatus($newTransactionsStatus);

                        if ($order->has_status(['processing', 'completed', $newTransactionsStatus])) {
                            break;
                        }

                        $order->update_status($newTransactionsStatus, __('Payment was cancelled by the customer', 'zahls-ch-payment-gateway'));
                        break;
                    case \Zahls\Models\Response\Transaction::ERROR:
                        $newTransactionsStatus = 'failed';
                        $newTransactionsStatus = $this->getCustomTransactionStatus($newTransactionsStatus);
                        if ($order->has_status(['processing', 'completed', $newTransactionsStatus])) {
                            break;
                        }
                        $order->update_status($newTransactionsStatus, __('An error occured while processing this payment', 'zahls-ch-payment-gateway'));
                        break;
                }
            } catch (\Exception $e) {
                if (defined('WP_DEBUG') && true === WP_DEBUG) {
                throw new \Exception($e->getMessage());
                }
            }
        }

        public function get_zahls_gateway($order_id)
        {
            $productPriceIncludesTax = ('yes' === get_option( 'woocommerce_prices_include_tax'));
			
            $order = new WC_Order($order_id);
            $totalAmount = floatval($order->get_total());
            $currency = get_woocommerce_currency();

            $basketAmount = 0;

            $cartItems = WC()->cart->get_cart();
            $products = [];
            foreach ($cartItems as $item) {
                $amount = $item['data']->get_price();
                $basketAmount += $amount;
                $products[] = [
                    'name' => $item['data']->get_title(),
                    'description' => $item['data']->get_short_description(),
                    'quantity' => $item['quantity'],
                    'amount' => $amount * 100,
                    'sku' => $item['data']->get_sku(),
                ];
            }
			
            $shipping = WC()->cart->get_shipping_total();
            $shippingTax = WC()->cart->get_shipping_tax();
            if ($shipping || $shippingTax) {
                $amount = $shipping + $shippingTax;
                $basketAmount += $amount;
                $products[] = [
                    'name' => 'Shipping',
                    'quantity' => 1,
                    'amount' => $amount * 100,
                ];
            }

            $discount = WC()->cart->get_discount_total();
            $discountTax = WC()->cart->get_discount_tax();
            if ($discount) {
                $amount = $discount;
                $amount += !$productPriceIncludesTax ? 0 : $discountTax;
                $basketAmount += $amount;
                $products[] = [
                    'name' => 'Discount',
                    'quantity' => 1,
                    'amount' => $amount * -100,
                ];
            }

            $fee = WC()->cart->get_fee_total();
            $feeTax = WC()->cart->get_fee_tax();
            if ($fee) {
                $amount = $fee;
                $amount += !$productPriceIncludesTax ? 0 : $feeTax;
                $basketAmount += $amount;
                $products[] = [
                    'name' => 'Fee',
                    'quantity' => 1,
                    'amount' => $amount * 100,
                ];
            }
			
            $taxAmount = WC()->cart->get_cart_contents_tax();
            if ($taxAmount && !$productPriceIncludesTax) {
                $amount = $taxAmount;
                $basketAmount += $amount;
                $products[] = [
                    'name' => 'Tax',
                    'quantity' => 1,
                    'amount' => $amount * 100,
                ];
            }

            $first_name = $order->get_billing_first_name();
            $last_name = $order->get_billing_last_name();
            $company = $order->get_billing_company();
            $address_1 = $order->get_billing_address_1();
            $postcode = $order->get_billing_postcode();
            $city = $order->get_billing_city();
            $country = $order->get_billing_country();
            $phone = $order->get_billing_phone();
            $email = $order->get_billing_email();
			
            $zahls = $this->getZahlsInterface();
            $gateway = new \Zahls\Models\Request\Gateway();
			
            $gateway->setAmount($totalAmount * 100);
			
			

            if ($currency == "") {
                $currency = "CHF";
            }
            $gateway->setCurrency($currency);

            $gateway->setSuccessRedirectUrl($this->get_return_url($order));
            $gateway->setFailedRedirectUrl(wc_get_cart_url() . '?zahls_error=1');
            $gateway->setCancelRedirectUrl(wc_get_cart_url() . '?zahls_error=1');

            if ($totalAmount === floatval($basketAmount)) {
                $gateway->setBasket($products);
            }
            $gateway->setPsp([]);
            $gateway->setSkipResultPage(true);
            // Maybe register for tokenization
            if ($_POST['zahls-allow-recurring'] == 1) {
                $gateway->setPreAuthorization(true);
                $gateway->setChargeOnAuthorization(true);
            }

            if ($this->prefix == "") {
                $gateway->setReferenceId($order->get_id());
            } else {
                $gateway->setReferenceId($this->prefix . '_' . $order->get_id());
            }

            if ($this->lookAndFeelId != "") {
                $gateway->setLookAndFeelProfile($this->lookAndFeelId);
            }

            $gateway->addField($type = 'title', $value = '');
            $gateway->addField($type = 'forename', $value = $first_name);
            $gateway->addField($type = 'surname', $value = $last_name);
            $gateway->addField($type = 'company', $value = $company);
            $gateway->addField($type = 'street', $value = $address_1);
            $gateway->addField($type = 'postcode', $value = $postcode);
            $gateway->addField($type = 'place', $value = $city);
            $gateway->addField($type = 'country', $value = $country);
            $gateway->addField($type = 'phone', $value = $phone);
            $gateway->addField($type = 'email', $value = $email);
            $gateway->addField($type = 'custom_field_1', $value = $order->get_id(), $name = 'WooCommerce ID');

            try {
                $response = $zahls->create($gateway);
                $order->update_meta_data('zahls_gateway_id', $response->getId());
                $order->save();
				
				$language = substr(get_locale(), 0, 2);
                !in_array($language, $this->lang) ? $language = $this->lang[0] : null;
                $res = str_replace('?', $language . '/?', $response->getLink());
                return $res;
            } catch (\Zahls\ZahlsException $e) {
                print $e->getMessage();
				error_log($e->getMessage());
            }
        }


        public function get_zahls_status($transactionId)
        {
            if (!$transactionId) {
                return false;
            }

            $zahls = $this->getZahlsInterface();

            $transaction = new \Zahls\Models\Request\Transaction();
            $transaction->setId($transactionId);
            try {
                $response = $zahls->getOne($transaction);
                return $response->getStatus();
            } catch (\Zahls\ZahlsException $e) {
                print $e->getMessage();
            }
        }

        /**
         * @param float $amount
         * @param \WC_Order $renewal
         */
        public function process_recurring_payment($amount, $renewal)
        {
            $subscriptions = wcs_get_subscriptions_for_order($renewal, array('order_type' => 'any'));

            foreach ($subscriptions as $subscription) {
                $related_orders = $subscription->get_related_orders('ids');
                // Run procedure to get the last order that is not the current renewal
                $last_order_id = 0;
                foreach ($related_orders as $order_id) {
                    if ($order_id != $renewal->ID) {
                        $last_order_id = $order_id;
                    }
                }

                // Get transaction id from the last order
                $transaction_id = intval(get_post_meta($last_order_id, 'zahls_auth_transaction_id', true));

                // Both must be given to do a valid recurring transaction
                if ($last_order_id > 0 && $transaction_id > 0) {

                    $zahls = $this->getZahlsInterface();
                    $transaction = new \Zahls\Models\Request\Transaction();
                    $transaction->setId($transaction_id);
                    $transaction->setAmount(floatval($amount) * 100);
                    try {
                        $zahls->charge($transaction);
                        // Save the transaction id to the current order for next payment
                        $renewal->update_meta_data('zahls_auth_transaction_id', $transaction_id);
                        // For the moment, blindly accept that it "worked"
                        WC_Subscriptions_Manager::process_subscription_payments_on_order($renewal);
                        $renewal->update_status('completed', __('Recurring payment successfully completed', 'zahls-ch-payment-gateway'));
                        $renewal->save_meta_data();
                        $renewal->save();
                        // Return successfully
                        return;
                    } catch (\Zahls\ZahlsException $e) {
                        $renewal->update_status('failed', sprintf(__('Recurring payment failed: %s', 'zahls-ch-payment-gateway'), $e->getMessage()));
                    }
                }

                // Recurring payment failed if we reach this point
                \WC_Subscriptions_Manager::process_subscription_payment_failure_on_order($renewal);
            }
        }

        /**
         * @param $description
         * @param $id
         * @return mixed
         */
        public function extend_subscriptions_checkbox($description, $id)
        {
            if ($id === 'zahls') {
                $html = '';
                if (strlen($description) > 0) {
                    $html .= wpautop($description);
                }

                $has_subscription = false;
                if (!empty(WC()->cart->cart_contents)) {
                    foreach (WC()->cart->cart_contents as $cart_item) {
                        $type = $cart_item['data']->get_type();
                        if ($type == 'subscription' || $type == 'subscription_variation') {
                            $has_subscription = true;
                            break;
                        }
                    }
                }

                if ($has_subscription && $this->get_option('subscriptions_enabled') === 'yes') {
                    // do it the messy way as WCS is using wpautop on this string
                    $html .= '<label for="zahls-allow-recurring">';
                    $html .= '<span id="prx_tokenizable" data-methods="' . esc_js(json_encode($this->get_option('subscription_logos'))) . '"></span>';
                    $html .= '<input type="checkbox" name="zahls-allow-recurring" id="zahls-allow-recurring" value="1" />';
                    $html .= $this->get_option('subscriptions_user_desc') . '</label>';
                    // Add logic to show cards depending on checkbox
                    $html .= '<script type="text/javascript">
                      jQuery(function() {
                        jQuery("#zahls-allow-recurring").on("change", function() {
                          var checked = jQuery(this).is(":checked");
                          if (checked) {
                            // Hide methods that cant tokenize
                            var methods = jQuery("#prx_tokenizable").data("methods");
                            jQuery(".payment_method_zahls img").each(function() {
                              var name = jQuery(this).attr("id");
                              if (jQuery.inArray(name, methods) === -1) {
                                jQuery(this).hide();
                              }
                            });
                          } else {
                            // Disabled, show all payment methods
                            jQuery(".payment_method_zahls img").show();
                          }
                        });
                      });
                    </script>';
                }
                return $html;
            }

            return $description;
        }
        
		private function getZahlsInterface()
        {
            $this->register_autoloader();
            $platform = !empty($this->platform) ? $this->platform : \Zahls\Communicator::API_URL_BASE_DOMAIN;
			
            return new \Zahls\Zahls($this->instance, $this->apiKey, '', $platform);
        }

        private function getCustomTransactionStatus($status) {
            return apply_filters('woo_zahls_custom_transaction_status_' . $status, $status);
        }

        private function register_autoloader()
        {
            spl_autoload_register(function ($class) {
                $root = __DIR__ . '/zahls-php-master';
                $classFile = $root . '/lib/' . str_replace('\\', '/', $class) . '.php';
                if (file_exists($classFile)) {
                    require_once $classFile;
                }
            });
        }
        
    
    }
}

function wc_zahls_add_to_gateways($gateways)
{
    $gateways[] = 'WC_Zahls_Gateway';
    return $gateways;
}

add_filter('woocommerce_payment_gateways', 'wc_zahls_add_to_gateways');



/* siebenberge plugin_action_links */

function sb_zahls_plugin_action_links( $links ) {

	$links = array_merge( array(
		'<a href="' . esc_url( admin_url( '/admin.php?page=wc-settings&tab=checkout&section=zahls' ) ) . '">' . __( 'Settings', 'zahls-ch-payment-gateway' ) . '</a>'
	), $links );

	return $links;

}
add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'sb_zahls_plugin_action_links' );
?>