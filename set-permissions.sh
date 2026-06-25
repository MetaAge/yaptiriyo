#!/usr/bin/env bash
#
# Fix file ownership/permissions for the Laravel backend after a deploy.
#
# A generic 500 server error right after uploading new files is almost always
# this: files land owned by root (or the SFTP user), so the web user (www-data)
# can no longer write storage/ (logs, cache, sessions, compiled views) or
# bootstrap/cache, and Laravel throws on the first write. Run this after every
# deploy. Re-run with sudo if you hit "Operation not permitted".
#
# Usage:
#   sudo bash core/set-permissions.sh            # uses defaults below
#   APP_DIR=/var/www/xilancer WEB_USER=www-data sudo -E bash core/set-permissions.sh

set -euo pipefail

APP_DIR="${APP_DIR:-/var/www/xilancer}"
WEB_USER="${WEB_USER:-www-data}"

echo "Setting ownership: ${WEB_USER}:${WEB_USER} on ${APP_DIR}"
chown -R "${WEB_USER}:${WEB_USER}" "${APP_DIR}"

echo "Setting writable permissions on storage/ and bootstrap/cache"
chmod -R 775 "${APP_DIR}/core/storage" "${APP_DIR}/core/bootstrap/cache" 2>/dev/null \
  || chmod -R 775 "${APP_DIR}/storage" "${APP_DIR}/bootstrap/cache"

echo "Done."
