# Powermail emails encryption
Allows you to encrypt recipient emails with Secure Email (S/MIME) certificate
## Installation

### Installation using Composer

The recommended way to install the extension is by using [Composer](https://getcomposer.org/). In your Composer based TYPO3 project root, just do `composer require vancado/vnc_powermail_encrypt`. 

### Installation as extension from TYPO3 Extension Repository (TER)

Download and install the extension with the TYPO3 extension manager module.

## Configuration
1) Include the static TypoScript of the extension.
2) Define the path to the folder where certificates are stored (By default EXT:vnc_powermail_encrypt/Resources/Private/Certificates) in TypoScript-Constant
3) Specify certificate file for each recipient email address in Typoscript:

```
plugin.tx_powermail {
  settings.setup {
    encryption {			
      # specify certificates for each email address
      certificates {
        1 {
          email = info@example.com 
          certificate = info@example.com.pem
        }
        
      }
    }
  }
}
```
