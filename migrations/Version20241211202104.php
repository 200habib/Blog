<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241211202104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_profile ADD user_stack_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_profile ADD CONSTRAINT FK_D95AB405D74AE460 FOREIGN KEY (user_stack_id) REFERENCES user_stack (id)');
        $this->addSql('CREATE INDEX IDX_D95AB405D74AE460 ON user_profile (user_stack_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_profile DROP FOREIGN KEY FK_D95AB405D74AE460');
        $this->addSql('DROP INDEX IDX_D95AB405D74AE460 ON user_profile');
        $this->addSql('ALTER TABLE user_profile DROP user_stack_id');
    }
}
