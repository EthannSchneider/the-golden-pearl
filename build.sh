#!/bin/bash

version=$(cat src/backend/composer.json | grep version | head -1 | awk -F: '{ print $2 }' | sed 's/[",]//g' | tr -d '[[:space:]]')

# Check if php, node, npm, and composer are installed.
if ! [ -x "$(command -v php)" ]; then
  echo 'Error: php is not installed.' >&2
  exit 1
fi

if ! [ -x "$(command -v node)" ]; then
  echo 'Error: node is not installed.' >&2
  exit 1
fi

if ! [ -x "$(command -v npm)" ]; then
  echo 'Error: npm is not installed.' >&2
  exit 1
fi

if ! [ -x "$(command -v composer)" ]; then
  echo 'Error: composer is not installed.' >&2
  exit 1
fi

# Install dependencies.
cd ./src/backend
composer install
cd ../frontend
npm install

# Build frontend.
npm run build

cd ../..

if ! [ -d "./build" ]; then
  mkdir ./build/
fi

rm -rf ./build/dist/

rm -r ./src/backend/views/*

cp -r ./src/frontend/build/* ./src/backend/views/

cp -r ./src/backend/ ./build/dist/

cd ./build/dist/
zip -r ../The-golden-pearl-$version.zip ./*
cd ../..

echo "The-golden-pearl-$version.zip has been created in the build directory."