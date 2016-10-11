# Pure Charity Base Plugin

Pure Base Plugin created based on the Official WordPress Plugin Boilerplate.

Please refer to `/purecharity-wp-base/trunk/README.txt` for details.

# Installation

IMPORTANT:  At this time the plugin requires a name change after extracting from Github.  After downloading the source code from Github unzip the files and rename the folder **/purecharity-wp-base** and compress as **purecharity-wp-base.zip** if you plan to use the Wordpress plugin installer via upload.   

In order to install the plugin:

1. Copy the `/purecharity-wp-base` folder to the `/wp-content/plugins` on your WP install
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Set your credentials at the `Settings > PureBase Settings` in your admin left menu
4. You're done!

# Frequently Asked Questions

## What is the difference between Sandbox and Production on the settings page?

If you have `Sandbox` enabled, the data will be pulled from the Pure Charity Staging environment. Otherwise, data will
be pulled from the Production environment.

Please note that Staging and Production environments do not share API Keys.
