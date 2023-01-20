<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119184404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agencia (id INT AUTO_INCREMENT NOT NULL, gerente_id INT DEFAULT NULL, numero_agencia VARCHAR(15) NOT NULL, endereco VARCHAR(255) NOT NULL, numero_endereco VARCHAR(7) DEFAULT NULL, cep VARCHAR(11) DEFAULT NULL, bairro VARCHAR(11) DEFAULT NULL, cidade VARCHAR(15) NOT NULL, estado VARCHAR(15) DEFAULT NULL, data_criacao DATETIME NOT NULL, UNIQUE INDEX UNIQ_EB6C2B995AEA750D (gerente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conta (id INT AUTO_INCREMENT NOT NULL, agencia_id INT NOT NULL, user_id INT NOT NULL, tipo_conta_id INT NOT NULL, numero_conta VARCHAR(255) NOT NULL, saldo DOUBLE PRECISION DEFAULT NULL, status TINYINT(1) NOT NULL, data_criacao DATETIME NOT NULL, data_cacelamento DATETIME DEFAULT NULL, INDEX IDX_485A16C3A6F796BE (agencia_id), INDEX IDX_485A16C3A76ED395 (user_id), INDEX IDX_485A16C3B44BBA95 (tipo_conta_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gerente (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, UNIQUE INDEX UNIQ_306C486DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_conta (id INT AUTO_INCREMENT NOT NULL, tipo VARCHAR(2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transacao (id INT AUTO_INCREMENT NOT NULL, destino_id INT NOT NULL, origem_id INT NOT NULL, descricao VARCHAR(255) DEFAULT NULL, valor DOUBLE PRECISION NOT NULL, data_criacao DATETIME NOT NULL, INDEX IDX_6C9E60CEE4360615 (destino_id), INDEX IDX_6C9E60CE81E73123 (origem_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nome VARCHAR(50) NOT NULL, status TINYINT(1) NOT NULL, data_criacao DATETIME NOT NULL, data_cancelado DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agencia ADD CONSTRAINT FK_EB6C2B995AEA750D FOREIGN KEY (gerente_id) REFERENCES gerente (id)');
        $this->addSql('ALTER TABLE conta ADD CONSTRAINT FK_485A16C3A6F796BE FOREIGN KEY (agencia_id) REFERENCES agencia (id)');
        $this->addSql('ALTER TABLE conta ADD CONSTRAINT FK_485A16C3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE conta ADD CONSTRAINT FK_485A16C3B44BBA95 FOREIGN KEY (tipo_conta_id) REFERENCES tipo_conta (id)');
        $this->addSql('ALTER TABLE gerente ADD CONSTRAINT FK_306C486DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transacao ADD CONSTRAINT FK_6C9E60CEE4360615 FOREIGN KEY (destino_id) REFERENCES conta (id)');
        $this->addSql('ALTER TABLE transacao ADD CONSTRAINT FK_6C9E60CE81E73123 FOREIGN KEY (origem_id) REFERENCES conta (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agencia DROP FOREIGN KEY FK_EB6C2B995AEA750D');
        $this->addSql('ALTER TABLE conta DROP FOREIGN KEY FK_485A16C3A6F796BE');
        $this->addSql('ALTER TABLE conta DROP FOREIGN KEY FK_485A16C3A76ED395');
        $this->addSql('ALTER TABLE conta DROP FOREIGN KEY FK_485A16C3B44BBA95');
        $this->addSql('ALTER TABLE gerente DROP FOREIGN KEY FK_306C486DA76ED395');
        $this->addSql('ALTER TABLE transacao DROP FOREIGN KEY FK_6C9E60CEE4360615');
        $this->addSql('ALTER TABLE transacao DROP FOREIGN KEY FK_6C9E60CE81E73123');
        $this->addSql('DROP TABLE agencia');
        $this->addSql('DROP TABLE conta');
        $this->addSql('DROP TABLE gerente');
        $this->addSql('DROP TABLE tipo_conta');
        $this->addSql('DROP TABLE transacao');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
