# Be more verbose by uncommenting the following line
# logger.level = Logger::IMPORTANT
# logger.level = Logger::INFO
# logger.level = Logger::DEBUG
# logger.level = Logger::MAX_LEVEL

set :application, "www.up2green"
set :domain,      "#{application}.com"
set :deploy_to,   "/srv/www/#{domain}"
set :app_path,    "app"

set :user,          "clement"
set :repository,    "https://github.com/SmartIT-Fr/Up2green.git"
set :scm,           :git
set :model_manager, "propel"
set :deploy_via, :remote_cache
set :dump_assetic_assets, true

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,   [app_path + "/logs", web_path + "/uploads"]
set :use_composer,      true

set :writable_dirs,       ["app/cache", "app/logs", "web/uploads"]
set :webserver_user,      "www-data"
set :permission_method,   :acl
set :use_set_permissions, true
set  :keep_releases,  3
set  :use_sudo,  false

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain                         # This may be the same as your `Web` server
role :db,         domain, :primary => true       # This is where Symfony2 migrations will run

# Building ACL classes
after "symfony:propel:build:model", "symfony:propel:build:acl"

# Creating symlink for twitter bootstrap
before "symfony:assetic:dump" do
  run "#{try_sudo} sh -c 'cd #{latest_release} && #{php_bin} #{symfony_console} mopa:bootstrap:symlink:less --env=#{symfony_env_prod}'"
end

after "deploy", "symfony:cache:clear"
after "deploy", "deploy:cleanup"