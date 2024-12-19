<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241215003155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posts ADD subcategory_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAF78A56EE FOREIGN KEY (subcategory_id_id) REFERENCES sub_category (id)');
        $this->addSql('CREATE INDEX IDX_885DBAFAF78A56EE ON posts (subcategory_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAF78A56EE');
        $this->addSql('DROP INDEX IDX_885DBAFAF78A56EE ON posts');
        $this->addSql('ALTER TABLE posts DROP subcategory_id_id');
    }
}
