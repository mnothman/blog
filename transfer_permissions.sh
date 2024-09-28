#!/bin/bash

PROJECT_DIR="/var/www/html/blog"

# Transfer ownership to apache user and group
sudo chown -R apache:apache $PROJECT_DIR

# Set appropriate permissions
sudo chmod -R 755 $PROJECT_DIR

echo "Permissions and ownership transferred to apache."
