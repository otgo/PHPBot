# PhpBot

```bash
git clone --recursive https://github.com/otgo/PHPBot.git
cd PHPBot
```



Set webhooks: 
```bash
TOKEN="BOT_TOKEN_HERE"
URL_SCRIPT="https://mi_website.com/PHPBot/bot.php"
curl "https://api.telegram.org/bot${TOKEN}/setWebhook?url=${URL_SCRIPT}"
```
