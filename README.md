General information:
--------------------

This is a set of script to run a hit counter, specifically designed for Tor hidden services. An up-to-date copy can be downloaded at https://github.com/DanWin/hit-counter

Installation instructions:
--------------------------

You'll need to have php with pdo_mysql, pcre and date extension, a web-server and a MySQL server installed.
When you have everything installed, you'll have to create a database and a user for the scripts.
Then edit the configuration in `counter_config.php` to reflect the appropriate database settings and to modify the settings the way you like them.
Then copy the scripts to your web-server directory and open the `setup.php` script like this: `http://(server)/setup.php`
Note: If you updated the script, please visit `http://(server)/setup.php` again, to make sure, that any database changes are applied and no errors occur.

Translating:
------------

Copy `counter_lang_en.php` and rename it to `counter_lang_YOUR_LANGCODE.php`
Then edit the file and translate the messages into your language and change `$I` to `$T` at the top.
If you ever use a ' character, you have to escape it by using \' instead, or the script will fail.
When you are done, you have to edit counter_config.php, to include your translation. Simply add a line with
`'lang_code' => 'Language name',`
to the `$L` array below the settings, similar to what I did for the German translation.
Please share your translation with me, so I can add it to the official version.
To update your translation, you can copy each new string to your translation file or edit the automated `lang_update.php` script to reflect you language and run it.
