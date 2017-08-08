
COL_ON = \e[36m
COL_OFF = \e[m
TITLE = ${COL_ON}[dynamic-project]${COL_OFF}

ENV = `[ $(env) ] && echo $(env) || echo "local"`

environment: environment-set
	@if test "$(env)" = ""; then echo "Environment variable is not set. Missing param env=<enviroment-name>"; exit 1; fi; \

environment-set:
	@/bin/echo -e "${TITLE} environment: $(env)"

##############################################################################################
####################################### C O M P O S E R ######################################
##############################################################################################

autoload:
	@/bin/echo -e "${TITLE} generating autoloader..." \
	&& php composer.phar dump-autoload --optimize

get-composer:
	@/bin/echo -e "${TITLE} downloading composer..." \
	&& curl -sS https://getcomposer.org/installer | php \

clean-composer-lock:
	@rm -rf composer.lock \
	&& /bin/echo -e "${TITLE} deleted composer.lock"

install: get-composer
	@/bin/echo -e "${TITLE} installing dependencies..." \
	&& php composer.phar install --optimize-autoloader \
	&& /bin/echo -e "${TITLE} dependencies installed"

self-update:
	@ /bin/echo -e "${TITLE} running composer self update" \
	&& php composer.phar self-update

update: clean-composer-lock
	@ /bin/echo -e "${TITLE} update dependencies..." \
	&& php composer.phar update --optimize-autoloader $(p)\
	&& /bin/echo -e "${TITLE} dependencies updated"

##############################################################################################
###################################### D A T A B A S E #######################################
##############################################################################################

DB-APP-PATH = db

db-create: environment
	@/bin/echo -e "${TITLE} create database..." \
	&& php db/tools.php create:database env=$(env) \
	&& /bin/echo -e "${TITLE} database created"

db-drop:
	@/bin/echo -e "${TITLE} drop database..." \
	&& php db/tools.php drop:database env=$(env) \
	&& /bin/echo -e "${TITLE} database droped"

db-migrate: environment
	@cd ${DB-APP-PATH} \
	&& /bin/echo -e "${TITLE} migrating database..." \
	&& php ruckus.php db:migrate env=$(env) \
	&& /bin/echo -e "${TITLE} database migrated"

db-migration-new: environment
	@cd ${DB-APP-PATH} \
	&& /bin/echo -e "${TITLE} create new migration script..." \
	&& php ruckus.php db:generate $(name) env=$(env) \
	&& /bin/echo -e "${TITLE} new migration script created"

db-migrate-down: environment
	@cd ${DB-APP-PATH} \
	&& /bin/echo -e "${TITLE} migrating database..." \
	&& php ruckus.php db:migrate VERSION=-1 env=$(env) \
	&& /bin/echo -e "${TITLE} database migrated"

##############################################################################################
################################### T E S T   S U I T E S ####################################
##############################################################################################

unit-tests:
	@/bin/echo -e "${TITLE} running unit tests suite..." \
	&& ./vendor/bin/phpunit -c tests/unit/phpunit.xml --coverage-html tests/unit/coverage \
	&& /bin/echo -e "${TITLE} unit tests completed"

config:
	@/bin/echo -e "${TITLE} generating config..." \
	&& php bin/config/generator.php --env $(ENV) \
	&& /bin/echo -e "${TITLE} config generated for: $(ENV)"