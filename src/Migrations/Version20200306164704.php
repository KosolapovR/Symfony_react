<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200306164704 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(60) DEFAULT NULL');
        $this->addSql('ALTER TABLE likes RENAME INDEX idx_ac6340b3a76ed395 TO IDX_49CA4E7DA76ED395');
        $this->addSql('ALTER TABLE likes RENAME INDEX idx_ac6340b34b89032c TO IDX_49CA4E7D4B89032C');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, DROP role, CHANGE category_id category_id INT DEFAULT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE day_of_birth day_of_birth DATE DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE name name VARCHAR(60) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE likes RENAME INDEX idx_49ca4e7da76ed395 TO IDX_AC6340B3A76ED395');
        $this->addSql('ALTER TABLE likes RENAME INDEX idx_49ca4e7d4b89032c TO IDX_AC6340B34B89032C');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD role LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:simple_array)\', DROP roles, CHANGE category_id category_id INT DEFAULT NULL, CHANGE email email VARCHAR(60) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE password password VARCHAR(60) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE day_of_birth day_of_birth DATE DEFAULT \'NULL\'');
    }
}
