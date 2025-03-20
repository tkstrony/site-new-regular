# New Regular Site Profile

This is a new regular site profile for [ProcessWire CMS](https://processwire.com/).

## Requirements

1. **ProcessWire CMS** downloaded (ZIP package).
2. Access to a server or environment that meets the system requirements (PHP 8.1+).

## Installation Steps

### 1. Download and Extract ProcessWire

If you haven't already installed ProcessWire, download the latest version from the official website:

[https://processwire.com/download/](https://processwire.com/download/core/)

Unzip the downloaded package to your server's desired directory.

### 2. Unzip Downloaded Profile site-new-regular-main.zip

Copy the extracted `site-new-regular-main` folder into the same directory where the `install.php` file of ProcessWire is.

### 3. Run the ProcessWire Installation

Open the URL where you’ve copied ProcessWire's files (e.g., `http://localhost/`). The ProcessWire installer should start. When prompted for the site profile, select the `New Regular Site Profile` and continue with the installation.

## Global Helper Function

A global helper function `_site()` is provided to give easy access to the instance of the `Site` class. This function ensures that the `Site` class is instantiated only once and returns the same instance throughout the application.

### Usage

You can use the `_site()` helper function to access the properties and methods of the `Site` class. Here's an example of how to use it:

```php
// Accessing the global Site instance
$site = _site();

// Displaying site properties
echo $site->name; // Site name
echo $site->email; // Site email

// Calling Site class methods
echo $site->guestNotification(); // Displays guest notification
```

## Autoloading

The project uses PSR-4 autoloading for the `ProcessWire` namespace, which automatically loads classes from the `modules/ProcessProfileHelper/classes/` directory. Additionally, the `modules/ProcessProfileHelper/_helpers.php` file is automatically included.

## Dependencies

This project uses the following Composer dependencies:

- **[mpratt/embera](https://github.com/mpratt/embera)** (~2.0): A PHP library for embedding external media using oEmbed (e.g., YouTube, Vimeo). <br>
License: [MIT LICENSE](modules/ProcessProfileHelper/vendor/mpratt/embera/LICENSE)

- **[mobiledetect/mobiledetectlib](https://github.com/serbanghita/Mobile-Detect)** (^4.8): A lightweight library for detecting mobile devices, enabling content optimization for various devices. <br>
License: [MIT LICENSE](./modules/ProcessProfileHelper/vendor/mobiledetect/mobiledetectlib/LICENSE)

- **[phiki/phiki](https://github.com/phikiphp/phiki)** (^1.1): A PHP image and media management library, facilitating image optimization and processing. <br> 
License: [MIT LICENSE](./modules/ProcessProfileHelper/vendor/phiki/phiki/LICENSE)

- **[openai-php/client](https://github.com/openai-php/client)** (^0.10.3): A PHP client for the OpenAI API, enabling easy integration of AI features into your application. <br> 
License: [MIT LICENSE](./modules/ProcessProfileHelper/vendor/openai-php/client/LICENSE.md)

- **[guzzlehttp/guzzle](https://github.com/guzzle/guzzle)** (^7.9): A PHP HTTP client library for making HTTP requests, offering robust API handling. <br> 
License: [MIT LICENSE](./modules/ProcessProfileHelper/vendor/guzzlehttp/guzzle/LICENSE)

- **[erusev/parsedown](https://github.com/erusev/parsedown)** (^1.7): A lightweight Markdown parser that converts Markdown text into HTML. <br> 
License: [MIT LICENSE](./modules/ProcessProfileHelper/vendor/erusev/parsedown/LICENSE.txt)

- **[geoip2/geoip2](https://github.com/maxmind/GeoIP2-php)** (~2.0): A PHP client for the GeoIP2 database, used for determining geographical location based on IP addresses. <br> 
License: [Apache License 2.0](./modules/ProcessProfileHelper/vendor/geoip2/geoip2/LICENSE)

## IP Geolocation Database

This project uses the **IP to Country Lite** database by [DB-IP](https://db-ip.com/), which provides country-level geolocation based on IP addresses.

- The free **IP to Country Lite** database can be downloaded from: [https://db-ip.com/db/download/ip-to-country-lite](https://db-ip.com/db/download/ip-to-country-lite)
- The database is licensed under a [**Creative Commons Attribution 4.0 International License**](https://creativecommons.org/licenses/by/4.0/).
  - You are free to use this database in your application, provided you give attribution to **DB-IP.com** for the data.

  Database path: `./modules/ProcessProfileHelper/inc/dbip-country-lite-2025-03.mmdb`


