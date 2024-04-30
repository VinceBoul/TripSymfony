<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430210141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bus (id INT AUTO_INCREMENT NOT NULL, nb_places INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bus_date (id INT AUTO_INCREMENT NOT NULL, trajet_id INT NOT NULL, bus_id INT NOT NULL, place_restantes INT NOT NULL, INDEX IDX_F5934830D12A823 (trajet_id), INDEX IDX_F59348302546731D (bus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE date_ex (id INT AUTO_INCREMENT NOT NULL, bus_date_id INT DEFAULT NULL, date DATE NOT NULL, INDEX IDX_232528138C27A6 (bus_date_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trajet (id INT AUTO_INCREMENT NOT NULL, start_hour TIME NOT NULL, end_hour TIME NOT NULL, start_loc VARCHAR(255) NOT NULL, end_loc VARCHAR(255) NOT NULL, days INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_bus_date (user_id INT NOT NULL, bus_date_id INT NOT NULL, INDEX IDX_151EAC30A76ED395 (user_id), INDEX IDX_151EAC30138C27A6 (bus_date_id), PRIMARY KEY(user_id, bus_date_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bus_date ADD CONSTRAINT FK_F5934830D12A823 FOREIGN KEY (trajet_id) REFERENCES trajet (id)');
        $this->addSql('ALTER TABLE bus_date ADD CONSTRAINT FK_F59348302546731D FOREIGN KEY (bus_id) REFERENCES bus (id)');
        $this->addSql('ALTER TABLE date_ex ADD CONSTRAINT FK_232528138C27A6 FOREIGN KEY (bus_date_id) REFERENCES bus_date (id)');
        $this->addSql('ALTER TABLE user_bus_date ADD CONSTRAINT FK_151EAC30A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_bus_date ADD CONSTRAINT FK_151EAC30138C27A6 FOREIGN KEY (bus_date_id) REFERENCES bus_date (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bus_date DROP FOREIGN KEY FK_F5934830D12A823');
        $this->addSql('ALTER TABLE bus_date DROP FOREIGN KEY FK_F59348302546731D');
        $this->addSql('ALTER TABLE date_ex DROP FOREIGN KEY FK_232528138C27A6');
        $this->addSql('ALTER TABLE user_bus_date DROP FOREIGN KEY FK_151EAC30A76ED395');
        $this->addSql('ALTER TABLE user_bus_date DROP FOREIGN KEY FK_151EAC30138C27A6');
        $this->addSql('DROP TABLE bus');
        $this->addSql('DROP TABLE bus_date');
        $this->addSql('DROP TABLE date_ex');
        $this->addSql('DROP TABLE trajet');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_bus_date');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
