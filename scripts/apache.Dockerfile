FROM httpd:2.4

RUN mkdir -p /home/cphp/var

COPY apache.conf /usr/local/apache2/conf/httpd.conf
COPY vhost.conf /usr/local/apache2/conf/extra/httpd-vhosts.conf
