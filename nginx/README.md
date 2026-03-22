# Nginx assets (WinClub)

| File | Purpose |
|------|---------|
| [`snippets/winclub-game-routes.inc`](snippets/winclub-game-routes.inc) | Shared `location` blocks: `/api-portal`, `/api`, `/socket-client/*`, relay, livestream proxy paths, CMS WebSocket routes. **Single place to edit** when adding a game port. |
| [`../sites-available/sieuno.online`](../sites-available/sieuno.online) | Example vhost for **sieuno.online** (play + landing + admin + agent). |

Deploy copies snippets into `/etc/nginx/snippets/` (see [`docs/SETUP-WEB-PRODUCTION.md`](../docs/SETUP-WEB-PRODUCTION.md)).
