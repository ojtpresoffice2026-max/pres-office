<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260730081950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE caff (id INT AUTO_INCREMENT NOT NULL, no_of_comm VARCHAR(255) DEFAULT NULL, document_code VARCHAR(255) DEFAULT NULL, bearer_of_letter VARCHAR(255) DEFAULT NULL, date_receive DATETIME DEFAULT NULL, time_receive VARCHAR(50) DEFAULT NULL, receiving_staff VARCHAR(255) DEFAULT NULL, letter_sender VARCHAR(255) DEFAULT NULL, office_designation VARCHAR(255) DEFAULT NULL, date_of_the_letter DATETIME DEFAULT NULL, content_of_the_letter LONGTEXT DEFAULT NULL, other_note LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE cas (id INT AUTO_INCREMENT NOT NULL, no_of_comm VARCHAR(255) DEFAULT NULL, document_code VARCHAR(255) DEFAULT NULL, bearer_of_letter VARCHAR(255) DEFAULT NULL, date_receive DATETIME DEFAULT NULL, time_receive VARCHAR(50) DEFAULT NULL, receiving_staff VARCHAR(255) DEFAULT NULL, letter_sender VARCHAR(255) DEFAULT NULL, office_designation VARCHAR(255) DEFAULT NULL, date_of_the_letter DATETIME DEFAULT NULL, content_of_the_letter LONGTEXT DEFAULT NULL, other_note LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE cba (id INT AUTO_INCREMENT NOT NULL, no_of_comm VARCHAR(255) DEFAULT NULL, document_code VARCHAR(255) DEFAULT NULL, bearer_of_letter VARCHAR(255) DEFAULT NULL, date_receive DATETIME DEFAULT NULL, time_receive VARCHAR(50) DEFAULT NULL, receiving_staff VARCHAR(255) DEFAULT NULL, letter_sender VARCHAR(255) DEFAULT NULL, office_designation VARCHAR(255) DEFAULT NULL, date_of_the_letter DATETIME DEFAULT NULL, content_of_the_letter LONGTEXT DEFAULT NULL, other_note LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE ccje (id INT AUTO_INCREMENT NOT NULL, no_of_comm VARCHAR(255) DEFAULT NULL, document_code VARCHAR(255) DEFAULT NULL, bearer_of_letter VARCHAR(255) DEFAULT NULL, date_receive DATETIME DEFAULT NULL, time_receive VARCHAR(50) DEFAULT NULL, receiving_staff VARCHAR(255) DEFAULT NULL, letter_sender VARCHAR(255) DEFAULT NULL, office_designation VARCHAR(255) DEFAULT NULL, date_of_the_letter DATETIME DEFAULT NULL, content_of_the_letter LONGTEXT DEFAULT NULL, other_note LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE cea (id INT AUTO_INCREMENT NOT NULL, no_of_comm VARCHAR(255) DEFAULT NULL, document_code VARCHAR(255) DEFAULT NULL, bearer_of_letter VARCHAR(255) DEFAULT NULL, date_receive DATETIME DEFAULT NULL, time_receive VARCHAR(50) DEFAULT NULL, receiving_staff VARCHAR(255) DEFAULT NULL, letter_sender VARCHAR(255) DEFAULT NULL, office_designation VARCHAR(255) DEFAULT NULL, date_of_the_letter DATETIME DEFAULT NULL, content_of_the_letter LONGTEXT DEFAULT NULL, other_note LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE cit (id INT AUTO_INCREMENT NOT NULL, no_of_comm VARCHAR(255) DEFAULT NULL, document_code VARCHAR(255) DEFAULT NULL, bearer_of_letter VARCHAR(255) DEFAULT NULL, date_receive DATETIME DEFAULT NULL, time_receive VARCHAR(50) DEFAULT NULL, receiving_staff VARCHAR(255) DEFAULT NULL, letter_sender VARCHAR(255) DEFAULT NULL, office_designation VARCHAR(255) DEFAULT NULL, date_of_the_letter DATETIME DEFAULT NULL, content_of_the_letter LONGTEXT DEFAULT NULL, other_note LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE cnpahs (id INT AUTO_INCREMENT NOT NULL, no_of_comm VARCHAR(255) DEFAULT NULL, document_code VARCHAR(255) DEFAULT NULL, bearer_of_letter VARCHAR(255) DEFAULT NULL, date_receive DATETIME DEFAULT NULL, time_receive VARCHAR(50) DEFAULT NULL, receiving_staff VARCHAR(255) DEFAULT NULL, letter_sender VARCHAR(255) DEFAULT NULL, office_designation VARCHAR(255) DEFAULT NULL, date_of_the_letter DATETIME DEFAULT NULL, content_of_the_letter LONGTEXT DEFAULT NULL, other_note LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE col (id INT AUTO_INCREMENT NOT NULL, no_of_comm VARCHAR(255) DEFAULT NULL, document_code VARCHAR(255) DEFAULT NULL, bearer_of_letter VARCHAR(255) DEFAULT NULL, date_receive DATETIME DEFAULT NULL, time_receive VARCHAR(50) DEFAULT NULL, receiving_staff VARCHAR(255) DEFAULT NULL, letter_sender VARCHAR(255) DEFAULT NULL, office_designation VARCHAR(255) DEFAULT NULL, date_of_the_letter DATETIME DEFAULT NULL, content_of_the_letter LONGTEXT DEFAULT NULL, other_note LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE cted (id INT AUTO_INCREMENT NOT NULL, no_of_comm VARCHAR(255) DEFAULT NULL, document_code VARCHAR(255) DEFAULT NULL, bearer_of_letter VARCHAR(255) DEFAULT NULL, date_receive DATETIME DEFAULT NULL, time_receive VARCHAR(50) DEFAULT NULL, receiving_staff VARCHAR(255) DEFAULT NULL, letter_sender VARCHAR(255) DEFAULT NULL, office_designation VARCHAR(255) DEFAULT NULL, date_of_the_letter DATETIME DEFAULT NULL, content_of_the_letter LONGTEXT DEFAULT NULL, other_note LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE cthm (id INT AUTO_INCREMENT NOT NULL, no_of_comm VARCHAR(255) DEFAULT NULL, document_code VARCHAR(255) DEFAULT NULL, bearer_of_letter VARCHAR(255) DEFAULT NULL, date_receive DATETIME DEFAULT NULL, time_receive VARCHAR(50) DEFAULT NULL, receiving_staff VARCHAR(255) DEFAULT NULL, letter_sender VARCHAR(255) DEFAULT NULL, office_designation VARCHAR(255) DEFAULT NULL, date_of_the_letter DATETIME DEFAULT NULL, content_of_the_letter LONGTEXT DEFAULT NULL, other_note LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE gs (id INT AUTO_INCREMENT NOT NULL, no_of_comm VARCHAR(255) DEFAULT NULL, document_code VARCHAR(255) DEFAULT NULL, bearer_of_letter VARCHAR(255) DEFAULT NULL, date_receive DATETIME DEFAULT NULL, time_receive VARCHAR(50) DEFAULT NULL, receiving_staff VARCHAR(255) DEFAULT NULL, letter_sender VARCHAR(255) DEFAULT NULL, office_designation VARCHAR(255) DEFAULT NULL, date_of_the_letter DATETIME DEFAULT NULL, content_of_the_letter LONGTEXT DEFAULT NULL, other_note LONGTEXT DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE caff');
        $this->addSql('DROP TABLE cas');
        $this->addSql('DROP TABLE cba');
        $this->addSql('DROP TABLE ccje');
        $this->addSql('DROP TABLE cea');
        $this->addSql('DROP TABLE cit');
        $this->addSql('DROP TABLE cnpahs');
        $this->addSql('DROP TABLE col');
        $this->addSql('DROP TABLE cted');
        $this->addSql('DROP TABLE cthm');
        $this->addSql('DROP TABLE gs');
    }
}
