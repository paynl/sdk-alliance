![PAY.](https://www.pay.nl/uploads/1/brands/main_logo.png)

# PHP SDK  Changelog #

## Release 2.0.0
### Breaking changes
* Changes in Service:
    - In addService renamed 'url' parameter to 'publication'
    - In addService renamed 'extraUrls' parameter to 'publicationUrls'

### Additional changes
* Updated DisablePaymentOption class to use version 4
* Updated EnablePaymentOption class to use version 4
* Updated GetAvailablePaymentOptions class to use version 4
* Updated GetCategories class to use version 4
* Updated AddInvoice class to use version 7
* Updated GetMerchants class to use version 7
* Updated GetMerchant class to use version 7
* Updated GetMerchants class to use version 7
* Added Unsuspend class
* Added setPackage class
* Updated samples
* Fixed issue with getMerchants when document was empty


## Release 1.3.0
* Changes in addMerchant:
    - placeOfBirth no longer required in accounts
    - dateOfBirth no longer required in accounts
    - Updated sample