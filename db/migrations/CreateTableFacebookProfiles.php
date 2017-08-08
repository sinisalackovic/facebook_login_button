<?php

class CreateTableUsersGroups extends Ruckusing_Migration_Base
{
 public function up()
    {
        $this->execute("
            CREATE TABLE `facebook_profiles` (
             `id`           int(11)   UNSIGNED  NOT NULL AUTO_INCREMENT,
             `profile_id`   bigint              NOT NULL,
             `token`        TEXT          COLLATE utf8_unicode_ci NOT NULL,
             `first_name`   varchar(50)   COLLATE utf8_unicode_ci NOT NULL,
             `last_name`    varchar(50)   COLLATE utf8_unicode_ci NOT NULL,
             `gender`       varchar(50)   COLLATE utf8_unicode_ci NOT NULL,
             `locale`       varchar(10)   COLLATE utf8_unicode_ci NOT NULL,
             `picture`      varchar(255)  COLLATE utf8_unicode_ci NOT NULL,
             `link`         varchar(255)  COLLATE utf8_unicode_ci NOT NULL,
             `is_active`    TINYINT  DEFAULT 1,
             `ts_created`   int(10) UNSIGNED NOT NULL DEFAULT '0',
             `ts_updated`   int(10) UNSIGNED NOT NULL DEFAULT '0',
             PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
    }

    public function down()
    {
        $this->execute("
            DROP TABLE facebook_profiles;
        ");
    }
}
