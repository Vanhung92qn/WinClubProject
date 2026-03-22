# WinClub Project

Game portal: Java (BitZero / Jetty API), Cocos Creator client, Docker infra, PHP CMS.

## Git — làm việc với GitHub

Remote mặc định:

```bash
git remote add origin https://github.com/Vanhung92qn/WinClubProject.git
git branch -M main
```

**Push lần đầu** (trên máy có quyền, sau khi clone hoặc copy repo):

```bash
git push -u origin main
```

GitHub HTTPS sẽ hỏi đăng nhập: dùng **Personal Access Token (PAT)** thay cho mật khẩu ([tạo token](https://github.com/settings/tokens), quyền `repo`).

Hoặc dùng SSH:

```bash
git remote set-url origin git@github.com:Vanhung92qn/WinClubProject.git
git push -u origin main
```

## Clone về máy local

```bash
git clone https://github.com/Vanhung92qn/WinClubProject.git
cd WinClubProject
cp docker/.env.example docker/.env   # chỉnh secrets / port
```

Xem thêm: [`SETUP.md`](SETUP.md), [`docs/ARCHITECTURE.md`](docs/ARCHITECTURE.md), [`docs/MEMORY.md`](docs/MEMORY.md).

## Lưu ý `.gitignore`

- **Không commit:** `docker/data/` (volume DB), `docker/.env`, `client/library/`, `**/build/`, `*.log`, v.v. — tránh repo nặng hàng GB.
- Muốn lưu bản `docker/.env` riêng: dùng secret manager hoặc `git add -f docker/.env` (không khuyến nghị public repo).
