<?php

require 'vendor/autoload.php';

use Onetoweb\Yuki\Sales\Client as SalesClient;

$accessKey = 'access_key';

$salesClient = new SalesClient($accessKey);

// process sales invoices
$salesClient->processSalesInvoices([
    'SalesInvoice' => [
        'Reference' => 'XX-1234',
        'Subject' => 'Testfactuur - 1',
        'PaymentMethod' => 'ElectronicTransfer',
        'Process' => 'false',
        'EmailToCustomer' => 'false',
        'Layout' => '',
        'Date' => '2012-06-22',
        'DueDate' => '2012-07-22',
        'PriceList' => '',
        'Currency' => '',
        'Remarks' => '',
        'Contact' => [
            'ContactCode' => '1122',
            'FullName' => 'Apple Sales International',
            'FirstName' => '',
            'MiddleName' => '',
            'LastName' => '',
            'Gender' => 'Male',
            'CountryCode' => 'NL',
            'City' => 'Rotterdam',
            'Zipcode' => '1234 AA',
            'AddressLine_1' => 'Bergweg 25',
            'AddressLine_2' => '',
            'EmailAddress' => 'info@test.nl',
            'Website' => '',
            'CoCNumber' => '',
            'VATNumber' => '',
            'ContactType' => 'Person',
        ],
        'InvoiceLines' => [
            'InvoiceLine' => [
                'Description' => 'Regel 1',
                'ProductQuantity' => 1,
                'Product' => [
                    'Description' => 'Product 1',
                    'Reference' => 'TP-1122',
                    'Category' => '',
                    'SalesPrice' => 14.88,
                    'VATPercentage' => 6.00,
                    'VATIncluded' => 'true',
                    'VATType' => 2,
                    'GLAccountCode' => '',
                    'Remarks' => '',
                ]
            ]
        ]
    ],
]);