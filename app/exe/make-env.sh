#!/usr/bin/env bash
set -eu

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
REPO_ROOT="$(cd "$SCRIPT_DIR/../.." && pwd)"
EXAMPLE_CONFIG="$REPO_ROOT/.env.example"
DEFAULT_FILE_EXTENSION=".dev"

if [ ! -f "$EXAMPLE_CONFIG" ]; then
  echo "Error: Configuration file '$EXAMPLE_CONFIG' not found."
  echo ".env.example in repo root required for this script."
  exit 1
fi

confirm() {
  local reply
  while true; do
    read -r -p "$1" reply
    case $reply in
      y|Y)    return 0 ;;
      n|N|'') return 1 ;;
      *)      echo "Invalid input" ;;
    esac
  done
}

EXAMPLE_EXTENSION="${EXAMPLE_CONFIG##*.}"

if confirm "Default file extension is $DEFAULT_FILE_EXTENSION. Change? [y/N] "; then
  while true; do
    read -r -p "New file extension: ." NEW_EXTENSION
    if [[ $NEW_EXTENSION == "$EXAMPLE_EXTENSION" ]]; then
      echo "Refusing to overwrite example file."
    elif [[ ! $NEW_EXTENSION =~ ^[A-Za-z0-9._-]+$ ]]; then
      echo "Extension must be letters, numbers, dots, dashes, or underscores."
    else
      file_extension=".$NEW_EXTENSION"
      break
    fi
  done
  echo "File extension: $file_extension"
else
  file_extension=$DEFAULT_FILE_EXTENSION
  echo "skipped..."
fi
printf "\n"

TEMP_CONFIG=$(mktemp)
trap 'rm -f "$TEMP_CONFIG"' EXIT

# Read the example on fd 3 rather than stdin, so the prompts inside the loop
# still reach the keyboard instead of consuming the next config line
while IFS= read -r line <&3 || [[ -n $line ]]; do
  # Carry comments and blank lines through
  if [[ -z $line || $line =~ ^[[:space:]]*# ]]; then
    printf '%s\n' "$line" >> "$TEMP_CONFIG"
    continue
  fi

  if [[ $line != *=* ]]; then
    echo "Warning: no '=' in line, copying as-is: $line" >&2
    printf '%s\n' "$line" >> "$TEMP_CONFIG"
    continue
  fi

  key="${line%%=*}"
  value="${line#*=}"

  if confirm "Key $key has example value $value. Change? [y/N] "; then
    read -r -p "New value for $key: " new_value
    new_value="${new_value%\"}"
    new_value="${new_value#\"}"
    value="\"$new_value\""
    echo "$key=$value"
  else
    echo "skipped..."
  fi
  printf "\n"

  printf '%s=%s\n' "$key" "$value" >> "$TEMP_CONFIG"
done 3< "$EXAMPLE_CONFIG"

TARGET_CONFIG="${EXAMPLE_CONFIG%.*}${file_extension}"
printf "\n"
echo "File to write: "
echo "$TARGET_CONFIG"
echo "Config to write: "
cat "$TEMP_CONFIG"
printf "\n"

if [[ -f $TARGET_CONFIG ]]; then
  echo "$TARGET_CONFIG already exists! Accepting will overwrite."
fi

if confirm "y to accept, or n/Enter to exit: "; then
  cat "$TEMP_CONFIG" > "$TARGET_CONFIG"
  echo "Config created. Exiting."
else
  echo "Config rejected. Please run command again."
  exit 1
fi
