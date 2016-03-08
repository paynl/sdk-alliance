# Paynl PHP SDK-Alliance

---

- [About](#about)
- [Installation](#installation) 
- [Installation without composer](#installation-without-composer) 
- [Setting up](#setting-up)
	- [1. The autoloader](#step-1-the-autoloader)  
	- [2. Your API token](#step-2-your-apitoken)
- [Examples](#examples)
	- [1. Adding a merchant](#1-adding-a-merchant)
	- [2. Getting a list of your merchants](#2-getting-a-list-of-your-merchants)
	- [3. Getting a single merchant](#3-getting-a-single-merchant)
	- [4. Uploading a document](#4-uploading-a-document)
	- [5. Getting the list of available categories](#5-getting-the-list-of-available-categories)
	- [6. Adding a service (website)](#6-adding-a-service-website)
	- [7. Getting available payment methods](#7-getting-available-payment-methods)
	- [8. Enable a payment method](#8-enable-a-payment-method)
	- [9. Disable a payment method](#9-disable-a-payment-method)
	- [10. Get statistics of your submerchants](#10-get-statistics-of-your-submerchants)
	- [11. Creating an invoice for a merchant](#11-creating-an-invoice-for-a-merchant)

---

### About
In order to use this SDK, you'll need to have an alliance account at Pay.nl

The alliance will be able to manage sub-merchants, and manage most of the task via the api that normally a merchant would do by logging in in the pay.nl admin.

Also this SDK extends the standard [Pay.nl SDK](https://github.com/paynl/sdk), so all functions from the original SDK are also available.

### Installation

This SDK uses composer.

Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you.

For more information on how to use/install composer, please visit: [https://github.com/composer/composer](https://github.com/composer/composer)

To install the Pay.nl PHP SDK-alliance into your project, simply

	$ composer require paynl/sdk-alliance


### Installation without composer 
Coming soon..

### Setting up
To communicate with the API of Pay.nl, you'll need to authenticate.
Pay.nl uses a token to authenticate you. You can find your token in the pay.nl admin. On the bottom of the [My Merchant](https://admin.pay.nl/my_merchant) page.

##### Step 1 the autoloader
Composer generates an autoloader for your application.
To be able to access the classes of the SDK, all you have to do is include the composer autoloader.
The autoloader is located here: vendor/autoload.php

```php
require_once('path_to/vendor/autoload.php');
```

##### Step 2 Your APItoken
To let the SDK know what your APItoken is, you'll have to register the APItoken as follows:

```php
\Paynl\Config::setApiToken('YOUR_API_TOKEN');
```

Now you're ready to make some calls



### Examples

The full list of functions can be found in the [samples](https://github.com/paynl/sdk-alliance/tree/master/samples) folder.

Here i will try to explain the order of the samples.

##### 1. Adding a merchant
Before we can start doing stuff, first we need to have a merchant to work with.
For a full example of the merchantData, please refer to the [sample](https://github.com/paynl/sdk-alliance/blob/master/samples/addMerchant.php)

```php
$merchant = \Paynl\Alliance\Merchant::add((array)$merchantData);

/* 
 *  Save the merchantId to your database.
 *  You'll need this id in the next call
 */
$merchantId = $merchant->getMerchantId();

```
##### 2. Getting a list of your merchants
You can get a list of all your sub-merchants.
See the example [here](https://github.com/paynl/sdk-alliance/blob/master/samples/getMerchants.php)


Just call:
```php
/* 
 * Possible states are: new, accepted, deleted.
 * You can omit this value to get all merchants
 */
$result = Paynl\Alliance\Merchant::getList(array('state' => 'new')); 
$merchants = $result->getMerchants();

foreach ($merchants as $merchant) {
    echo $merchant->getMerchantId() . ' ' . $merchant->getMerchantName() . "<br />";
}

```

##### 3. Getting a single merchant
You can of course also get the details of a single merchant. [example](https://github.com/paynl/sdk-alliance/blob/master/samples/getMerchant.php)

```php
$merchant = Paynl\Alliance\Merchant::get(array('merchantId' => 'M-1820-9300'));

// documents that still need to be uploaded (for the next example)
$documents = $merchant->getMissingDocuments();

var_dump($documents);

```

##### 4. Uploading a document
Before we can accept your sub-merchants, you need to supply the required documents
To check the missing documents, see the code from example 3.
You can also check the [example](https://github.com/paynl/sdk-alliance/blob/master/samples/uploadDocument.php)
```php
$result = Paynl\Alliance\Document::upload(array(
      'documentId' => 'D-1234-5678',
      'path' => '/path/to/the/file',
      'filename' => 'rekeningAfschrift.pdf' // optional, when you leave this blank, the filename from the path will be used
	));

if($result->success()){
}

```
##### 5. Getting the list of available categories
You must select the correct category for the services you add for the merchant.
The available paymentmethods differ for each category (for example, a wine giftcard is only valid for category wines)
To get the list of categories, just call [example](https://github.com/paynl/sdk-alliance/blob/master/samples/getCategories.php)
```php
$categories = Paynl\Alliance\Service::getCategories();
$data = $categories->getData();

var_dump($data);
```

##### 6. Adding a service (website)
In order for a merchant to use our services, The merchant needs to have a service (website) registered.
A merchant can have multiple services, normally one for each website.
Before we can add the website, we have to find out in which category the website should be placed.
Some paymentmethods are only available for certain categories, so it is important to select the right one.
To get a list of the available categories, see step 5
You can also check the [example](https://github.com/paynl/sdk-alliance/blob/master/samples/addService.php)
```php
$result = Paynl\Alliance\Service::add(array(
    'merchantId' => 'M-1820-9300',
    'name' => 'Sample Website', 
    'description' => 'Andy Test Add service By Api',
    'categoryId' => 9,// use Paynl\Alliance\Service::getCategories() to get the list of available categories
    'url' => 'http://www.pay.nl',
    'extraUrls' => array(
        'http://www.admin.pay.nl',
        'http://www.shop.pay.nl'
    ),
    'alwaysSendExchange' => true // set to false if you only want a notification on successfull payment (not recommended)
));

```
##### 7. Getting available payment methods
To get a list of the available payment methods, see the following [example](https://github.com/paynl/sdk-alliance/blob/master/samples/getAvailablePaymentMethods.php)
```php
$paymentOptions = Paynl\Alliance\Service::getAvailablePaymentMethods(array('serviceId' => 'SL-2820-5610'));
$data = $paymentOptions->getData();

var_dump($data);
```

To get a list of the enabled payment methods, use the Paymentmethods::getList() from the [Merchant SDK](https://github.com/paynl/sdk/blob/master/samples/transaction/paymentMethods.php)

```php
\Paynl\Config::setServiceId('SL-3490-4320'); 
$paymentMethods = \Paynl\Paymentmethods::getList();
var_dump($paymentMethods);
```

##### 8. Enable a payment method
To enable a payment method, see the following [example](https://github.com/paynl/sdk-alliance/blob/master/samples/enablePaymentMethod.php)
Some payment method have settings.
The Paynl\Alliance\Service::getAvailablePaymentMethods result has a settings array inside the result for payment methods that have settings.

```php

$success = Paynl\Alliance\Service::enablePaymentMethod(array(
    'serviceId' => 'SL-2820-5610',
    'paymentMethodId' => 739,
    'settings' => array( // optional for payment methods that have settings.
        'merchantId' => 1234,
        'merchantPassword' => 'p4ssw0rd',
        'portefeuilleId' => '1'
    )
));

if($success){
    // enabled
}
```

##### 9. Disable a payment method
To disble a payment method, see the following [example](https://github.com/paynl/sdk-alliance/blob/master/samples/disablePaymentMethod.php)

```php
$success = Paynl\Alliance\Service::disablePaymentMethod(array(
    'serviceId' => 'SL-2820-5610',
    'paymentMethodId' => 739    
));

if($success){
    // disabled
}
```

##### 10. Get statistics of your submerchants
You can get the statistics of your submerchants.
For example to calculate the amount for the invoice in the next step
See the following [example](https://github.com/paynl/sdk-alliance/blob/master/samples/getStatistics.php)

You can use the predefined periods
```php
\Paynl\Alliance\Statistics::PERIOD_THIS_WEEK
\Paynl\Alliance\Statistics::PERIOD_LAST_WEEK
\Paynl\Alliance\Statistics::PERIOD_THIS_MONTH
\Paynl\Alliance\Statistics::PERIOD_LAST_MONTH
```

For example

```php
$result = Paynl\Alliance\Statistics::getStats(array(
    'period' => \Paynl\Alliance\Statistics::PERIOD_LAST_WEEK
));
var_dump($result->getData());
```

Or if you want to use your own start and end date

```php
$result = Paynl\Alliance\Statistics::getStats(array(
    'startDate' => new DateTime('2015-03-01'),
    'endDate' => new DateTime('2015-03-10')
));
var_dump($result->getData());
```

##### 11. Creating an invoice for a merchant
You can add an invoice for a merchant.
In order to be able to add an invoice to a merchant, you'll have to set the settleBalance option to true, when adding a merchant in [step 1](#1-adding-a-merchant)
See the following [example](https://github.com/paynl/sdk-alliance/blob/master/samples/addInvoice.php)

```php
\Paynl\Config::setServiceId('SL-1234-1234');

$result = Paynl\Alliance\Invoice::add(array(
    // Required
    'merchantId' => 'M-1234-1234', // the id of the merchant
    'invoiceId' => 'INV012345', // Your reference number to the invoice
    'amount' => 25.75, // The total amount of the invoice
    'description' => 'Test invoice', // The description of the invoice

    // Optional
    'invoiceUrl' => 'http://url.to.the/invoice.pdf', // the url to the invoice
    'makeYesterday' => true // if the invoice needs to be added in today's clearing, set this to true
));

$referenceId = $result->referenceId();
```