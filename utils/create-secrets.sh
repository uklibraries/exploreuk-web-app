#!/bin/sh
# Location of this script, no matter where on the system you run it
SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )

# List of all secrets needed
SECRETS_TO_CREATE=("mysql_root_password" "mysql_database" "mysql_user" "mysql_password" "db_host" "db_prefix" "db_port" "db_charset")
SECRETS_DIR=$SCRIPT_DIR/../secrets

if [ ! -d "$SECRETS_DIR" ]; then
	echo "Secrets directory '$SECRETS_DIR' not found."
	echo "Create a directory in the root of the project with the following secret files:"
	for SECRET in ${SECRETS_TO_CREATE[@]}; do
		echo $SECRET;
	done
	exit 1
fi

for SECRET in ${SECRETS_TO_CREATE[@]}; do
	if [ ! -r "$SECRETS_DIR/$SECRET.txt" ]; then
		echo "Secret file $SECRET.txt not found at $SECRETS_DIR/$SECRET.txt. Skipping to next secret."
		continue
	fi
	
	SECRET_ID=$(docker secret create $SECRET "$SECRETS_DIR/$SECRET.txt")

	if [ $? -eq 0 ]; then
		echo "Secret for '$SECRET' with ID $SECRET_ID added successfully."
	else
		echo "Failed to create secret '$SECRET'."
	fi
	echo ""
done
