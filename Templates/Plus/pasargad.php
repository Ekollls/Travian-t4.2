<?php
/**
 * @version		pasargad.php 1.0 2010-10-26
 * @package		Pasargad
 */

/**
 * Pasargad Cart Class
 * This class will help you make or save a pasargad cart object.
 */
class PasargadCart {
	var $time_stamp = '';			// String	This will load in constructor by default. Format-> "Y/m/d H:i:s"
	var $invoice_date = '';			// String	Any date that you use in your system
	var $invoice_number = '';		// String
	var $merchant_code = '';		// String	This will load in constructor from config file.
	var $terminal_code = '';		// String	This will load in constructor from config file.
	var $redirect_address = '';		// String	This will load in constructor from config file.
	var $referrer_address = '';		// String	This will load in constructor from config file.
	var $delivery_days = 0;			// Integer	This will load in constructor from config file.
	var $total_amount = 0;			// Integer
	var $buyer_name = '';			// String
	var $buyer_tel = '';			// String
	var $delivery_address = '';		// String
	var $cart = array();			// Array	Array of cart items

	/**
	 * Constructor
	 *
	 * This function just adds parameters which are predefined in the class.
	 * @param	array	Array of needed parameters
	 */
	function __construct($data=array()){
		// Make time stamp
		$this->time_stamp = date('Y/m/d H:i:s');
		// Load config file
		include 'pasargad_config.php';
		// Load config data in object
		$this->merchant_code = $merchant_code;
		$this->terminal_code = $terminal_code;
		$this->redirect_address = $redirect_address;
		$this->referrer_address = $referrer_address;
		$this->delivery_days = $delivery_days;
		// If there is any data
		if(count($data)>0){
			foreach($data as $var => $value){
				// Load every data except cart
				if(property_exists('PasargadCart', $var) && $var!='cart'){
					// Make params ready to prevent from problems.
					// This will strip all html tags.
					$value = strip_tags($value);
					// This will strip OS return symbols (\n or \r)
					$value = str_replace(array("\n","\r"), ' ', $value);
					$this->$var = $value;
				}
				// Now assign cart after making it ready
				if($var == 'cart') $this->cart = $this->makeProductItems($value);
			}
		}
    }

	/**
	 * Constructor
	 * for PHP 4
	 * This function just adds parameters which are predefined in the class.
	 * @param	array	Array of needed parameters
	 */
	function PasargadCart($data=array()){
		$this->__construct($data);
	}

	/**
	 * Make product items ready to use in the cart
	 * 
	 * @param	array	Array of product items
	 * @return	array	Array of cart item objects
	 */
	function makeProductItems($products = array()){
		// Define default values which every product item needs
		$content = '';		// Name or anything which user need to know about this product
		$count = 0;			// Quantity of the item
		$fee = 0;			// Unit price of the item.
		$description = '';	// Description of the item
		$result = array();

		if(count($products)>0){ // If there is any products
			foreach($products as $product){
				// Create default and necessary parameters
				$item = NULL;
				$item->content = $content;
				$item->count = $count;
				$item->fee = $fee;
				$item->description = $description;
				// Assign item's defined parameters
				if(is_array($product) && count($product)>0) {
					foreach($product as $key => $value){
						// Make params ready to prevent from problems.
						// This will strip all html tags.
						$value = strip_tags($value);
						// This will strip OS return symbols (\n or \r)
						$value = str_replace(array("\n","\r"), ' ', $value);
						// Add to Item
						$item->$key = $value;
					}
				}
				// Calculate amount parameter
				$item->amount = $item->fee * $item->count;
				// Add to results
				$result[] = $item;
			}
		}
		return $result;
	}

}

/**
 * Pasargad Class
 * This class will help you create xml, sign it and communicate with Pasargad terminal.
 */
class Pasargad {

	var $response = NULL;

	/**
	 * Constructor
	 *
	 * This function just adds parameters which are predefined in the class.
	 * @param	array	Array of needed parameters
	 */
	function __construct($data=array()){
		//
	}

	/**
	 * Constructor
	 * for PHP 4
	 * This function just adds parameters which are predefined in the class.
	 * @param	array	Array of needed parameters
	 */
	function Pasargad($data=array()){
		$this->__construct($data);
	}

	/**
	 * This function creates the needed xml for pasargad terminal.
	 * 
	 * @param	object	PasargadCart object
	 * @return	string	XML for pasargad terminal
	 */
	function createXML($cart){
		$output = '<?xml version="1.0" encoding="utf-8" ?>'
		.'<invoice'
		.' time_stamp="'.$cart->time_stamp.'"'
		.' invoice_date="'.$cart->invoice_date.'"'
		.' invoice_number="'.$cart->invoice_number.'"'
		.' terminal_code="'.$cart->terminal_code.'"'
		.' merchant_code="'.$cart->merchant_code.'"'
		.' redirect_address="'.$cart->redirect_address.'"'
		.' referer_address="'.$cart->referrer_address.'"'
		.' delivery_days="'.(int)$cart->delivery_days.'"'
		.' total_amount="'.(int)$cart->total_amount.'"'
		.' buyer_name="'.$cart->buyer_name.'"'
		.' buyer_tel="'.$cart->buyer_tel.'"'
		.' delivery_address="'.$cart->delivery_address.'"'
		.'>'
		;

		$i=1; // First number
		if(count($cart->cart)>0){
			foreach($cart->cart as $item){
				// Generate xml
				$output .= '<item number="'.$i.'">'
				.'<content>'.$item->content.'</content>'
				.'<fee>'.(int)$item->fee.'</fee>'
				.'<count>'.(int)$item->count.'</count>'
				.'<amount>'.(int)$item->amount.'</amount>'
				.'<description>'.$item->description.'</description>'
				.'</item>'
				;
				$i++; // Increase number
			}
		}

		$output .= '</invoice>';

		return $output;
	}

	/**
	 * This function generates the signature to use for Pasargad terminal
	 * 
	 * @param	string	XML Generated for Pasargad terminal
	 * @return	string	Signature for Pasargad terminal
	 */
	function sign($xml){
		include 'pasargad_config.php';
		$key = file_get_contents($key_file);
		$priv_key = openssl_pkey_get_private($key); // notice: there must be pkcs#8 representation of your privateKey in .PEM file format.
		$signature = '';
		if(!openssl_sign($xml, $signature, $priv_key, OPENSSL_ALGO_SHA1)) {
			return false;
		}else{
			$result = base64_encode($signature);
		}
		return $result;
	}

	/**
	 * This function communicates and gets the data that we need to check our transaction
	 * 
	 * @param	string	tref that bank has returned
	 * @param	object	(optional) A PasargadCart object. It will be used if tref is empty.
	 * @return	object	An object of returned values by Pasargad
	 */
	function getResponse($tref='',$cart=NULL){
		$url = "https://paypaad.bankpasargad.com/PaymentTrace";
		$curl_session = curl_init($url); // Initiate CURL session -> notice: CURL should be enabled.
		curl_setopt($curl_session, CURLOPT_POST, 1);	// Set post method on.
		//curl_setopt($curl_session, CURLOPT_FOLLOWLOCATION, 1); // Follow where ever it goes
		curl_setopt($curl_session, CURLOPT_HEADER, 0); //Don't return http headers
		curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, 1); // Return the content of the call

		// Make post parameters
		if($tref!='' && $tref!=NULL && !empty ($tref)){ // If there is any tref
			// This parameter is enough
			$post_data = "tref=".$tref;
		}elseif(is_object($cart) && $cart->invoice_number!=''){
			//We need more parameters
			$post_data = 'invoice_number='.$cart->invoice_number
					.'&invoice_date='.$cart->invoice_date
					.'&merchant_code'.$cart->merchant_code
					.'&terminal_code'.$cart->terminal_code
					;
		}else{
			// There are no enough parameters
			return false;
		}
		// Set parameters to post.
		curl_setopt($curl_session, CURLOPT_POSTFIELDS, $post_data);

		// Get returning data
		$output = curl_exec($curl_session);
		// Close CURL session
		curl_close($curl_session);
		// Create a xml parser
		$parser = xml_parser_create();
		// Parse XML
		xml_parse_into_struct($parser, $output, $values);
		// Free the parser
		xml_parser_free($parser);

		// Load parsed data and make it ready to use
		$this->response = NULL;
		foreach($values as $res_item){
			$tag = strtolower($res_item['tag']);
			$this->response->$tag = $res_item['value'];
		}

		// Return object of parsed data
		return $this->response;
	}

	/**
	 * This function is needed to parse xml data
	 * and is just for internal use.
	 */
	function contents($parser,$data){
		$this->response = $data;
	}

	/**
	 * This function is needed to parse xml data
	 * and is just for internal use.
	 */
	function startTag($parser,$data) {
		// Do nothing
	}

	/**
	 * This function is needed to parse xml data
	 * and is just for internal use.
	 */
	function endTag($parser,$data){
		// Do nothing
	}
}
// End of file: pasargad.php