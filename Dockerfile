FROM uspdev/uspdev-php-apache:8.4


RUN sed -i 's|/var/www/html|/var/www/html/public|' \
    /etc/apache2/sites-available/000-default.conf

USER www-data

COPY --chown=www-data . .

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# Inicia o memcached usando as configurações padrão do /etc/memcached.conf e o Apache
CMD ["bash", "-c", "memcached -d && apache2-foreground"]
