<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509162442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE modelo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, temporada INT NOT NULL, cilindrada INT NOT NULL, turbo TINYINT(1) NOT NULL, peso DOUBLE PRECISION NOT NULL, imagen VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piloto (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, titulos INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piloto_modelo (piloto_id INT NOT NULL, modelo_id INT NOT NULL, INDEX IDX_4A5543E89AAD4A8D (piloto_id), INDEX IDX_4A5543E8C3A9576E (modelo_id), PRIMARY KEY(piloto_id, modelo_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE piloto_modelo ADD CONSTRAINT FK_4A5543E89AAD4A8D FOREIGN KEY (piloto_id) REFERENCES piloto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE piloto_modelo ADD CONSTRAINT FK_4A5543E8C3A9576E FOREIGN KEY (modelo_id) REFERENCES modelo (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piloto_modelo DROP FOREIGN KEY FK_4A5543E8C3A9576E');
        $this->addSql('ALTER TABLE piloto_modelo DROP FOREIGN KEY FK_4A5543E89AAD4A8D');
        $this->addSql('DROP TABLE modelo');
        $this->addSql('DROP TABLE piloto');
        $this->addSql('DROP TABLE piloto_modelo');
    }
}
