<?php
/*
 * Copyright notice:
 * (c) Copyright 2017 RocketGate
 * All rights reserved.
 *
 * The copyright notice must not be removed without specific, prior
 * written permission from RocketGate.
 *
 * This software is protected as an unpublished work under the U.S. copyright
 * laws. The above copyright notice is not intended to effect a publication of
 * this work.
 * This software is the confidential and proprietary information of RocketGate.
 * Neither the binaries nor the source code may be redistributed without prior
 * written permission from RocketGate.
 *
 * The software is provided "as-is" and without warranty of any kind, express, implied
 * or otherwise, including without limitation, any warranty of merchantability or fitness
 * for a particular purpose.  In no event shall RocketGate be liable for any direct,
 * special, incidental, indirect, consequential or other damages of any kind, or any damages
 * whatsoever arising out of or in connection with the use or performance of this software,
 * including, without limitation, damages resulting from loss of use, data or profits, and
 * whether or not advised of the possibility of damage, regardless of the theory of liability.
 * 
 */
require_once("GatewayParameterList.php");
require_once("GatewayChecksum.php");

////////////////////////////////////////////////////////////////////////////////
//
//	GatewayRequest() - Object that holds name-value pairs
//			   that describe a gateway request.
//				    
////////////////////////////////////////////////////////////////////////////////
//
class GatewayRequest extends GatewayParameterList {

//////////////////////////////////////////////////////////////////////
//
//	GatewayRequest() - Constructor for class.
//
//////////////////////////////////////////////////////////////////////
//
  public function __construct()
  {
//
//	Initialize the request list.
//
    parent::__construct();
    $this->Set(GatewayRequest::VERSION_INDICATOR(),
	       GatewayChecksum::$versionNo);
  }


//////////////////////////////////////////////////////////////////////
//
//	ToXMLString() - Transform the parameter list into
//			an XML String.
//
//////////////////////////////////////////////////////////////////////
//
  function ToXMLString()
  {

//
//	Build the header of XML document.
//
    $xmlString = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" .
		 "<gatewayRequest>";

//
//	Loop over the list of values in the parameter list.
//
    foreach ($this->params as $key => $value) {
      $xmlString .= "<" . $key . ">";		// Add opening of element
      $xmlString .= $this->TranslateXML($value);
      $xmlString .= "</" . $key . ">";		// Add closing of element
    }

//
//	Put the closing marker on the XML document and quit.
// 
    $xmlString .= "</gatewayRequest>";		// Add the terminator
    return $xmlString;				// Return completed XML
  }


//////////////////////////////////////////////////////////////////////
//
//	TranslateXML() - Translate a string to a valid XML
//			 string that can be used in an attribute
//			 or text node.
//
//////////////////////////////////////////////////////////////////////
//
  function TranslateXML($sourceString)
  {
    $sourceString = str_replace("&", "&amp;", $sourceString);
    $sourceString = str_replace("<", "&lt;", $sourceString);
    $sourceString = str_replace(">", "&gt;", $sourceString);
    return $sourceString;			// Give back results
  }


//////////////////////////////////////////////////////////////////////
//
//	Functions that provide constants for name-value pairs.
//
//////////////////////////////////////////////////////////////////////
//
  static function VERSION_INDICATOR() { return "version"; }
  static function ACCOUNT_HOLDER() { return "accountHolder"; }
  static function ACCOUNT_NO() { return "accountNo"; }
  static function AFFILIATE() { return "affiliate"; }
  static function AMOUNT() { return "amount"; }
  static function AVS_CHECK() { return "avsCheck"; }
  static function BILLING_ADDRESS() { return "billingAddress"; }
  static function BILLING_CITY() { return "billingCity"; }
  static function BILLING_COUNTRY() { return "billingCountry"; }
  static function BILLING_STATE() { return "billingState"; }
  static function BILLING_TYPE() { return "billingType"; }
  static function BILLING_ZIPCODE() { return "billingZipCode"; }
  static function BROWSER_USER_AGENT() { return "browserUserAgent"; }
  static function BROWSER_ACCEPT_HEADER() { return "browserAcceptHeader"; }
  static function CAPTURE_DAYS() { return "captureDays"; }
  static function CARDNO() { return "cardNo"; }
  static function CARD_HASH() { return "cardHash"; }
  static function CLONE_CUSTOMER_RECORD() { return "cloneCustomerRecord"; }
  static function CLONE_TO_CUSTOMER_ID() { return "cloneToCustomerID"; }
  static function CURRENCY() { return "currency"; }
  static function CUSTOMER_FIRSTNAME() { return "customerFirstName"; }
  static function CUSTOMER_LASTNAME() { return "customerLastName"; }
  static function CUSTOMER_PASSWORD() { return "customerPassword"; }
  static function CUSTOMER_PHONE_NO() { return "customerPhoneNo"; }
  static function CVV2() { return "cvv2"; }
  static function CVV2_CHECK() { return "cvv2Check"; }
  static function EMAIL() { return "email"; }
  static function EMBEDDED_FIELDS_TOKEN() { return "embeddedFieldsToken"; }
  static function EXPIRE_MONTH() { return "expireMonth"; }
  static function EXPIRE_YEAR() { return "expireYear"; }
  static function GENERATE_POSTBACK() { return "generatePostback"; }
  static function IOVATION_BLACK_BOX() { return "iovationBlackBox"; }
  static function IOVATION_RULE() { return "iovationRule"; }
  static function IPADDRESS() { return "ipAddress"; }
  static function MERCHANT_ACCOUNT() { return "merchantAccount"; }
  static function MERCHANT_CUSTOMER_ID() { return "merchantCustomerID"; }
  static function MERCHANT_DESCRIPTOR() { return "merchantDescriptor"; }
  static function MERCHANT_DESCRIPTOR_CITY() { return "merchantDescriptorCity"; }
  static function MERCHANT_INVOICE_ID() { return "merchantInvoiceID"; }
  static function MERCHANT_ID() { return "merchantID"; }
  static function MERCHANT_PASSWORD() { return "merchantPassword"; }
  static function MERCHANT_PRODUCT_ID() { return "merchantProductID"; }
  static function MERCHANT_SITE_ID() { return "merchantSiteID"; }
  static function OMIT_RECEIPT() { return "omitReceipt"; }
  static function PARES() { return "PARES"; }
  static function PARTIAL_AUTH_FLAG() { return "partialAuthFlag"; }
  static function PAYINFO_TRANSACT_ID() { return "payInfoTransactID"; }
  static function REBILL_FREQUENCY() { return "rebillFrequency"; }
  static function REBILL_AMOUNT() { return "rebillAmount"; }
  static function REBILL_START() { return "rebillStart"; }
  static function REBILL_END_DATE() { return "rebillEndDate"; }
  static function REBILL_COUNT() { return "rebillCount"; }
  static function REBILL_SUSPEND() { return "rebillSuspend"; }
  static function REBILL_RESUME() { return "rebillResume"; }
  static function REFERENCE_GUID() { return "referenceGUID"; }
  static function REFERRAL_NO() { return "referralNo"; }
  static function REFERRING_MERCHANT_ID() { return "referringMerchantID"; }
  static function REFERRED_CUSTOMER_ID() { return "referredCustomerID"; }
  static function ROUTING_NO() { return "routingNo"; }
  static function SAVINGS_ACCOUNT() { return "savingsAccount"; }
  static function SCRUB() { return "scrub"; }
  static function SCRUB_ACTIVITY() { return "scrubActivity"; }
  static function SCRUB_NEGDB() { return "scrubNegDB"; }
  static function SCRUB_PROFILE() { return "scrubProfile"; }
  static function SS_NUMBER() { return "ssNumber"; }
  static function SUB_MERCHANT_ID() { return "subMerchantID"; }
  static function THREATMETRIX_SESSION_ID() { return "threatMetrixSessionID"; }
  static function TRANSACT_ID() { return GatewayRequest::REFERENCE_GUID(); }
  static function TRANSACTION_TYPE() { return "transactionType"; }
  static function UDF01() { return "udf01"; }
  static function UDF02() { return "udf02"; }
  static function USE_3D_SECURE() { return "use3DSecure"; }
  static function USERNAME() { return "username"; }
  static function XSELL_MERCHANT_ID() { return "xsellMerchantID"; }
  static function XSELL_CUSTOMER_ID() { return "xsellCustomerID"; }
  static function XSELL_REFERENCE_XACT() { return "xsellReferenceXact"; }
  static function _3D_CHECK() { return "ThreeDCheck"; }
  static function _3D_ECI() { return "ThreeDECI"; }
  static function _3D_CAVV_UCAF() { return "ThreeDCavvUcaf"; }
  static function _3D_XID() { return "ThreeDXID"; }
  static function FAILED_SERVER() { return "failedServer"; }
  static function FAILED_GUID() { return "failedGUID"; }
  static function FAILED_RESPONSE_CODE() { return "failedResponseCode"; }
  static function FAILED_REASON_CODE() { return "failedReasonCode"; }


//////////////////////////////////////////////////////////////////////
//
//	Functions used to override gateway service URL.
//
//////////////////////////////////////////////////////////////////////
//
  static function GATEWAY_SERVER() { return "gatewayServer"; }
  static function GATEWAY_PROTOCOL() { return "gatewayProtocol"; }
  static function GATEWAY_PORTNO() { return "gatewayPortNo"; }
  static function GATEWAY_SERVLET() { return "gatewayServlet"; }
  static function GATEWAY_URL() { return "gatewayURL"; }
  static function GATEWAY_CONNECT_TIMEOUT() { return "gatewayConnectTimeout"; }
  static function GATEWAY_READ_TIMEOUT() { return "gatewayReadTimeout"; }
}

?>
