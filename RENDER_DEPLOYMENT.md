# 🚀 Render Deployment Guide

Deploy your Laravel portfolio to Render with automatic GitHub integration and free hosting.

## 🎯 Why Render?

✅ **Free Tier Available** - Perfect for portfolios  
✅ **Automatic Deployments** - Push to GitHub → Auto deploy  
✅ **Docker Support** - Consistent environment  
✅ **Free Database** - PostgreSQL/MySQL included  
✅ **Custom Domains** - Professional URLs  
✅ **SSL Certificates** - Automatic HTTPS  

## 📋 Prerequisites

- GitHub account with your portfolio repository
- Render account (free signup at https://render.com)

## 🚀 Deployment Steps

### Step 1: Fix Build Script Permissions

First, make sure the build script has executable permissions:

```bash
git update-index --chmod=+x build.sh
git update-index --chmod=+x docker/startup.sh
git add .
git commit -m "Fix script permissions for Render deployment"
git push origin main
```

### Step 2: Create Render Account

1. **Go to**: https://render.com
2. **Sign up** with your GitHub account
3. **Authorize** Render to access your repositories

### Step 3: Create Database First

1. **Click "New +"** → **"PostgreSQL"**
2. **Configure**:
   - **Name**: `portfolio-db`
   - **Database**: `portfolio`
   - **User**: `portfolio_user`
   - **Region**: `Oregon (US West)`
   - **Plan**: `Free`
3. **Wait for database** to be created (2-3 minutes)

### Step 4: Create Web Service

1. **Click "New +"** → **"Web Service"**
2. **Connect your repository**: `Sandip-2005/Sandipan_Bhunia`
3. **Configure the service**:
   - **Name**: `sandipan-portfolio`
   - **Region**: `Oregon (US West)`
   - **Branch**: `main`
   - **Runtime**: `Docker`
   - **Dockerfile Path**: `./Dockerfile`

### Step 5: Configure Environment Variables

In your web service settings, add these environment variables:

**Required Variables:**
```env
APP_NAME=Sandipan Bhunia Portfolio
APP_ENV=production
APP_DEBUG=false
SESSION_DRIVER=database
CACHE_DRIVER=database
QUEUE_CONNECTION=database
MAIL_MAILER=log
```

**Database Variables** (get from your database dashboard):
```env
DB_CONNECTION=pgsql
DB_HOST=[your-database-host]
DB_PORT=5432
DB_DATABASE=portfolio
DB_USERNAME=portfolio_user
DB_PASSWORD=[your-database-password]
```

### Step 6: Deploy

1. **Click "Create Web Service"**
2. **Wait for build** (5-10 minutes for first deployment)
3. **Check logs** for any errors
4. **Visit your site** at the provided Render URL

## 🔗 Your Live URLs

After deployment:
- **Portfolio**: `https://sandipan-portfolio.onrender.com`
- **Admin Panel**: `https://sandipan-portfolio.onrender.com/secret-gateway/login`
- **Admin Credentials**: `admin` / `portfolio2024`

## 🛠️ Local Development with Docker

Test your Docker setup locally:

```bash
# Build and run with Docker Compose
docker-compose up --build

# Visit: http://localhost:8000
```

## 🔄 Automatic Deployments

Once set up, every push to GitHub automatically deploys:

```bash
git add .
git commit -m "Update portfolio"
git push origin main
# Render automatically deploys! 🚀
```

## 📊 Monitoring

- **Render Dashboard**: Monitor deployments, logs, and metrics
- **Build Logs**: Check for deployment issues
- **Runtime Logs**: Monitor application performance

## 🎨 Custom Domain (Optional)

1. **In Render Dashboard** → **Settings** → **Custom Domains**
2. **Add your domain**: `sandipanbhunia.com`
3. **Update DNS** with provided CNAME records
4. **SSL certificate** automatically provisioned

## 🔧 Troubleshooting

### Build Fails - Permission Denied

**Problem**: `build.sh: Permission denied`

**Solution**:
```bash
git update-index --chmod=+x build.sh
git update-index --chmod=+x docker/startup.sh
git add .
git commit -m "Fix script permissions"
git push origin main
```

### Database Connection Issues

**Problem**: `SQLSTATE[HY000] [2002] Connection refused`

**Solutions**:
1. **Check database is running** in Render dashboard
2. **Verify environment variables** match database credentials
3. **Ensure same region** for database and web service
4. **Wait for database** to be fully provisioned (2-3 minutes)

### Build Timeout

**Problem**: Build takes too long and times out

**Solution**:
- **Free tier limitation** - builds can take 10-15 minutes
- **Check build logs** for specific errors
- **Retry deployment** if it times out

### Application Key Missing

**Problem**: `No application encryption key has been specified`

**Solution**: The Dockerfile now generates the key automatically, but if you see this error:
1. **Check environment variables** in Render dashboard
2. **Redeploy** the service to regenerate the key

### File Upload Issues

**Problem**: Images not uploading in admin panel

**Solution**:
- **Check file permissions** in logs
- **Verify uploads directory** exists
- **Check file size limits** (Render has limits on free tier)

### Slow Performance

**Problem**: Site loads slowly or times out

**Causes**:
- **Free tier sleep** - services sleep after 15 minutes of inactivity
- **Cold start** - first request after sleep takes 30-60 seconds
- **Database connection** - initial connection can be slow

**Solutions**:
- **Upgrade to paid plan** for always-on service
- **Use external monitoring** to keep service awake
- **Optimize database queries** and caching

## 📈 Performance Optimization

### Free Tier Limitations
- **Sleep after 15 minutes** of inactivity
- **750 hours/month** (sufficient for portfolios)
- **Slower cold starts** (first request after sleep)

### Upgrade Benefits
- **No sleep** on paid plans
- **Faster builds** and deployments
- **More resources** (CPU, RAM)

## 🔒 Security

- **Automatic HTTPS** with SSL certificates
- **Environment variables** for sensitive data
- **No exposed credentials** in code
- **Regular security updates** via Docker base images

## 💰 Cost

- **Free Tier**: Perfect for portfolios
- **Paid Plans**: Start at $7/month for always-on services
- **Database**: Free PostgreSQL included

## 🎯 Next Steps

1. **Deploy to Render** following the steps above
2. **Test your portfolio** thoroughly
3. **Set up custom domain** (optional)
4. **Monitor performance** and logs
5. **Enjoy automatic deployments**! 🎉

---

**🚀 Your portfolio will be live at**: `https://sandipan-portfolio.onrender.com`

**📱 Mobile-optimized, fast, and professional!**