<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241128161405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE score (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id_id INTEGER DEFAULT NULL, score INTEGER NOT NULL, topic VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, CONSTRAINT FK_329937519D86650F FOREIGN KEY (user_id_id) REFERENCES user_maker_bundle (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_329937519D86650F ON score (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE score');
    }
}
