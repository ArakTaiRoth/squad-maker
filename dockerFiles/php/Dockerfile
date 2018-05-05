FROM centos:6.8

RUN rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-6.noarch.rpm \
    && rpm -Uvh https://mirror.webtatic.com/yum/el6/latest.rpm \
    && yum install -y php70w php70w-intl php70w-opcache php70w-mysql php70w-pecl-memcached \
    && yum install -y libevent libevent-devel php70w-mbstring mod_ssl openssl \
    && yum install -y httpd vixie-cron python-pip jq \
    && pip install awscli

COPY ./certs/ca.crt       /etc/pki/tls/certs
COPY ./certs/ca.key       /etc/pki/tls/private/ca.key
COPY ./certs/ca.csr       /etc/pki/tls/private/ca.csr
COPY ./conf/ssl.conf      /etc/httpd/conf.d/ssl.conf
COPY ./conf/httpd.conf    /etc/httpd/conf/httpd.conf

VOLUME ["/squadMaker"]
WORKDIR /squadMaker

EXPOSE 80
EXPOSE 443
