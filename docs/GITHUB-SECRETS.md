# GitHub Secrets — CI/CD WinClub

Tất cả secrets được cấu hình tại:
**GitHub Repo → Settings → Secrets and variables → Actions**

---

## Required Secrets

| Secret | Bắt buộc | Mô tả |
|--------|:--------:|-------|
| `SSH_HOST` | ✅ | IP hoặc hostname server production (VD: `123.45.67.89` hoặc `sieuno.online`) |
| `SSH_USER` | ✅ | Linux user dùng để SSH (VD: `ubuntu`, `deploy`, `root`) |
| `SSH_PRIVATE_KEY` | ✅ | Nội dung file private key (bắt đầu `-----BEGIN OPENSSH PRIVATE KEY-----`) |
| `SSH_PORT` | ⬜ | SSH port — mặc định `22` nếu không set |

---

## Cách thiết lập SSH Key

### 1. Tạo deploy key trên server (hoặc máy local)

```bash
# Tạo key pair riêng cho CI (không dùng chung với personal key)
ssh-keygen -t ed25519 -C "github-actions-winclub" -f ~/.ssh/winclub_deploy -N ""
```

### 2. Thêm public key vào server

```bash
# Copy public key vào authorized_keys trên server production
cat ~/.ssh/winclub_deploy.pub >> ~/.ssh/authorized_keys
chmod 600 ~/.ssh/authorized_keys
```

### 3. Thêm private key vào GitHub Secrets

```bash
# In ra nội dung để copy vào GitHub Secret SSH_PRIVATE_KEY
cat ~/.ssh/winclub_deploy
```

→ GitHub Repo → Settings → Secrets → New repository secret → `SSH_PRIVATE_KEY` → paste toàn bộ nội dung.

### 4. Thêm SSH_HOST, SSH_USER

```
SSH_HOST  = <IP server hoặc domain>
SSH_USER  = <user Linux trên server>
SSH_PORT  = 22   (hoặc bỏ qua nếu dùng port 22 mặc định)
```

---

## Environments

Workflow `backend-ci.yml`, `cms-deploy.yml`, `deploy-game.yml` dùng `environment: production`.

Nếu muốn **manual approval** trước khi deploy:

1. GitHub Repo → Settings → Environments → New environment → đặt tên `production`
2. Bật **Required reviewers** → thêm reviewer
3. Từ đó mọi deploy sẽ chờ approve trước khi chạy SSH

---

## Workflows và Secrets sử dụng

| Workflow | Secrets dùng | Trigger |
|----------|-------------|---------|
| `backend-ci.yml` | `SSH_HOST`, `SSH_USER`, `SSH_PRIVATE_KEY`, `SSH_PORT` | Push main `server/**` |
| `frontend-test.yml` | _(không cần SSH)_ | Push main `client/**` |
| `game-servers-ci.yml` | _(không cần SSH — build only)_ | Push main `server/game/**` |
| `deploy-game.yml` | `SSH_HOST`, `SSH_USER`, `SSH_PRIVATE_KEY`, `SSH_PORT` | Manual dispatch |
| `cms-deploy.yml` | `SSH_HOST`, `SSH_USER`, `SSH_PRIVATE_KEY`, `SSH_PORT` | Push main `cms/**` |

---

## Kiểm tra kết nối SSH từ Actions

Chạy workflow thủ công với script test trước:

```bash
# Trên server, kiểm tra user có quyền sudo reload php-fpm không:
sudo -l | grep php-fpm
# Nếu không có → thêm vào /etc/sudoers.d/deploy:
# deploy ALL=(ALL) NOPASSWD: /usr/bin/systemctl reload php8.3-fpm
```
