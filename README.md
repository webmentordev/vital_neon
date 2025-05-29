# Install Spatie Browser Libraries for Puppeteer
## Install Puppteer
```
npx puppeteer browsers install chrome-headless-shell
```
Make directory, copy headless chrome files, assign permission
```
mkdir -p /var/www/.cache/puppeteer
cp -r /root/.cache/puppeteer/chrome-headless-shell /var/www/.cache/puppeteer/
chown -R www-data:www-data /var/www/.cache
```
Install all packages for headless browser
```
sudo apt-get install -y \
  ca-certificates \
  fonts-liberation \
  libappindicator3-1 \
  libasound2 \
  libatk-bridge2.0-0 \
  libdrm2 \
  libgtk-3-0 \
  libnspr4 \
  libnss3 \
  libxcomposite1 \
  libxdamage1 \
  libxrandr2 \
  libxss1 \
  libxtst6 \
  libgbm1 \
  xdg-utils
```