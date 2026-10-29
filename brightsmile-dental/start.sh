#!/usr/bin/env bash
# Starts the BrightSmile Dental demo on http://127.0.0.1:9400 using WordPress Playground.
# Needs Node.js (https://nodejs.org). Your edits are saved between runs; add --reset to start over.
cd "$(dirname "$0")"
npx -y @wp-playground/cli@latest start \
  --no-auto-mount \
  --mount="$PWD/wp-content/themes/brightsmile:/wordpress/wp-content/themes/brightsmile" \
  --mount="$PWD/wp-content/plugins/brightsmile-appointments:/wordpress/wp-content/plugins/brightsmile-appointments" \
  --blueprint="$PWD/blueprint.json" \
  --port=9400 \
  "$@"
