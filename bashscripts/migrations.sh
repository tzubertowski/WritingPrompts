#!/bin/bash
php app/console doctrine:schema:update --force
php app/console doctrine:migrations:generate
