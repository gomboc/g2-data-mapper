#!/bin/bash 
git add .

COMMENT="'"
for var in "$@"
do
        COMMENT=$COMMENT"$var"" "
done
COMMENT=$COMMENT"'"

git commit -am "$COMMENT"

git pull

git push
