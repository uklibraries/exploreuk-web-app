#!/bin/sh
set -eu

BACKUP_PASS=$(cat /run/secrets/mysql_backup_password)

echo "Signing in as root to make a user 'backup'"
echo "You should only run this script once to provision the backup user"

mysql -uroot -p <<EOC
CREATE USER IF NOT EXISTS 'backup'@'%' IDENTIFIED by "$BACKUP_PASS";
GRANT SELECT, SHOW VIEW, TRIGGER, EVENT, LOCK TABLES, RELOAD ON *.* TO 'backup'@'%';
FLUSH PRIVILEGES;
EOC
