<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240826103300 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration to adjust tables and their relations.';
    }

    public function up(Schema $schema): void
    {
        // Create the `carte` table if it does not exist
        $this->addSql('
            CREATE TABLE IF NOT EXISTS carte (
                id INT AUTO_INCREMENT NOT NULL,
                carte_name VARCHAR(255) NOT NULL,
                carte_value LONGTEXT NOT NULL,
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
        ');

        // Drop foreign key constraint and table if they exist
        $this->addSql('
            SET foreign_key_checks = 0;
        ');
        
        $this->addSql('
            ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9312469DE2;
        ');

        $this->addSql('DROP TABLE IF EXISTS menu');
        $this->addSql('DROP TABLE IF EXISTS produit');
        $this->addSql('DROP TABLE IF EXISTS commande');
        $this->addSql('DROP TABLE IF EXISTS category');

        $this->addSql('
            SET foreign_key_checks = 1;
        ');
    }

    public function down(Schema $schema): void
    {
        // Recreate the `menu` table if it was dropped
        $this->addSql('
            CREATE TABLE IF NOT EXISTS menu (
                id INT AUTO_INCREMENT NOT NULL,
                category_id INT DEFAULT NULL,
                name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
                description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
                price NUMERIC(10, 2) NOT NULL,
                images LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\',
                is_available TINYINT(1) NOT NULL,
                created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
                INDEX IDX_7D053A9312469DE2 (category_id),
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
        ');

        // Recreate the other dropped tables
        $this->addSql('
            CREATE TABLE IF NOT EXISTS produit (
                id INT AUTO_INCREMENT NOT NULL,
                libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
                added_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
                composants JSON NOT NULL,
                prix INT NOT NULL,
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
        ');

        $this->addSql('
            CREATE TABLE IF NOT EXISTS commande (
                id INT AUTO_INCREMENT NOT NULL,
                etat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
                date_reservation DATETIME NOT NULL,
                heure_reservation TIME NOT NULL,
                nombre_personnes INT NOT NULL,
                commentaires VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
        ');

        $this->addSql('
            CREATE TABLE IF NOT EXISTS category (
                id INT AUTO_INCREMENT NOT NULL,
                name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
        ');

        // Recreate foreign key constraint for `menu` table
        $this->addSql('
            ALTER TABLE menu
            ADD CONSTRAINT FK_7D053A9312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
        ');

        // Drop the `carte` table if it was created
        $this->addSql('DROP TABLE IF EXISTS carte');
    }
}