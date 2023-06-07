<?php

/**
 * @file
 */

/**
 * Test Generated example demonstrating the PriceFieldValue.get API.
 *
 * @return array
 *   API result array
 */
function price_field_value_get_example() {
  $params = [
    'name' => 'contribution_amount',
  ];

  try {
    $result = civicrm_api3('PriceFieldValue', 'get', $params);
  }
  catch (CRM_Core_Exception $e) {
    // Handle error here.
    $errorMessage = $e->getMessage();
    $errorCode = $e->getErrorCode();
    $errorData = $e->getExtraParams();
    return [
      'is_error' => 1,
      'error_message' => $errorMessage,
      'error_code' => $errorCode,
      'error_data' => $errorData,
    ];
  }

  return $result;
}

/**
 * Function returns array of result expected from previous function.
 *
 * @return array
 *   API result array
 */
function price_field_value_get_expectedresult() {

  $expectedResult = [
    'is_error' => 0,
    'version' => 3,
    'count' => 1,
    'id' => 1,
    'values' => [
      '1' => [
        'id' => '1',
        'price_field_id' => '1',
        'name' => 'contribution_amount',
        'label' => 'Contribution Amount',
        'amount' => '1.000000000',
        'weight' => '1',
        'is_default' => 0,
        'is_active' => '1',
        'financial_type_id' => '1',
        'non_deductible_amount' => '0.00',
        'visibility_id' => '1',
        'contribution_type_id' => '1',
      ],
    ],
  ];

  return $expectedResult;
}

/*
 * This example has been generated from the API test suite.
 * The test that created it is called "testGetBasicPriceFieldValue"
 * and can be found at:
 * https://github.com/civicrm/civicrm-core/blob/master/tests/phpunit/api/v3/PriceFieldValueTest.php
 *
 * You can see the outcome of the API tests at
 * https://test.civicrm.org/job/CiviCRM-Core-Matrix/
 *
 * To Learn about the API read
 * https://docs.civicrm.org/dev/en/latest/api/
 *
 * Browse the API on your own site with the API Explorer. It is in the main
 * CiviCRM menu, under: Support > Development > API Explorer.
 *
 * Read more about testing here
 * https://docs.civicrm.org/dev/en/latest/testing/
 *
 * API Standards documentation:
 * https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
