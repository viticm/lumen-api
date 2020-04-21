#!/bin/sh

find ./ -name "*.php" | awk '{cmd="mv " $1 " " $1".bak";system(cmd)}'
