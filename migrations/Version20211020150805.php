<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211020150805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE days (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movies (id INT AUTO_INCREMENT NOT NULL, room_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, attach VARCHAR(255) DEFAULT NULL, releasedate DATE DEFAULT NULL, length VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, INDEX IDX_C61EED3054177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rooms (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, seats INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sessions (id INT AUTO_INCREMENT NOT NULL, slot_id INT NOT NULL, day_id INT NOT NULL, seatsleft INT NOT NULL, INDEX IDX_9A609D1359E5119C (slot_id), INDEX IDX_9A609D139C24126 (day_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sessions_movies (sessions_id INT NOT NULL, movies_id INT NOT NULL, INDEX IDX_832CFFF0F17C4D8C (sessions_id), INDEX IDX_832CFFF053F590A4 (movies_id), PRIMARY KEY(sessions_id, movies_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE slots (id INT AUTO_INCREMENT NOT NULL, slot VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tickets (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, phone VARCHAR(255) DEFAULT NULL, tickets INT NOT NULL, fare DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movies ADD CONSTRAINT FK_C61EED3054177093 FOREIGN KEY (room_id) REFERENCES rooms (id)');
        $this->addSql('ALTER TABLE sessions ADD CONSTRAINT FK_9A609D1359E5119C FOREIGN KEY (slot_id) REFERENCES slots (id)');
        $this->addSql('ALTER TABLE sessions ADD CONSTRAINT FK_9A609D139C24126 FOREIGN KEY (day_id) REFERENCES days (id)');
        $this->addSql('ALTER TABLE sessions_movies ADD CONSTRAINT FK_832CFFF0F17C4D8C FOREIGN KEY (sessions_id) REFERENCES sessions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sessions_movies ADD CONSTRAINT FK_832CFFF053F590A4 FOREIGN KEY (movies_id) REFERENCES movies (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sessions DROP FOREIGN KEY FK_9A609D139C24126');
        $this->addSql('ALTER TABLE sessions_movies DROP FOREIGN KEY FK_832CFFF053F590A4');
        $this->addSql('ALTER TABLE movies DROP FOREIGN KEY FK_C61EED3054177093');
        $this->addSql('ALTER TABLE sessions_movies DROP FOREIGN KEY FK_832CFFF0F17C4D8C');
        $this->addSql('ALTER TABLE sessions DROP FOREIGN KEY FK_9A609D1359E5119C');
        $this->addSql('DROP TABLE days');
        $this->addSql('DROP TABLE movies');
        $this->addSql('DROP TABLE rooms');
        $this->addSql('DROP TABLE sessions');
        $this->addSql('DROP TABLE sessions_movies');
        $this->addSql('DROP TABLE slots');
        $this->addSql('DROP TABLE tickets');
    }
}
