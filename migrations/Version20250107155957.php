<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250107155957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_profile ADD website_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_profile ADD CONSTRAINT FK_D95AB40518F45C82 FOREIGN KEY (website_id) REFERENCES website (id)');
        $this->addSql('CREATE INDEX IDX_D95AB40518F45C82 ON user_profile (website_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_profile DROP FOREIGN KEY FK_D95AB40518F45C82');
        $this->addSql('DROP INDEX IDX_D95AB40518F45C82 ON user_profile');
        $this->addSql('ALTER TABLE user_profile DROP website_id');
    }
}
