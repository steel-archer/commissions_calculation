**Assumptions about environment**
* Was developed and tested on PHP 8.1.
* PHP curl extension is available.
* For coverage report Xdebug extension is available, `xdebug.mode=coverage` is set.
* Composer is installed.

**API limits**
* Exchange rate API requires registration. It works no more without a passed API key.
* Bin API has a limit: 5 requests per hour. Registration seems to be approved manually and I still do not have a key. So I have to leave it as is. After 5th request there will be an error.

**Dummy resolvers**
That's why in addition to normal implementation of API I also had to implement Dummy Resolvers that return pre-defined data:
* `src/Services/BinResolver/DummyBinResolver.php`
* `src/Services/ExchangeRateResolver/DummyExchangeRateResolver.php`

**How to set up task**
```
git clone git@github.com:steel-archer/commissions_calculation.git
cd commissions_calculation
composer install
cp .env.example .env
```
* In the file `.env` set your value of Exchange rate API key in environment variable `APILAYER_API_KEY`.

**How to run app**
```
# Regular execution:
# (or any file of yours)
php app.php input.txt

# Dummy execution:
php app.php input.txt --dummy

# Tests:
./vendor/bin/phpunit

# Tests (with coverage):
# (also creates HTML report in the directory coverage-report)
./vendor/bin/phpunit --coverage-html coverage-report --coverage-text
```