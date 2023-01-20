<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119221859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gerente ADD nome VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE tipo_conta ADD conta_corrente VARCHAR(2) NOT NULL, CHANGE tipo conta_poupanca VARCHAR(2) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tipo_conta ADD tipo VARCHAR(2) NOT NULL, DROP conta_poupanca, DROP conta_corrente');
        $this->addSql('ALTER TABLE gerente DROP nome');
    }
}
