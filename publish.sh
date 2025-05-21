#!/bin/bash

# Define source and destination
SRC="/Users/kemish/Sites/thekatalystgroup/"
DEST="kemish@thekatalyst.group:/opt/bitnami/apache2/htdocs"

# Run rsync with options:
# -a = archive mode (preserves permissions)
# -v = verbose
# -z = compress during transfer
# -h = human-readable output
# --delete = delete files on the destination that no longer exist on source

rsync -avzh --delete --exclude=".git" --exclude="node_modules" --exclude="*.log" --exclude="builders" "$SRC" "$DEST"