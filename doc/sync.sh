cd `dirname $0`
rsync -vzrtu  --progress --exclude-from=.syncignore ../ root@106.14.61.201:/var/www/imam/