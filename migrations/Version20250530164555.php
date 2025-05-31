<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250530164555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__item AS SELECT id, room_id, examine, deadly, pickable, comb_text, is_last, hidden FROM item
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE item
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE item (id VARCHAR(25) NOT NULL, room_id VARCHAR(255) NOT NULL, item_id VARCHAR(25) DEFAULT NULL, examine VARCHAR(255) NOT NULL, deadly BOOLEAN NOT NULL, pickable BOOLEAN NOT NULL, comb_text VARCHAR(255) DEFAULT NULL, is_last BOOLEAN NOT NULL, hidden BOOLEAN DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_1F1B251E54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1F1B251E126F525E FOREIGN KEY (item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO item (id, room_id, examine, deadly, pickable, comb_text, is_last, hidden) SELECT id, room_id, examine, deadly, pickable, comb_text, is_last, hidden FROM __temp__item
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__item
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1F1B251E54177093 ON item (room_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1F1B251E126F525E ON item (item_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__item AS SELECT id, room_id, examine, deadly, pickable, comb_text, is_last, hidden FROM item
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE item
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE item (id VARCHAR(25) NOT NULL, room_id VARCHAR(255) NOT NULL, examine VARCHAR(255) NOT NULL, deadly BOOLEAN NOT NULL, pickable BOOLEAN NOT NULL, comb_text VARCHAR(255) DEFAULT NULL, is_last BOOLEAN NOT NULL, hidden BOOLEAN DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_1F1B251E54177093 FOREIGN KEY (room_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO item (id, room_id, examine, deadly, pickable, comb_text, is_last, hidden) SELECT id, room_id, examine, deadly, pickable, comb_text, is_last, hidden FROM __temp__item
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__item
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1F1B251E54177093 ON item (room_id)
        SQL);
    }
}
