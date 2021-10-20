<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211020153904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movies ADD lastdate DATE DEFAULT NULL, ADD firstday DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE tickets ADD session_id INT NOT NULL');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF4613FECDF FOREIGN KEY (session_id) REFERENCES sessions (id)');
        $this->addSql('CREATE INDEX IDX_54469DF4613FECDF ON tickets (session_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movies DROP lastdate, DROP firstday');
        $this->addSql('ALTER TABLE tickets DROP FOREIGN KEY FK_54469DF4613FECDF');
        $this->addSql('DROP INDEX IDX_54469DF4613FECDF ON tickets');
        $this->addSql('ALTER TABLE tickets DROP session_id');
    }
}
