php app/console propel:database:drop --force && \
php app/console propel:database:create && \
rm -rf src/Up2green/*Bundle/Model/om/ src/Up2green/*Bundle/Model/map/ && \
php app/console propel:build --insert-sql && \
php app/console propel:acl:init --force && \
php app/console propel:fixtures:load