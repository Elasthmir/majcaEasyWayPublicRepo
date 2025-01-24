<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250119044222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE linear_algebra ADD COLUMN command VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__linear_algebra AS SELECT id, question, answear, answer_bad_1, answer_bad_2, answer_bad_3 FROM linear_algebra');
        $this->addSql('DROP TABLE linear_algebra');
        $this->addSql('CREATE TABLE linear_algebra (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, question VARCHAR(255) DEFAULT NULL, answear VARCHAR(255) DEFAULT NULL, answer_bad_1 VARCHAR(255) DEFAULT NULL, answer_bad_2 VARCHAR(255) DEFAULT NULL, answer_bad_3 VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO linear_algebra (id, question, answear, answer_bad_1, answer_bad_2, answer_bad_3) SELECT id, question, answear, answer_bad_1, answer_bad_2, answer_bad_3 FROM __temp__linear_algebra');
        $this->addSql('DROP TABLE __temp__linear_algebra');
    }
}
