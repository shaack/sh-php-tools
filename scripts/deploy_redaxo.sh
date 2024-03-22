#!/bin/bash

project_dir=$(builtin cd ../../; pwd)
local_dir=$(builtin cd ../../../../../../; pwd)
source $project_dir/config.sh

php_tools_folder=$local_dir/redaxo/src/addons/project/lib/sh-php-tools

echo "⇨ redaxo deployment script"
echo project_dir: $project_dir
echo local_dir: $local_dir
echo remote_dir: $remote_dir
echo server: $server
echo user: $user

echo $php_tools_folder

# ssh -fMNS bgconn -o ControlPersist=yes $user@$server
# scp -ro ControlPath=bgconn $local_dir/redaxo/data/addons/developer $user@$server:$remote_dir/redaxo/data/addons
# mv -v $php_tools_folder/.git ~/Temp/
# scp -ro ControlPath=bgconn $local_dir/redaxo/src/addons/project $user@$server:$remote_dir/redaxo/src/addons
# mv -v ~/Temp/.git $php_tools_folder/
# scp -ro ControlPath=bgconn $local_dir/assets/local $user@$server:$remote_dir/assets
# ssh -S bgconn -O exit -

