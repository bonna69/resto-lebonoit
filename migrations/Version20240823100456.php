<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240823100456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration to create necessary tables if they do not exist.';
    }

    public function up(Schema $schema): void
    {
        // Check and create `admin` table if not exists
        $this->addSql('
            CREATE TABLE IF NOT EXISTS `admin` (
                id INT AUTO_INCREMENT NOT NULL,
                username VARCHAR(180) NOT NULL,
                roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\',
                password VARCHAR(255) NOT NULL,
                UNIQUE INDEX UNIQ_880E0D76F85E0677 (username),
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
        ');

        // Check and create `avis` table if not exists
        $this->addSql('
            CREATE TABLE IF NOT EXISTS `avis` (
                id INT AUTO_INCREMENT NOT NULL,
                nom VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                commentaire LONGTEXT NOT NULL,
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
        ');

        // Check and create `carte` table if not exists
        $this->addSql('
            CREATE TABLE IF NOT EXISTS `carte` (
                id INT AUTO_INCREMENT NOT NULL,
                carte_name VARCHAR(255) NOT NULL,
                carte_value LONGTEXT NOT NULL,
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
        ');

        // Check and create `contact` table if not exists
        $this->addSql('
            CREATE TABLE IF NOT EXISTS `contact` (
                id INT AUTO_INCREMENT NOT NULL,
                first_name VARCHAR(255) NOT NULL,
                last_name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone VARCHAR(20) DEFAULT NULL,
                message LONGTEXT NOT NULL,
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
        ');

        // Check and create `menu` table if not exists
        $this->addSql('
            CREATE TABLE IF NOT EXISTS `menu` (
                id INT AUTO_INCREMENT NOT NULL,
                name VARCHAR(255) NOT NULL,
                description LONGTEXT NOT NULL,
                price NUMERIC(10, 2) NOT NULL,
                category VARCHAR(255) NOT NULL,
                images LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\',
                is_available TINYINT(1) NOT NULL,
                created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
        ');

        // Check and create `reservation` table if not exists
        $this->addSql('
            CREATE TABLE IF NOT EXISTS `reservation` (
                id INT AUTO_INCREMENT NOT NULL,
                name VARCHAR(255) NOT NULL,
                firstname VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone VARCHAR(255) NOT NULL,
                date DATETIME NOT NULL,
                time VARCHAR(5) NOT NULL,
                number_of_persons INT NOT NULL,
                special_requests LONGTEXT DEFAULT NULL,
                confirmed TINYINT(1) NOT NULL,
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
        ');

        // Check and create `reservation_admin` table if not exists
        $this->addSql('
            CREATE TABLE IF NOT EXISTS `reservation_admin` (
                id INT AUTO_INCREMENT NOT NULL,
                client_name VARCHAR(255) NOT NULL,
                client_email VARCHAR(255) NOT NULL,
                reservation_date DATETIME NOT NULL,
                confirmed TINYINT(1) NOT NULL,
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
        ');

        // Check and create `messenger_messages` table if not exists
        $this->addSql('
            CREATE TABLE IF NOT EXISTS `messenger_messages` (
                id BIGINT AUTO_INCREMENT NOT NULL,
                body LONGTEXT NOT NULL,
                headers LONGTEXT NOT NULL,
                queue_name VARCHAR(190) NOT NULL,
                created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
                available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
                delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\',
                INDEX IDX_75EA56E0FB7336F0 (queue_name),
                INDEX IDX_75EA56E0E3BD61CE (available_at),
                INDEX IDX_75EA56E016BA31DB (delivered_at),
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS `admin`');
        $this->addSql('DROP TABLE IF EXISTS `avis`');
        $this->addSql('DROP TABLE IF EXISTS `carte`');
        $this->addSql('DROP TABLE IF EXISTS `contact`');
        $this->addSql('DROP TABLE IF EXISTS `menu`');
        $this->addSql('DROP TABLE IF EXISTS `reservation`');
        $this->addSql('DROP TABLE IF EXISTS `reservation_admin`');
        $this->addSql('DROP TABLE IF EXISTS `messenger_messages`');
    }
}