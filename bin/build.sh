php app/console propel:database:drop --force && \
php app/console propel:database:create && \
php app/console propel:build --insert-sql && \
php app/console propel:acl:init --force && \
php app/console propel:fixtures:load