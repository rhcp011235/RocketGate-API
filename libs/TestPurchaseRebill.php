<?php
/*
 * Copyright notice:
 * (c) Copyright 2018 RocketGate
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
include("GatewayService.php");

//
//	Allocate the objects we need for the test.
//
$request = new GatewayRequest();
$response = new GatewayResponse();
$service = new GatewayService();

//
//	Setup the Purchase request.
//
$request->Set(GatewayRequest::MERCHANT_ID(), "1519654393");
$request->Set(GatewayRequest::MERCHANT_PASSWORD(), "5W9YU3EN9YVxQfXD");
$request->Set(GatewayRequest::MERCHANT_ACCOUNT(), "419100025317");
$request->Set(GatewayRequest::MERCHANT_SITE_ID(), "141");
#$request->Set(GatewayRequest::MERCHANT_CUSTOMER_ID(), "cust-1");

// For example/testing, we set the order id and customer as the unix timestamp as a convienent sequencing value
// appending a test name to the order id to facilitate some clarity when reviewing the tests
$time = time();
$request->Set(GatewayRequest::MERCHANT_CUSTOMER_ID(), $time . '.PHPTest');
$request->Set(GatewayRequest::MERCHANT_INVOICE_ID(), $time . '.TrialTest');

// $1.99 3-day trial which renews to $9.99/month
$request->Set(GatewayRequest::CURRENCY(), "USD");
$request->Set(GatewayRequest::AMOUNT(), "1.95");    // bill 1.99 trial now
$request->Set(GatewayRequest::REBILL_START(), "30"); // renew in 3 days
$request->Set(GatewayRequest::REBILL_FREQUENCY(), "MONTHLY"); // ongoing renewals monthly
$request->Set(GatewayRequest::REBILL_AMOUNT(), "1.95");

$request->Set(GatewayRequest::CARDNO(), "4111111111111111");
$request->Set(GatewayRequest::EXPIRE_MONTH(), "02");
$request->Set(GatewayRequest::EXPIRE_YEAR(), "2020");
$request->Set(GatewayRequest::CVV2(), "999");

$request->Set(GatewayRequest::CUSTOMER_FIRSTNAME(), "John");
$request->Set(GatewayRequest::CUSTOMER_LASTNAME(), "PHPTester");
$request->Set(GatewayRequest::EMAIL(), "phptest@fakedomain.com");
$request->Set(GatewayRequest::IPADDRESS(), "127.0.0.1");

$request->Set(GatewayRequest::BILLING_ADDRESS(), "123 Main St");
$request->Set(GatewayRequest::BILLING_CITY(), "Las Vegas");
$request->Set(GatewayRequest::BILLING_STATE(), "NV");
$request->Set(GatewayRequest::BILLING_ZIPCODE(), "89141");
$request->Set(GatewayRequest::BILLING_COUNTRY(), "US");

// Risk/Scrub Request Setting
$request->Set(GatewayRequest::SCRUB(), "IGNORE");
$request->Set(GatewayRequest::CVV2_CHECK(), "IGNORE");
$request->Set(GatewayRequest::AVS_CHECK(), "IGNORE");

//
//	Setup test parameters in the service and
//	request.
//
#$service->SetTestMode(TRUE);
echo "DEBUG POST:";
print_r($request);
echo "\n";

//
//	Perform the Purchase transaction.
//
if ($service->PerformPurchase($request, $response)) {
  print "Purchase succeeded\n";
  print "Response Code: " .  $response->Get(GatewayResponse::RESPONSE_CODE()) . "\n";
  print "Reason Code: " .  $response->Get(GatewayResponse::REASON_CODE()) . "\n";
  print "Auth No: " . $response->Get(GatewayResponse::AUTH_NO()) . "\n";
  print "AVS: " . $response->Get(GatewayResponse::AVS_RESPONSE()) . "\n";
  print "CVV2: " . $response->Get(GatewayResponse::CVV2_CODE()) . "\n";
  print "GUID: " . $response->Get(GatewayResponse::TRANSACT_ID()) . "\n";
  print "Account: " .
	$response->Get(GatewayResponse::MERCHANT_ACCOUNT()) . "\n";
  print "Scrub: " .
	$response->Get(GatewayResponse::SCRUB_RESULTS()) . "\n";
} else {
  print "Purchase failed\n";
  print "GUID: " . $response->Get(GatewayResponse::TRANSACT_ID()) . "\n";
  print "Response Code: " .
	$response->Get(GatewayResponse::RESPONSE_CODE()) . "\n";
  print "Reason Code: " .
	$response->Get(GatewayResponse::REASON_CODE()) . "\n";
  print "Exception: " .
	$response->Get(GatewayResponse::EXCEPTION()) . "\n";
  print "Scrub: " .
	$response->Get(GatewayResponse::SCRUB_RESULTS()) . "\n";
}

?>