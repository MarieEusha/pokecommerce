<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220529133251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', number VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, additionnal_infos VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(10) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(2) NOT NULL, PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE base_user (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1BF018B9E7927C74 (email), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', rarity BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', shiny BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', serie BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, release_date DATETIME NOT NULL, number INT NOT NULL, INDEX IDX_161498D3B7C0BE46 (rarity), INDEX IDX_161498D31363CDF0 (shiny), INDEX IDX_161498D3AA3A9334 (serie), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE front_user (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B5436C25E7927C74 (email), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', seller BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', date DATETIME NOT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_29D6873EFB1AD3FC (seller), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', address BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', buyer BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', date DATETIME NOT NULL, total_amount DOUBLE PRECISION NOT NULL, INDEX IDX_F5299398D4E6F81 (address), INDEX IDX_F529939884905FB3 (buyer), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rarity (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', game BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, release_date DATETIME NOT NULL, cards_number INT NOT NULL, INDEX IDX_AA3A9334232B318C (game), PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shiny (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tcg (uuid BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(uuid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3B7C0BE46 FOREIGN KEY (rarity) REFERENCES rarity (uuid)');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D31363CDF0 FOREIGN KEY (shiny) REFERENCES shiny (uuid)');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3AA3A9334 FOREIGN KEY (serie) REFERENCES serie (uuid)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EFB1AD3FC FOREIGN KEY (seller) REFERENCES base_user (uuid)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398D4E6F81 FOREIGN KEY (address) REFERENCES address (uuid)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939884905FB3 FOREIGN KEY (buyer) REFERENCES base_user (uuid)');
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A9334232B318C FOREIGN KEY (game) REFERENCES tcg (uuid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398D4E6F81');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EFB1AD3FC');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939884905FB3');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3B7C0BE46');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3AA3A9334');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D31363CDF0');
        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A9334232B318C');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE base_user');
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE front_user');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE rarity');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE shiny');
        $this->addSql('DROP TABLE tcg');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
