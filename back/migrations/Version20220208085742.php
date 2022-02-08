<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220208085742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE seance (id INT AUTO_INCREMENT NOT NULL, member_id INT NOT NULL, coach_id INT NOT NULL, begin DATETIME DEFAULT NULL, end DATETIME DEFAULT NULL, valid TINYINT(1) NOT NULL, note INT DEFAULT NULL, INDEX IDX_DF7DFD0E7597D3FE (member_id), INDEX IDX_DF7DFD0E3C105691 (coach_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E7597D3FE FOREIGN KEY (member_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E3C105691 FOREIGN KEY (coach_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user ADD availability VARCHAR(255) NOT NULL, ADD experience VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE seance');
        $this->addSql('ALTER TABLE `user` DROP availability, DROP experience, CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
