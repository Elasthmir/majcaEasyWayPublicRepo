<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250126133759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE liczby_rzeczywiste (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, question VARCHAR(255) DEFAULT NULL, answear VARCHAR(255) DEFAULT NULL, answer_bad1 VARCHAR(255) DEFAULT NULL, answer_bad2 VARCHAR(255) DEFAULT NULL, answer_bad3 VARCHAR(255) DEFAULT NULL, command VARCHAR(255) DEFAULT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE liczby_rzeczywiste');
    }
}
