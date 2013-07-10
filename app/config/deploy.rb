# Be more verbose by uncommenting the following line
# logger.level = Logger::IMPORTANT
# logger.level = Logger::INFO
# logger.level = Logger::DEBUG
# logger.level = Logger::MAX_LEVEL

set :stages,        %w(production preprod)
set :default_stage, "production"
set :stage_dir,     "app/config"
require 'capistrano/ext/multistage'

set :application, "www.up2green"
set :domain,      "#{application}.com"
set :app_path,    "app"
set :deploy_to,   "/srv/www/#{domain}"

set :repository,    "git@github.com:SmartIT-Fr/Up2green.git"
set :scm,           :git
set :model_manager, "propel"
set :deploy_via, :remote_cache
set :dump_assetic_assets, true

set :shared_files,      [app_path + "/config/parameters.yml"]
set :shared_children,   [app_path + "/logs", web_path + "/uploads"]
set :use_composer,      true

set :writable_dirs,       [app_path + "/cache", app_path + "/logs", web_path + "/uploads"]
set :webserver_user,      "www-data"
set :permission_method,   :acl
set :use_set_permissions, true
set  :keep_releases,  3
set  :use_sudo,  false

# Building ACL classes
after "symfony:propel:build:model", "symfony:propel:build:acl"

# Creating symlink for twitter bootstrap
before "symfony:assetic:dump" do
  run "cd #{latest_release} && #{php_bin} #{symfony_console} mopa:bootstrap:symlink:less --env=#{symfony_env_prod}"
end

# FIXME cache warmup error when propel clases are not already generated
before "symfony:propel:build:model", :on_error => :continue  do
  begin
    run "cd #{latest_release} && #{try_sudo} #{php_bin} #{symfony_console}  propel:model:build --env=prod --no-debug"
  rescue Exception => error
  end
end

after "deploy", "symfony:cache:clear"
after "deploy", "deploy:cleanup"

namespace :deploy do
    desc "Add .htaccess protection"
    task :htaccess_protect do
        capifony_pretty_print "--> Securing the application"
        _cset(:htaccess_username) { abort "Please specify an htaccess username, set :htaccess_username, 'foo'" }
        unless exists?(:htaccess_password_hashed)
        _cset(:htaccess_password) { abort "Please specify htaccess_password or htaccess_password_hashed" }
        set :htaccess_password_hashed, "#{htaccess_password}".crypt('httpauth')
        end

        # This appends to the end of the file, so don't run it multiple times!

        run "echo '#{htaccess_username}:#{htaccess_password_hashed}' >> #{File.join(current_path, '.htpasswd')}"
        run "echo 'AuthType Basic' >> #{File.join(current_path, '.htaccess')}"
        run "echo 'AuthName \"Restricted\"' >> #{File.join(current_path, '.htaccess')}"
        run "echo 'AuthUserFile #{File.join(current_path, '.htpasswd')}' >> #{File.join(current_path, '.htaccess')}"
        run "echo 'Require valid-user' >> #{File.join(current_path, '.htaccess')}"
        capifony_puts_ok
    end
end