<img height="200px" alt="" src="https://www.pay.nl/hubfs/25758250/images/Pay%20Logo%20-%20RGB_Primary%20Logo.png?t=1658149930330"/>

# PHP SDK  Changelog #

## Release 2.1.0
* Added addClearing class
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
* Updated sample
