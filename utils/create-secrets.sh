#!/bin/bash 
set -euo pipefail

# New files will be created with rw-------
umask 077

# The directory where this file exists
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

# Default to the directory above this script (possibly the root of the project)
: "${SECRETS_DIR:=$SCRIPT_DIR/../secrets}"

# List of all secrets needed
SECRETS_TO_CREATE=("mysql_root_password" "mysql_database" "mysql_user" "mysql_password" "mysql_backup_password")

if [ ! -d "$SECRETS_DIR" ]; then
	echo "Secrets directory '$SECRETS_DIR' not found. Creating directory."
	mkdir -p "$SECRETS_DIR"
fi

for SECRET in "${SECRETS_TO_CREATE[@]}"; do
	TARGET="$SECRETS_DIR/$SECRET.txt"

	if [ -e "$TARGET" ]; then
		read -rp "$TARGET exists. Overwrite? [y/N] " OVERWRITE
		case "$OVERWRITE" in
			# y, Y, yes, Yes, YES, etc.
			[yY]|[yY][eE][sS])
				echo "Overwriting"
				;;
			*)
				echo "Not overwriting and skipping to next secret"
				continue
				;;
		esac
	fi

	echo "Creating $TARGET"
	touch "$TARGET"
	read -rsp "Secret contents: " CONTENTS

	# newline
	echo ""

	echo -n "$CONTENTS" > "$SECRETS_DIR/$SECRET.txt"
	echo "Secret $SECRET added."
done

echo "All secrets added. Exiting"
exit 0
