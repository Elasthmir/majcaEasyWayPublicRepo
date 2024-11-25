<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017180607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE user_maker_bundle (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, nick_name VARCHAR(20) NOT NULL, first_name VARCHAR(20) NOT NULL, image_name VARCHAR(20) DEFAULT NULL, is_verified BOOLEAN NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user_maker_bundle (email)');
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_maker_bundle AS SELECT id, email, roles, password FROM user_maker_bundle');
        $this->addSql('DROP TABLE user_maker_bundle');
        $this->addSql('INSERT INTO user_maker_bundle (id, email, roles, password) SELECT id, email, roles, password FROM __temp__user_maker_bundle');
        $this->addSql('DROP TABLE __temp__user_maker_bundle');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user_maker_bundle (email)');
    }
}
