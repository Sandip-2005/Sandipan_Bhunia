# 🚀 Auto-Deployment Setup Guide

## Step-by-Step Configuration

### Phase 1: Manual Deployment (Complete First)

#### 1.1 InfinityFree Account Setup
- ✅ Create account at https://infinityfree.net
- ✅ Create website with subdomain (e.g., sandipanbhunia.infinityfreeapp.com)
- ✅ Create MySQL database
- ✅ Upload deployment-package files to public_html
- ✅ Configure .env file with database credentials
- ✅ Run initial-setup.php to initialize the site

### Phase 2: Auto-Deployment Configuration

#### 2.1 Update Deploy Script Configuration

**IMPORTANT**: You need to update the `deploy.php` file with your actual InfinityFree path.

1. **Find Your InfinityFree Path**:
   - Login to InfinityFree Control Panel
   - Go to File Manager
   - Look at the address bar or breadcrumb
   - Your path will be something like: `/home/vol4_1/infinityfree.com/if0_XXXXXXXX/htdocs`

2. **Update deploy.php**:
   ```php
   $secret = 'sandipan-portfolio-webhook-2024-secure';
   $repo_path = '/home/vol4_1/infinityfree.com/if0_XXXXXXXX/htdocs'; // Replace XXXXXXXX with your actual account ID
   $branch = 'main';
   $github_repo = 'https://github.com/Sandip-2005/Sandipan_Bhunia.git';
   ```

#### 2.2 Upload Updated Deploy Script

1. Upload the updated `deploy.php` to your InfinityFree `public_html` directory
2. Make sure it's in the root directory (same level as index.php)

#### 2.3 Set Up GitHub Webhook

1. **Go to your GitHub repository**: https://github.com/Sandip-2005/Sandipan_Bhunia
2. **Click "Settings"** (in the repository, not your account)
3. **Click "Webhooks"** in the left sidebar
4. **Click "Add webhook"**
5. **Configure the webhook**:
   - **Payload URL**: `https://yoursubdomain.infinityfreeapp.com/deploy.php`
   - **Content type**: `application/json`
   - **Secret**: `sandipan-portfolio-webhook-2024-secure` (same as in deploy.php)
   - **Which events**: Select "Just the push event"
   - **Active**: ✅ Checked
6. **Click "Add webhook"**

#### 2.4 Initialize Git Repository on Server

**IMPORTANT**: You need to clone your repository to the server first.

1. **Access InfinityFree Terminal** (if available) or use File Manager
2. **Navigate to your public_html directory**
3. **Initialize Git** (this might need to be done via support ticket if terminal access is limited):
   ```bash
   cd /home/vol4_1/infinityfree.com/if0_XXXXXXXX/htdocs
   git init
   git remote add origin https://github.com/Sandip-2005/Sandipan_Bhunia.git
   git fetch origin
   git reset --hard origin/main
   ```

**Note**: If you don't have terminal access, you may need to:
- Contact InfinityFree support to enable Git
- Or use the File Manager to manually sync files initially

### Phase 3: Testing Auto-Deployment

#### 3.1 Test the Webhook

1. **Make a small change** to your portfolio (e.g., update README.md)
2. **Commit and push**:
   ```bash
   git add .
   git commit -m "Test auto-deployment"
   git push origin main
   ```
3. **Check webhook delivery**:
   - Go to GitHub → Settings → Webhooks
   - Click on your webhook
   - Check "Recent Deliveries" tab
   - Should show successful delivery (green checkmark)

#### 3.2 Check Deployment Logs

1. **Visit**: `https://yoursubdomain.infinityfreeapp.com/deploy.log`
2. **Should show**: Deployment activity and command outputs
3. **Check your site**: Verify changes are live

### Phase 4: Troubleshooting

#### Common Issues:

**1. Webhook Returns 403 Forbidden**
- Check that the secret in deploy.php matches the GitHub webhook secret
- Verify the webhook URL is correct

**2. Webhook Returns 500 Error**
- Check deploy.log for PHP errors
- Verify the repository path is correct
- Ensure Git is initialized on the server

**3. Git Commands Fail**
- Contact InfinityFree support to enable Git access
- Verify the repository URL is accessible
- Check file permissions

**4. Composer/Artisan Commands Fail**
- Verify PHP version compatibility
- Check that all required PHP extensions are available
- Ensure proper file permissions

#### Debug Steps:

1. **Check webhook delivery** in GitHub
2. **Check deploy.log** on your server
3. **Test deploy.php manually** by visiting it in browser
4. **Verify file permissions** (755 for directories, 644 for files)

### Phase 5: Security & Maintenance

#### 5.1 Security Best Practices

1. **Use strong webhook secret**
2. **Regularly update dependencies**
3. **Monitor deploy.log** for suspicious activity
4. **Keep backup** of your database

#### 5.2 Regular Maintenance

1. **Weekly**: Check deployment logs
2. **Monthly**: Update Composer dependencies
3. **Quarterly**: Review and update webhook secrets

## 🎯 Success Indicators

When everything is working correctly:

✅ **GitHub webhook shows green checkmarks**
✅ **deploy.log shows successful deployments**
✅ **Site updates automatically after git push**
✅ **No 403/500 errors in webhook deliveries**

## 📞 Support Resources

- **InfinityFree Support**: https://infinityfree.net/support
- **GitHub Webhooks Docs**: https://docs.github.com/en/webhooks
- **Laravel Deployment**: https://laravel.com/docs/deployment

## 🚀 Your Workflow After Setup

1. **Code locally** → Make changes to your portfolio
2. **Test locally** → `php artisan serve`
3. **Commit changes** → `git add . && git commit -m "Description"`
4. **Push to GitHub** → `git push origin main`
5. **Auto-deploy** → Your live site updates automatically! 🎉

---

**Remember**: Always test changes locally before pushing to production!