server 'www.preprod.up2green.smartit.fr', :app, :web, :db, :primary => true

set :user, "fragueur"
set :htaccess_username, "up2gteam"
set :htaccess_password, "up2gpassword"

after "deploy", "deploy:htaccess_protect"