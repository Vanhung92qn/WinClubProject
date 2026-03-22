# Server Setup & Deployment Guide

## 1. Prerequisites
- VPS OS: Ubuntu 22.04 LTS (Recommended)
- Required Tools: Docker, Docker Compose, Git, Python 3.10+, Java 8/11.

## 2. Infrastructure Setup
*(Agent will automatically execute commands below and tick the checkboxes. Manual steps are delegated to the User).*

- [ ] Update System Packages: `apt update && apt upgrade -y`
- [ ] Install Docker & Compose.
- [ ] Install Git credentials. (User must input SSH key/PAT).
- [ ] Copy Docker env: `cp docker/.env.example docker/.env` and edit secrets (file `docker/.env` is gitignored).

## 3. Database Initialization
- [ ] Validate compose: `docker compose --env-file docker/.env -f docker/env-setup-docker-compose.yml config`
- [ ] Run: `docker compose --env-file docker/.env -f docker/env-setup-docker-compose.yml up -d`
- [ ] **MongoDB (dev, single-node):** `docker/config/mongod/mongod.conf` — `authorization: enabled` only (no `keyFile` / replica set). Root user comes from `MONGO_INITDB_ROOT_*` in `docker/.env` on first empty volume. Match `server/api/VinPlayPortal/config/mongo.properties` (`host=10.5.0.3`, same password). **Replica set + keyFile** is optional for production; see `docs/MEMORY.md`.
- [ ] **MySQL:** import app schema (e.g. `server/env-setup/config/mysql/20250301.sql`) if `vinplay` / `vinplay_admin` are missing — `server_orig.sql` alone may not create them.

## 4. Backend Compilation
- [ ] Run `gradlew build` inside `server`.

## 5. Web / Nginx / Domain
- [ ] Follow [`docs/SETUP-WEB-PRODUCTION.md`](docs/SETUP-WEB-PRODUCTION.md) (Cocos `web-mobile`, Nginx snippet, TLS, Cloudflare).

*Note: This file will be populated dynamically by the AI Agent over time.*
