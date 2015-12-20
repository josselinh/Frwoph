Frwoph is a personal PHP framework.
I wrote it for fun : I made it without looking at others frameworks (as much as possible).
My goal was to make a framework like I thought they're made.
I'm pretty sure some stuff are not good but I'm rather satisfied of what I've done.

<VirtualHost *:80>
    ServerName gasoline.dev
    ServerAlias www.gasoline.dev

    DocumentRoot /home/josselin/Projects/Gasoline
    <Directory /home/josselin/Projects/Gasoline>
        AllowOverride None
        Require all granted

        <IfModule mod_rewrite.c>
            Options -MultiViews
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^(.*)$ index.php [QSA,L]
        </IfModule>
    </Directory>

    ErrorLog /var/log/apache2/gasoline_error.log
    CustomLog /var/log/apache2/gasoline_access.log combined
</VirtualHost>
