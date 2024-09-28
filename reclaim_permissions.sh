#!/bin/bash

PROJECT_DIR="/var/www/html/blog"

# Transfer ownership back to me
sudo chown -R mo:mo $PROJECT_DIR

# Set appropriate permissions
sudo chmod -R 755 $PROJECT_DIR

echo "Permissions and ownership transferred back to user 'mo'."
