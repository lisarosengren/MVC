<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250530100141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__room AS SELECT id, image, description, north, south, west, east, second_description, start FROM room
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE room
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE room (id VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, north VARCHAR(25) DEFAULT NULL, south VARCHAR(25) DEFAULT NULL, west VARCHAR(25) DEFAULT NULL, east VARCHAR(25) DEFAULT NULL, second_description VARCHAR(255) DEFAULT NULL, start BOOLEAN DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO room (id, image, description, north, south, west, east, second_description, start) SELECT id, image, description, north, south, west, east, second_description, start FROM __temp__room
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__room
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__room AS SELECT id, image, description, north, south, west, east, second_description, start FROM room
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE room
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE room (id VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, north VARCHAR(25) DEFAULT NULL, south VARCHAR(25) DEFAULT NULL, west VARCHAR(25) DEFAULT NULL, east VARCHAR(25) DEFAULT NULL, second_description VARCHAR(255) DEFAULT 'FALSE', start BOOLEAN DEFAULT FALSE, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO room (id, image, description, north, south, west, east, second_description, start) SELECT id, image, description, north, south, west, east, second_description, start FROM __temp__room
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__room
        SQL);
    }
}
