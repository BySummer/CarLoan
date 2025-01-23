<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250123003652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE request (id INT AUTO_INCREMENT NOT NULL, car_id INT NOT NULL, loan_program_id INT NOT NULL, initial_payment NUMERIC(10, 2) NOT NULL, loan_term SMALLINT NOT NULL, INDEX IDX_3B978F9FC3C6F69F (car_id), INDEX IDX_3B978F9F3EB8070A (loan_program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9FC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9F3EB8070A FOREIGN KEY (loan_program_id) REFERENCES loan_program (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9FC3C6F69F');
        $this->addSql('ALTER TABLE request DROP FOREIGN KEY FK_3B978F9F3EB8070A');
        $this->addSql('DROP TABLE request');
    }
}
