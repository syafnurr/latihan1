# Installation Guide

## Introduction

**Reward Loyalty** is a Laravel PHP solution, perfect for businesses of all sizes wanting to boost customer loyalty with digital savings cards. This versatile tool is ideal for both single-retailer applications and multi-retailer setups, making it a handy resource for marketing and digital agencies.

Visit our [online documentation](https://nowsquare.com/en-us/reward-loyalty/docs/introduction) for additional information.

## Technology Stack

This project employs the following frameworks and technologies:

### Backend

- **PHP**: Version 8.1.0 or higher
- **Framework**: Laravel (Version 10.x)
- **Supported Databases**:
  - **SQLite**: Version 3.9 or above
  - **MySQL**: Version 5.7 or above
  - **MariaDB**: Version 10.3 or above

### Frontend

- **CSS Framework**: Tailwind CSS (Version 3.x)
- **Components**: Flowbite (Version 1.x) - A component library for Tailwind CSS
- **UI Kit**: Tailwind Elements (Version 1.x) - Open-source UI components

### Tooling

- **Packaging**: NPM Vite - Used for bundling JavaScript and CSS

For a detailed list of PHP libraries, refer to the `composer.json` file located in the root directory. For JavaScript libraries, please check the `package.json` file.

## Prerequisites

Before proceeding with the installation, please ensure you meet the following requirements:

### Core Requirements

 - **PHP Version**: 8.1.0 or higher
 - **Web Server**: Apache
 - **Supported Databases**:
   - SQLite (Version 3.9 or above)
   - MySQL (Version 5.7 or above)
   - MariaDB (Version 10.3 or above)

### Essential PHP Extensions

The following PHP extensions should be installed and activated on your server. Most hosting providers offer these extensions pre-installed. The installation process will also run a check for their presence:

 - Bcmath (`ext-bcmath`)
 - Ctype (`ext-ctype`)
 - cURL (`ext-curl`)
 - DOM (`ext-dom`)
 - Exif (`ext-exif`)
 - Fileinfo (`ext-fileinfo`)
 - Filter (`ext-filter`)
 - GD (`ext-gd`)
 - Hash (`ext-hash`)
 - Iconv (`ext-iconv`)
 - Intl (Internationalization) (`ext-intl`)
 - JSON (`ext-json`)
 - Libxml (`ext-libxml`)
 - Mbstring (`ext-mbstring`)
 - OpenSSL (`ext-openssl`)
 - PCRE (`ext-pcre`)
 - PDO (`ext-pdo`)
 - PDO SQLite (`ext-pdo_sqlite`)
 - Session (`ext-session`)
 - Tokenizer (`ext-tokenizer`)
 - XML (`ext-xml`)
 - Zlib (`ext-zlib`)

### Note On Shared Hosting

For those using shared hosting, it is crucial to check whether you have the ability to enable the PHP functions `proc_open` and `proc_close` or whether these functions are already enabled.

**A common misconception:** Shared hosting providers often disable these functions under the pretext that they may pose a security risk. This applies to platforms like WordPress with the ability to install uncontrolled third-party plugins. However, it is important to understand that our software is carefully developed with a focus on security. It does not contain unverified third-party plugins, thus maintaining the integrity and security of the server through activities of users of the system. Therefore, using `proc_open` and `proc_close` with our software is safe.

## Installation Process

1. **Upload Files**: Transfer all files to your website's root directory.
2. **Access the URL**: Navigate to the URL where you've uploaded the files. You should encounter an installation screen.
3. **Follow On-Screen Instructions**: Complete the steps as prompted to install the script.

**Important:** Once installed, log in using the admin credentials at <u>example.com/en-us/admin</u>. As an admin, you'll have the capability to create partners, allowing them to generate loyalty cards and rewards. Remember, don't install the script in a subdirectory like `example.com/loyalty`. Instead, use a subdomain, e.g., `loyalty.example.com`.

### Localhost Installation

For local environment setups, utilize Laravel's built-in `artisan serve` command:

```php artisan serve```

## Upgrading

### Check Your Current Version

To determine your current version, sign in as an admin at <u>example.com/en-us/admin</u>. The version number is displayed on the dashboard. You can also refer to the `version.txt` file included in the provided zip file.

## Upgrade Procedure

**1. Locate the Upgrade Files**: In the provided zip file, navigate to the `upgrade` directory. Here, you'll find zip files named in the format `upgrade-x.x.x-to-[version].zip`. 

**2. Determine the Correct File**: Identify the upgrade file that matches your current script version. If your script's version is older than the one indicated in the zip filename, you're eligible for the upgrade.

**3. Extract and Overwrite**: Unzip the contents of the appropriate `upgrade-x.x.x-to-[version].zip` and overwrite the existing files in your script's web root directory.

**Note**: Start the extraction process from the zip file that matches your current version. For example, if you have version `1.6.1`, begin with the `upgrade-1.6.x-to-[version].zip` file. Subsequently, extract all the zip files in ascending order of their version numbers.

#### Example

Imagine you have the following files in the `upgrade` directory:

 - upgrade-1.x.x-to-1.6.0.zip
 - upgrade-1.6.x-to-1.6.1.zip

If your current version is `1.2.0` and you aim to upgrade to `1.6.1`, start by unzipping `upgrade-1.x.x-to-1.6.0.zip`, then `upgrade-1.6.x-to-1.6.1.zip`.

But, if you're already on version `1.6.0`, you only need to extract `upgrade-1.6.x-to-1.6.1.zip`.

### Database Update

**1. Log In**: After updating the files, log in as an admin at <u>example.com/en-us/admin</u>.

**2. Look for Update Prompt**: If your database requires an update, a message will show: **"An update is required for your database. Click here to apply the update."**. Click on this prompt to carry out the necessary database updates.

Always check for database synchronization after every upgrade. Non-updated database migrations could lead to functional issues or errors.

#### Troubleshooting the 500 Error

If you face a 500 error after clicking on the database update link:

1. **Check the Log**: Refer to the `storage/logs/laravel.log` for detailed error information.

2. **Review PHP FPM Settings**: Within the PHP directives, find `disable_functions`. This directive lists all deactivated PHP functions on your server.

3. **Adjust Settings**: If `proc_open` and `proc_close` are listed, remove them. Make sure to save the changes, which might resolve the 500 error.

## Troubleshooting

Ensure to review the log file, which can be found at `logs/laravel.log`.

## Conclusion

If you encounter any issues or have specific questions, don't hesitate to consult our [Support Page](https://nowsquare.com/en-us/reward-loyalty/support) for assistance.