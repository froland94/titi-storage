<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240316184010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD unit VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product RENAME INDEX idx_d34a04ad9d86650f TO IDX_D34A04ADA76ED395');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP unit');
        $this->addSql('ALTER TABLE product RENAME INDEX idx_d34a04ada76ed395 TO IDX_D34A04AD9D86650F');
    }
}
