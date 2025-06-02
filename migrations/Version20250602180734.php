<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250602180734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__room AS SELECT id, north_id, south_id, west_id, east_id, image, description, start FROM room
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE room
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE room (id VARCHAR(255) NOT NULL, north_id VARCHAR(255) DEFAULT NULL, south_id VARCHAR(255) DEFAULT NULL, west_id VARCHAR(255) DEFAULT NULL, east_id VARCHAR(255) DEFAULT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, start BOOLEAN NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_729F519BF09778E7 FOREIGN KEY (north_id) REFERENCES room (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_729F519BA2C6CA5 FOREIGN KEY (south_id) REFERENCES room (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_729F519B2FB51EC4 FOREIGN KEY (west_id) REFERENCES room (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_729F519B4465D135 FOREIGN KEY (east_id) REFERENCES room (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO room (id, north_id, south_id, west_id, east_id, image, description, start) SELECT id, north_id, south_id, west_id, east_id, image, description, start FROM __temp__room
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__room
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519BF09778E7 ON room (north_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519BA2C6CA5 ON room (south_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519B2FB51EC4 ON room (west_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519B4465D135 ON room (east_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__room AS SELECT id, north_id, south_id, west_id, east_id, image, description, start FROM room
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE room
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE room (id VARCHAR(255) NOT NULL, north_id VARCHAR(255) DEFAULT NULL, south_id VARCHAR(255) DEFAULT NULL, west_id VARCHAR(255) DEFAULT NULL, east_id VARCHAR(255) DEFAULT NULL, image VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, start BOOLEAN DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_729F519BF09778E7 FOREIGN KEY (north_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_729F519BA2C6CA5 FOREIGN KEY (south_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_729F519B2FB51EC4 FOREIGN KEY (west_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_729F519B4465D135 FOREIGN KEY (east_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO room (id, north_id, south_id, west_id, east_id, image, description, start) SELECT id, north_id, south_id, west_id, east_id, image, description, start FROM __temp__room
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__room
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519BF09778E7 ON room (north_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519BA2C6CA5 ON room (south_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519B2FB51EC4 ON room (west_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_729F519B4465D135 ON room (east_id)
        SQL);
    }
}
