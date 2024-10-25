<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241025181638 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD COLUMN nick_name VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE user_maker_bundle ADD COLUMN nick_name VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, name, last_name FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(20) NOT NULL, last_name VARCHAR(30) NOT NULL)');
        $this->addSql('INSERT INTO user (id, name, last_name) SELECT id, name, last_name FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_maker_bundle AS SELECT id, email, roles, password, is_verified FROM user_maker_bundle');
        $this->addSql('DROP TABLE user_maker_bundle');
        $this->addSql('CREATE TABLE user_maker_bundle (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO user_maker_bundle (id, email, roles, password, is_verified) SELECT id, email, roles, password, is_verified FROM __temp__user_maker_bundle');
        $this->addSql('DROP TABLE __temp__user_maker_bundle');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user_maker_bundle (email)');
    }
}
