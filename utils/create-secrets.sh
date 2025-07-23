#!/bin/sh

# List of all secrets needed
SECRETS_TO_CREATE=("mysql_root_password" "mysql_database" "mysql_user" "mysql_password" "db_host" "db_prefix" "db_port" "db_charset")

echo "This script will skip secret creation if you leave the value for the secret blank."

for SECRET in ${SECRETS_TO_CREATE[@]}; do
	read -sp "Input secret value for $SECRET: " SECRET_VALUE

	if [ -z $SECRET_VALUE ]; then
		echo "No value entered for $SECRET. Skipping to next secret."
		continue
	fi
	
	SECRET_ID=$(echo -n "$SECRET_VALUE" | docker secret create $SECRET -)
	echo ""

	if [ $? -eq 0 ]; then
		echo "Secret for '$SECRET' with ID of $SECRET_ID added successfully."
	else
		echo "Failed to create secret '$SECRET'."
	fi
done
