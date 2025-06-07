<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250606214641 extends AbstractMigration
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
            CREATE TABLE item (id VARCHAR(25) NOT NULL, room_id VARCHAR(255) NOT NULL, examine VARCHAR(255) NOT NULL, deadly BOOLEAN NOT NULL, pickable BOOLEAN NOT NULL, comb_text VARCHAR(255) DEFAULT NULL, is_last BOOLEAN NOT NULL, hidden BOOLEAN NOT NULL, examine_reveal VARCHAR(255) NOT NULL, combination_reveal VARCHAR(255) NOT NULL, combo VARCHAR(255) NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_1F1B251E54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)
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
            CREATE UNIQUE INDEX UNIQ_1F1B251ECAD25BD6 ON item (examine_reveal)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_1F1B251EBF56BD68 ON item (combination_reveal)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_1F1B251EB13C304A ON item (combo)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__room AS SELECT id, image, description, start FROM room
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE room
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE room (id VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, start BOOLEAN NOT NULL, north VARCHAR(255) NOT NULL, south VARCHAR(255) NOT NULL, west VARCHAR(255) NOT NULL, east VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO room (id, image, description, start) SELECT id, image, description, start FROM __temp__room
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__room
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519BDC2A30C2 ON room (north)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519B41157574 ON room (south)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519BCACAD1E2 ON room (west)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519B37D3E62A ON room (east)
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
            CREATE TABLE item (id VARCHAR(25) NOT NULL, room_id VARCHAR(255) NOT NULL, examine_reveal_id VARCHAR(25) DEFAULT NULL, combination_reveal_id VARCHAR(25) DEFAULT NULL, combo_id VARCHAR(25) DEFAULT NULL, examine VARCHAR(255) NOT NULL, deadly BOOLEAN NOT NULL, pickable BOOLEAN NOT NULL, comb_text VARCHAR(255) DEFAULT NULL, is_last BOOLEAN NOT NULL, hidden BOOLEAN NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_1F1B251E54177093 FOREIGN KEY (room_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1F1B251EDED7BB1F FOREIGN KEY (examine_reveal_id) REFERENCES item (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1F1B251EF3E67B23 FOREIGN KEY (combination_reveal_id) REFERENCES item (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1F1B251EEB6587E3 FOREIGN KEY (combo_id) REFERENCES item (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)
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
            CREATE UNIQUE INDEX UNIQ_1F1B251EDED7BB1F ON item (examine_reveal_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_1F1B251EF3E67B23 ON item (combination_reveal_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_1F1B251EEB6587E3 ON item (combo_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__room AS SELECT id, image, description, start FROM room
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE room
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE room (id VARCHAR(255) NOT NULL, north_id VARCHAR(255) DEFAULT NULL, south_id VARCHAR(255) DEFAULT NULL, west_id VARCHAR(255) DEFAULT NULL, east_id VARCHAR(255) DEFAULT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, start BOOLEAN NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_729F519BF09778E7 FOREIGN KEY (north_id) REFERENCES room (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_729F519BA2C6CA5 FOREIGN KEY (south_id) REFERENCES room (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_729F519B2FB51EC4 FOREIGN KEY (west_id) REFERENCES room (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_729F519B4465D135 FOREIGN KEY (east_id) REFERENCES room (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO room (id, image, description, start) SELECT id, image, description, start FROM __temp__room
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__room
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519B4465D135 ON room (east_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519B2FB51EC4 ON room (west_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519BA2C6CA5 ON room (south_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519BF09778E7 ON room (north_id)
        SQL);
    }
}
