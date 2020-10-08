<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201007094431 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentair (id INT AUTO_INCREMENT NOT NULL, idblogiblog_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, INDEX IDX_224800D8331BE6E7 (idblogiblog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentair ADD CONSTRAINT FK_224800D8331BE6E7 FOREIGN KEY (idblogiblog_id) REFERENCES blog_post (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commentair');
    }
}
