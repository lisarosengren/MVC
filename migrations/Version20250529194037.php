<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250529194037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE room ADD COLUMN second_description VARCHAR(255)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__room AS SELECT id, image, description, north, south, west, east FROM room
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE room
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE room (id VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, north VARCHAR(25) DEFAULT NULL, south VARCHAR(25) DEFAULT NULL, west VARCHAR(25) DEFAULT NULL, east VARCHAR(25) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO room (id, image, description, north, south, west, east) SELECT id, image, description, north, south, west, east FROM __temp__room
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__room
        SQL);
    }
}
