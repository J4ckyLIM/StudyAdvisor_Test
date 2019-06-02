<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190602172916 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bug ADD owners_id INT NOT NULL');
        $this->addSql('ALTER TABLE bug ADD CONSTRAINT FK_358CBF14236ECBFC FOREIGN KEY (owners_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_358CBF14236ECBFC ON bug (owners_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bug DROP FOREIGN KEY FK_358CBF14236ECBFC');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_358CBF14236ECBFC ON bug');
        $this->addSql('ALTER TABLE bug DROP owners_id');
    }
}
