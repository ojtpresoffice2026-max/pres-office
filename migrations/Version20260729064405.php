<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260729064405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE document_filing (id INT AUTO_INCREMENT NOT NULL, document_no VARCHAR(255) NOT NULL, document_status VARCHAR(255) NOT NULL, filed_by VARCHAR(255) NOT NULL, indexed_by VARCHAR(255) NOT NULL, date_index DATETIME NOT NULL, category_id INT DEFAULT NULL, INDEX IDX_5B71E37812469DE2 (category_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE folder (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, scanned_folder_no VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE shelf (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, transfered_date DATETIME NOT NULL, folder_name_id INT DEFAULT NULL, scanned_folder_no_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_A5475BE3C894F0A5 (folder_name_id), UNIQUE INDEX UNIQ_A5475BE342B95A15 (scanned_folder_no_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE document_filing ADD CONSTRAINT FK_5B71E37812469DE2 FOREIGN KEY (category_id) REFERENCES shelf (id)');
        $this->addSql('ALTER TABLE shelf ADD CONSTRAINT FK_A5475BE3C894F0A5 FOREIGN KEY (folder_name_id) REFERENCES folder (id)');
        $this->addSql('ALTER TABLE shelf ADD CONSTRAINT FK_A5475BE342B95A15 FOREIGN KEY (scanned_folder_no_id) REFERENCES folder (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document_filing DROP FOREIGN KEY FK_5B71E37812469DE2');
        $this->addSql('ALTER TABLE shelf DROP FOREIGN KEY FK_A5475BE3C894F0A5');
        $this->addSql('ALTER TABLE shelf DROP FOREIGN KEY FK_A5475BE342B95A15');
        $this->addSql('DROP TABLE document_filing');
        $this->addSql('DROP TABLE folder');
        $this->addSql('DROP TABLE shelf');
    }
}
