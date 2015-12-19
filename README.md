Frwoph is a personal PHP framework.
I don't think i'm going to use it, it's just for fun.
I just want to build a framework as i think.
I don't want to take a look on others framework or to be inspired by them.

<VirtualHost *:80>
    ServerName gasoline.dev
    ServerAlias www.gasoline.dev

    DocumentRoot /home/josselin/Projects/Gasoline
    <Directory /home/josselin/Projects/Gasoline>
        AllowOverride None
        #Order Allow,Deny
        #Allow from All
        Require all granted

        <IfModule mod_rewrite.c>
            Options -MultiViews
            RewriteEngine On
            #RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^(.*)$ index.php [QSA,L]
        </IfModule>
    </Directory>

    # uncomment the following lines if you install assets as symlinks
    # or run into problems when compiling LESS/Sass/CoffeScript assets
    # <Directory /var/www/project>
    #     Options FollowSymlinks
    # </Directory>

    ErrorLog /var/log/apache2/gasoline_error.log
    CustomLog /var/log/apache2/gasoline_access.log combined
</VirtualHost>
