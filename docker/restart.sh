#!/usr/bin/env bash
docker-compose -f docker-compose.yml -f docker-compose.unison.yml restart $@