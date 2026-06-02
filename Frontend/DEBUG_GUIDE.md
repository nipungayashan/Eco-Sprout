# EcoSprout Frontend - Debug & Run Guide

## How to Start Debugging

### Option 1: Click "Start Debugging" (Recommended)
1. Open the **Run & Debug** panel (Ctrl+Shift+D or Cmd+Shift+D on Mac)
2. Select **"Debug Frontend - Start Server"** from the dropdown
3. Click the **Play** button or press **F5**
4. The PHP server will start on `localhost:8000`
5. Your browser will automatically open to `http://localhost:8000/index.php`

### Option 2: Use Tasks (Alternative)
1. Press **Ctrl+Shift+B** to run the build/default task
2. This starts the PHP server in the background
3. Manually navigate to `http://localhost:8000/` in your browser

## What Gets Fixed

✅ **Frontend folder** now serves as the web root (not the project root)
✅ **PHP server** runs on port 8000
✅ **Auto-open browser** to the correct index.php page
✅ **XDebug support** enabled for breakpoints and debugging

## Folder Structure

```
d:\ICBT\web anti\EcoSprout\
├── Frontend/                 ← Web root (served by PHP server)
│   ├── index.php            ← Home page
│   ├── staff/               ← Staff pages
│   ├── admin/               ← Admin pages
│   ├── auth/                ← Auth pages
│   ├── customer/            ← Customer pages
│   ├── includes/            ← PHP templates
│   ├── assets/              ← CSS, JS, images
│   └── ...
├── .vscode/
│   ├── launch.json          ← Debug configuration
│   ├── tasks.json           ← Server startup task
│   └── settings.json        ← PHP configuration
└── ...
```

## Troubleshooting

### If WAMP opens instead of your website:
1. Make sure you have PHP installed locally (check `php --version` in terminal)
2. Restart VS Code
3. Make sure the `launch.json` configuration is selected correctly
4. Check the **Terminal** tab - the PHP server output should appear there

### If you get "Connection refused":
1. The PHP server may have crashed - check the Terminal for errors
2. Try stopping the server (Ctrl+C in Terminal) and restarting (F5)
3. Make sure port 8000 isn't already in use

### If breakpoints don't work:
1. Make sure XDebug is installed: `php -m | grep -i xdebug`
2. Rebuild the settings by restarting VS Code

## Server Details

- **URL**: `http://localhost:8000`
- **Root Directory**: `/Frontend`
- **Main Pages**: 
  - Home: `http://localhost:8000/index.php`
  - Catalogue: `http://localhost:8000/catalogue.php`
  - Staff: `http://localhost:8000/staff/index.php`
  - Admin: `http://localhost:8000/admin/index.php`

## Stopping the Server

Press **Ctrl+C** in the Terminal where the PHP server is running, or click the Stop button in the Debug panel.

---

**Ready to debug!** Press F5 to get started. 🚀
