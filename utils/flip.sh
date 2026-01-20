#!/usr/bin/env bash
set -eu;

source "$PATH_TO_PROFILE";

if [ $# -ne 2 ]; then
	echo "Usage: $0 {staging|prod} {green|blue}"
	exit 1
fi

target=$1
color=$2

# Make sure arg 1 is either green or blue and
# assign conf to the right file location
case "$color" in
	green) conf=/etc/nginx/conf.d/euk.green ;;
	blue) conf=/etc/nginx/conf.d/euk.blue ;;
	*) echo "color must be green or blue"; exit 1 ;;
esac

# Make sure arg 2 is either staging or prod and
# assign env to the right file location
case "$target" in
	staging) env=/etc/nginx/conf.d/euk.staging ;;
	prod) env=/etc/nginx/conf.d/euk.prod ;;
	*) echo "target env must be staging or prod"; exit 1 ;;
esac


ssh "$USER@$REMOTE_HOST" bash <<EOC
	set -eu

	lead=\$(readlink -f "$env")
	# Make sure the flip needs to happen otherwise exit
	if [[ -e "$conf" && -e "\$lead" && "$conf" -ef "\$lead" ]]; then
		echo "Target environment $target already points to $color"
		echo "Skipping flip"
		exit 0
	fi

	sudo -n /usr/bin/ln -sfn "$conf" $env
	sudo -n /usr/sbin/nginx -t
	sudo -n /usr/sbin/nginx -s reload
EOC

echo "Switch $target environment to $color complete"
exit 0
